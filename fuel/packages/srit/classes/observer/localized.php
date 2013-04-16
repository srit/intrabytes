<?php
/**
 * @created 10.04.13 - 11:58
 * @author stefanriedel
 */

namespace Srit;
use Orm\Observer;

class Observer_Localized extends Observer {

    public function __construct($model)
    {
        $props = $model::observers(get_class($this));
        $this->_properties = isset($props['properties']) ? $props['properties'] : array();

        if (empty($this->_properties)) {
            throw new Exception(__('exception.srit.observer_localized.properties.empty', array('model' => $model)));
        }

        $model_properties = $model::properties();
        foreach ($this->_properties as $name => $property) {
            if(is_int($name)) {
                $property_name = $property;
            } else {
                $property_name = $name;
            }
            if (!isset($model_properties[$property_name])) {
                throw new Exception(__('exception.srit.observer_localized.property.not.exists', array('property' => $property_name)));
            }
        }

    }

    public function after_save(Model $model) {
        $this->_prepare($model, 'format');
    }

    public function after_load(Model $model) {
        $this->_prepare($model, 'format');
    }

    public function before_save(Model $model) {
        $this->_prepare($model, 'reformat');
    }

    /**
     * @param Model $model
     * @param string $format
     */
    protected function _prepare(Model $model, $format)
    {
        $properties = $this->_properties;
        $format_methode_prefix = $format;
        foreach ($properties as $key => $prop) {
            if (is_array($prop) && isset($prop['type'])) {
                $ac_value = $model->get($key);
                switch ($prop['type']) {
                    case 'date':
                        $format_methode = $format_methode_prefix . '_date';
                        break;
                    case 'datetime':
                        $format_methode = $format_methode_prefix . '_datetime';
                        break;
                }
                $model->set($key, L10n::instance()->$format_methode($ac_value));
            }
        }
    }
}