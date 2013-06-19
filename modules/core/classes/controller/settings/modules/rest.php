<?php
/**
 * @created 19.06.13 - 14:27
 * @author stefanriedel
 */

namespace Core;

class Controller_Settings_Modules_Rest extends \Controller_Rest {
    public function action_sort() {
        $module_ids = \Input::get('module_ids');
        $module_sort = \Input::get('module_sort');
        \Module::sort($module_ids, $module_sort);
        return array(true);
    }
}