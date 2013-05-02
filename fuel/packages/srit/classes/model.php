<?php
/**
 * @created 09.11.12 - 11:26
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Cache;
use Fuel\Core\CacheNotFoundException;
use Fuel\Core\Config;
use Fuel\Core\FuelException;
use Oil\Exception;

class Model extends \Orm\Model
{

    /**
     * @var Logger
     */
    protected static $_logger = null;

    protected static $_many_many = array();
    protected static $_belongs_to = array();
    protected static $_has_one = array();
    protected static $_has_many = array();

    /**
     * @var \Fuel\Core\Fieldset
     */
    protected $_fieldset = null;

    public function __construct(array $data = array(), $new = true, $view = null)
    {
        $this->observe('before_load');
        return parent::__construct($data, $new, $view);
    }

    public static function build_cache_identifier_from_array(array $params, $separator = '_', $rtrim = true)
    {
        $identifier = '';
        foreach ($params as $k => $v) {
            if (is_array($v)) {
                $identifier .= trim($k) . $separator;
                $identifier .= static::build_cache_identifier_from_array($v, $separator, $rtrim);
            } else {
                $identifier .= $k . '_' . $v . $separator;
            }
        }

        if ($rtrim == true) {
            $identifier = rtrim($identifier, $separator);
        }

        $patterns = array(
            '/[\\\ %@\/\+]/',
            '/[!]/',
            '/[=]/'
        );

        $placement = array(
            $separator,
            'not',
            'same'
        );

        $identifier = preg_replace($patterns, $placement, $identifier);

        return $identifier;
    }

    public static function max($key = null) {
        return static::_cached('max', array($key));
    }

    public static function min($key = null) {
        return static::_cached('min', array($key));
    }

    public static function count(array $options = array())
    {
        return static::_cached('count', array($options));

    }

    public static function find($id = null, array $options = array())
    {
        if (!isset($options['order_by'])) {
            $options['order_by'] = array('id' => 'DESC');
        }

        return static::_cached('find', array($id, $options));

        /**$identifier = static::build_cache_identifier_from_array(array(get_called_class(), __FUNCTION__), '.', false);
        $identifier .= static::build_cache_identifier_from_array(array($id, $options));

        try {
            $data = Cache::get($identifier);
        } catch (CacheNotFoundException $e) {
            $data = parent::find($id, $options);
            if (Config::get('caching') == true) {
                Cache::set($identifier, $data);
            }
        }
        return $data;**/
        //Logger::forge('model')->debug('Find Function Args MODEL:', array($id, $options));

    }

    protected static function _cached($function, array $args) {
        $identifier = static::build_cache_identifier_from_array(array(get_called_class(), $function), '.', false);
        $identifier .= static::build_cache_identifier_from_array($args);

        try {
            $data = Cache::get($identifier);
        } catch (CacheNotFoundException $e) {
            $data = forward_static_call_array(array(get_parent_class(), $function), $args);


                //parent::find($id, $options);
            if (Config::get('caching') == true) {
                Cache::set($identifier, $data);
            }
        }

        return $data;

    }

    protected function _rm_cache($function, $args) {
        try {
            $return = call_user_func_array(array(get_parent_class(), $function), $args);
            $identifier = static::build_cache_identifier_from_array(array(get_called_class()), '.');
            Cache::delete_all($identifier);
        } catch (\Fuel\Core\Exception $e) {
            throw new Exception(__('exception.srit.model.' . $function));
        }

        return $return;
    }

    public function delete($cascade = null, $use_transaction = false)
    {
        /**try {
            $return = parent::delete($cascade, $use_transaction);
            $identifier = static::build_cache_identifier_from_array(array(get_called_class()), '.');
            Cache::delete_all($identifier);
        } catch (\Fuel\Core\Exception $e) {
            throw new Exception(__('exception.srit.model.delete'));
        }

        return $return; */

        return $this->_rm_cache('delete', array($cascade, $use_transaction));
    }

    public function save($cascade = null, $use_transaction = false)
    {
        /**try {
            $return = parent::save($cascade, $use_transaction);
            $identifier = static::build_cache_identifier_from_array(array(get_called_class()), '.');
            Cache::delete_all($identifier);
        } catch (\Fuel\Core\Exception $e) {
            throw new Exception(__('exception.srit.model.save'));
        }

        return $return; **/
        return $this->_rm_cache('save', array($cascade, $use_transaction));
    }

    public static function _init()
    {
        /**$language = Locale::instance()->getLanguage();
        foreach (static::properties() as $key => $prop) {
        if (is_array($prop) && isset($prop['type']) && $prop['type'] == 'translated') {
        $class = get_called_class();
        if (isset(static::$_properties_cached[$class])) {
        unset(static::$_properties_cached[$class]);
        }
        $ext_property = array($key . '_' . $language);
        static::$_properties = array_merge(static::$_properties, $ext_property);
        }
        }**/
    }

    public static function find_all(array $options = array())
    {
        return static::find('all', $options);
    }

    public function add_property(array $property)
    {
        $class = get_called_class();
        if (isset(static::$_properties_cached[$class])) {
            unset(static::$_properties_cached[$class]);
        }
        static::$_properties = array_merge(static::$_properties, $property);
    }

    public static function add_relation(array $relation)
    {
        foreach ($relation as $type => $rel) {
            if (isset(static::$_{$type})) {
                static::$_{$type} += $rel;
            }
        }
        $class = get_called_class();
        if (array_key_exists($class, static::$_relations_cached)) {
            unset(static::$_relations_cached[$class]);
        }
    }

    public function validate($input = array())
    {

        if (!$this->_fieldset instanceof \Fuel\Core\Fieldset) {
            $this->_fieldset = \Fuel\Core\Fieldset::forge()->add_model(get_called_class());
        }

        if ($this->_fieldset->validation()->run($input) == false) {
            foreach ($this->_fieldset->validation()->error() as $error) {
                Messages::error(__(extend_locale($error)));
            }
            return false;
        }
        return true;
    }

    public function formatted($property)
    {
        $value = parent::get($property);
        $properties = static::properties();

        if (!empty($value) && isset($properties[$property]['type'])) {
            switch ($properties[$property]['type']) {
                case 'currency':
                    $value = L10n::instance()->format_currency($value);
                    break;
                case 'date':
                    $value = L10n::instance()->format_date($value);
                    break;
                case 'datetime':
                    $value = L10n::instance()->format_datetime($value);
                    break;
            }
        }

        return $value;
    }

    public function & __get($property)
    {
        $properties = static::properties();
        if (isset($properties[$property]) && isset($properties[$property]['localized']) && $properties[$property]['localized'] == true) {
            $value = __($this->get($property));
        } else {
            $value = $this->get($property);
        }
        return $value;
    }

    public static function find_for_edit($params = null, array $options = array())
    {

    }

    public function __toString()
    {
        return '';
    }


    public static function properties()
    {
        $class = get_called_class();

        // If already determined
        if (array_key_exists($class, static::$_properties_cached)) {
            return static::$_properties_cached[$class];
        }

        // Try to grab the properties from the class...
        if (property_exists($class, '_properties')) {
            $properties = static::$_properties;
            foreach ($properties as $key => $p) {
                if (is_string($p)) {
                    unset($properties[$key]);
                    $properties[$p] = array();
                }
            }
        }

        // ...if the above failed, run DB query to fetch properties
        if (empty($properties)) {
            /**
             * with table_prefix
             */
            Config::load('db', true);
            $active_db_connection = Config::get('db.active');
            $table_name = Config::get('db.' . $active_db_connection . '.table_prefix') . static::table();

            try {
                $properties = \DB::list_columns($table_name, null, static::connection());
            } catch (\Exception $e) {
                throw new \FuelException('Listing columns failed, you have to set the model properties with a ' .
                    'static $_properties setting in the model. Original exception: ' . $e->getMessage());
            }
        }

        // cache the properties for next usage
        static::$_properties_cached[$class] = $properties;

        return static::$_properties_cached[$class];
    }

    public function issets($property)
    {
        return $this->__isset($property);
    }

    public function unsets($property)
    {
        return $this->__unset($property);
    }

}