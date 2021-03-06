<?php
/**
 * @created 10.04.13 - 11:58
 * @author stefanriedel
 */

namespace Srit;

class Observer_Translated extends \Observer
{

    protected $_properties = array();

    public function __construct($model)
    {
        $props = $model::observers('\\Observer_Translated');
        $this->_properties = isset($props['properties']) ? $props['properties'] : array();

        if (empty($this->_properties)) {
            throw new \Exception(__('exception.srit.observer_translated.properties.empty'));
        }

        $language = \Loc::instance()->getLanguage();
        $model_properties = $model::properties();

        foreach ($this->_properties as $name => $property) {
            if(is_int($name)) {
                $property_name = $property . '_' . $language;
            } else {
                $property_name = $name . '_' . $language;
            }
            if (!isset($model_properties[$property_name])) {
                throw new \Exception(__('exception.srit.observer_translated.property.not.exists', array('property' => $property_name)));
            }
        }

    }

    public function before_save(Model $model)
    {
        $properties = $this->_properties;
        foreach ($properties as $property) {
            if ($model->issets($property)) {
                $model->unsets($property);
            }
        }
    }

    public function after_load(Model $model)
    {
        $this->_prepare_value($model);
    }

    public function after_save(Model $model) {
        $this->_prepare_value($model);
    }

    /**
     * @param Model $model
     */
    protected function _prepare_value(Model $model)
    {
        $properties = $this->_properties;
        $language = \Loc::instance()->getLanguage();
        foreach ($properties as $property) {
            $property_name = $property . '_' . $language;
            $ac_value = $model->get($property_name);
            $model->set($property, $ac_value);

        }
    }

}