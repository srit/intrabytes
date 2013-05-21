<?php
/**
 * @created 11.02.2013
 * @author stefanriedel
 */

namespace Core;

class Controller_Settings_Locales_Rest extends \Controller_Rest {
    
    public function action_search() {
        $query = xss_clean($_GET['query']);
        $what = xss_clean($_GET['what']);

        $method_name = '_fetch_' . $what;
        if(method_exists($this, $method_name)) {
            return call_user_func(array($this, $method_name), $query);
        }

    }

    protected function _fetch_group($group) {
        $groups = \Srit\Model_Locale::find_groups_like_group($group);
        $ret_array = array('options' => array());
        if(!empty($groups)) {
            foreach($groups as $gr) {
                $ret_array['options'][] = $gr->group;
            }
        }
        return $ret_array;
    }
}