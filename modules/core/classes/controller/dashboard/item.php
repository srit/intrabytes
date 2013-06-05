<?php
/**
 * @created 06.05.13 - 21:41
 * @author stefanriedel
 */

namespace Core;

class Controller_Dashboard_Item extends \Controller_Base_User_Raw {

    protected function _init_controller_vars()
    {
        \Theme::instance('dashboard')->set_templates_path_prefix($this->_controller_path_prefix)
            ->set_partial('content', $this->_controller_path)
            ->set('controller_namespace', $this->_controller_namespace)
            ->set('controller_without_controller_prefix', $this->_controller_without_controller_prefix)
            ->set('controller_action', $this->_controller_action)
            ->set('controller_path', $this->_controller_path)
            ->set('locale_prefix', $this->_locale_prefix);
        if (!empty($this->_named_params)) {
            foreach ($this->_named_params as $name => $value) {
                \Theme::instance('dashboard')->get_partial('content', $this->_controller_path)->set($name, $value);
            }
        }
    }

}