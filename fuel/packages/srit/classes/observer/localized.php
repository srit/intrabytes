<?php
/**
 * @created 10.04.13 - 11:58
 * @author stefanriedel
 */

namespace Srit;
use Fuel\Core\Date;
use Orm\Observer;

class Observer_Localized extends Observer {
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
        $properties = $model->properties();
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