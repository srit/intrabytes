<?php
/**
 * @created 23.06.13 - 21:01
 * @author stefanriedel
 */

namespace Core;

class Controller_Settings_Modules_Deactivate extends \Controller_Base {

    public function action_index() {
        $module = $this->param('module');
        \Module::deactivate($module);
        \Messages::instance()->success(__ext('module.deactivate.success.label', array('module' => $module)));
        \Messages::redirect(named_route('core_settings_modules_list'));
    }

}