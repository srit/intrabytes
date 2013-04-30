<?php
/**
 * @created 30.09.12 - 15:20
 * @author stefanriedel
 */

namespace Core;

use Fuel\Core\Config;
use Srit\Model_Navigation;
use Srit\Theme;
use Fuel\Core\Debug;
use Srit\Controller_Base_User;

class Controller_Dashboard extends Controller_Base_User {

    public function action_index() {
        $dashboard_items = Model_Dashboard_Item::find_by_user($this->_user->id);
        $data = array();
        if(is_array($dashboard_items) && count($dashboard_items) > 0) {
            foreach($dashboard_items as $item) {

                try
                {
                    $data[] = \Request::forge($item->route, false)->execute()->response()->body;
                }
                catch (\Exception $e)
                {
                    Debug::dump($e);
                }
            }
        }
        Theme::instance()->set_partial('content', 'core/dashboard/index')->set('dashboard_items', $data, false);
    }
}