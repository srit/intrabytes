<?php
/**
 * @created 09.11.12 - 11:26
 * @author stefanriedel
 */

namespace Srit;

class Model extends \Orm\Model
{

    protected static $_many_many = array();
    protected static $_belongs_to = array();
    protected static $_has_one = array();
    protected static $_has_many = array();

    /**
     * @var \Fuel\Core\Fieldset
     */
    protected $_fieldset = null;

    public static function find_all(array $options = array()) {
        return static::find('all', $options);
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

    public function validate() {
        $this->_fieldset = \Fuel\Core\Fieldset::forge()->add_model(get_called_class());
        if($this->_fieldset->validation()->run() == false) {
            foreach ($this->_fieldset->validation()->error() as $error) {
                \Core\Messages::error($error);
            }
        };
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
        if(isset($properties[$property]) && isset($properties[$property]['localized']) && $properties[$property]['localized'] == true ) {
            $value = __($this->get($property));
        } else {
            $value = $this->get($property);
        }
        return $value;
    }
    
    public static function find_for_edit($id = null, array $options = array()) {
        
    }

}