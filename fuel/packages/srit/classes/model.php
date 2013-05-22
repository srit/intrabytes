<?php
/**
 * @created 09.11.12 - 11:26
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Cache;
use Fuel\Core\CacheNotFoundException;
use Fuel\Core\Config;
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

    public static function find($id = null, array $options = array())
    {
        if (!isset($options['order_by'])) {
            $options['order_by'] = array('id' => 'DESC');
        }

        // Return Query object
        if (is_null($id)) {
            if (func_num_args() === 1) {
                throw new Exception(__('exception.srit.model.find.invalid.method.call'), 0);
            }
            return static::query($options);
        } // Return all that match $options array
        elseif ($id === 'all') {
            $data = static::query($options)->get();
            $model_list_name = get_called_class() . 'List';
            if(class_exists($model_list_name)) {
                $data_object = new $model_list_name($data);
            } else {
                $data_object = new ModelList($data);
            }
            unset($data);
            return $data_object;

        } // Return first or last row that matches $options array
        elseif ($id === 'first' or $id === 'last') {
            $query = static::query($options);

            foreach (static::primary_key() as $pk) {
                $query->order_by($pk, $id == 'first' ? 'ASC' : 'DESC');
            }

            return $query->get_one();
        } // Return specific request row by ID
        else {
            $cache_pk = $where = array();
            $id = (array)$id;
            foreach (static::primary_key() as $pk) {
                $where[] = array($pk, '=', current($id));
                $cache_pk[$pk] = current($id);
                next($id);
            }

            if (array_key_exists(get_called_class(), static::$_cached_objects)
                and array_key_exists(static::implode_pk($cache_pk), static::$_cached_objects[get_called_class()])
            ) {
                return static::$_cached_objects[get_called_class()][static::implode_pk($cache_pk)];
            }

            array_key_exists('where', $options) and $where = array_merge($options['where'], $where);
            $options['where'] = $where;
            return static::query($options)->get_one();
        }

//        return parent::find($id, $options);


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
                Messages::error(__ext($error));
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