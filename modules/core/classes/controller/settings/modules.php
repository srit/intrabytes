<?php
/**
 * @created 22.04.13 - 15:29
 * @author stefanriedel
 */

namespace Core;


class Controller_Settings_Modules extends \Controller_CrudBigTemplate {

    protected $_crud_objects = array(
        '\Model_Module' => array()
    );

    public function action_list() {

    }

    public function action_activate() {
        $module = $this->param('module');
        \Module::activate($module);
        \Messages::instance()->success(__ext('module.activate.success.label', array('module' => $module)));
        \Messages::redirect(named_route('core_settings_modules_list'));
    }

    public function action_deactivate() {
        $module = $this->param('module');
        \Module::deactivate($module);
        \Messages::instance()->success(__ext('module.deactivate.success.label', array('module' => $module)));
        \Messages::redirect(named_route('core_settings_modules_list'));
    }

}