<?php
/**
 * @created 10.04.13 - 11:58
 * @author stefanriedel
 */

namespace Srit;
use Orm\Observer;

class Observer_Translated extends Observer {
    public function after_load(Model $model) {
        $properties = $model->properties();
        $language = Locale::instance()->getLanguage();
        foreach ($properties as $key => $prop) {
            if (is_array($prop) && isset($prop['type']) && $prop['type'] == 'translated') {
                $ac_value = $model->get($key . '_' . $language);
                $model->set($key, $ac_value);
            }
        }
    }

    public function before_load(Model $model) {
        $properties = $model->properties();
        $language = Locale::instance()->getLanguage();
        foreach ($properties as $key => $prop) {
            if (is_array($prop) && isset($prop['type']) && $prop['type'] == 'translated') {
                $ext_property = array($key . '_' . $language);
                $model->add_property($ext_property);
            }
        }
    }

}