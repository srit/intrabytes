<?php
/**
 * @created 10.04.13 - 11:58
 * @author stefanriedel
 */

namespace Srit;
class Observer_Serialized extends \Observer
{

    public function __construct($model)
    {
        $props = $model::observers('\\Observer_Serialized');
        $this->_properties = isset($props['properties']) ? $props['properties'] : array();

        if (empty($this->_properties)) {
            throw new \Exception(__('exception.srit.observer_serialized.properties.empty', array('model' => $model)));
        }

        $model_properties = $model::properties();
        foreach ($this->_properties as $name => $property) {
            if (is_int($name)) {
                $property_name = $property;
            } else {
                $property_name = $name;
            }
            if (!isset($model_properties[$property_name])) {
                throw new \Exception(__('exception.srit.observer_serialized.property.not.exists', array('property' => $property_name)));
            }
        }

    }

    public function after_save(Model $model)
    {
        $this->_prepare($model, 'reformat');
    }

    public function after_load(Model $model)
    {
        $this->_prepare($model, 'reformat');
    }

    public function before_save(Model $model)
    {
        $this->_prepare($model, 'format');
    }

    /**
     * @param Model $model
     * @param string $format
     */
    protected function _prepare(Model $model, $format)
    {
        $properties = $this->_properties;
        foreach ($properties as $key => $prop) {

            $ac_value = $model->get($prop);
            switch ($format) {
                case 'format':
                    $format_methode = 'serializer';
                    break;
                case 'reformat':
                    $format_methode = 'unserializer';
                    break;
            }
            $model->set($prop, $format_methode($ac_value));
        }
    }
}