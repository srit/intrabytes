<?php
/**
 * @created 10.04.13 - 11:58
 * @author stefanriedel
 */

namespace Srit;
use Fuel\Core\FuelException;
use Orm\Observer;

class Observer_Translated extends Observer
{

    protected $_translated_properties = array();

    public function __construct($class)
    {
        $props = $class::observers(get_class($this));
        $this->_translated_properties = isset($props['translated_properties']) ? $props['translated_properties'] : array();

        if (empty($this->_translated_properties)) {
            throw new FuelException(__('exception.srit.observer_translated.properties.empty'));
        }

    }

    public function after_load(Model $model)
    {
        $properties = $this->_translated_properties;
        $language = Locale::instance()->getLanguage();
        foreach ($properties as $property) {
            $property_name = $property . '_' . $language;
            $ac_value = $model->get($property_name);
            $model->set($property, $ac_value);
        }
    }

}