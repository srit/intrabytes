<?php
/**
 * @created 30.09.12 - 15:20
 * @author stefanriedel
 */

namespace Core;

use Srit\Model_Navigation;
use Srit\Request;
use Srit\Theme;
use Srit\Controller_Base_User;

class Controller_Dashboard extends Controller_Base_User {

    public function action_index() {
        $dashboard_items = Model_Dashboard_Item::find_my();
        $data = array();

        if(count($dashboard_items) > 0) {
            foreach($dashboard_items as $key => $item) {
                try
                {
                    $request = Request::forge($item->route, false);
                    //$data[] = $key . ' - ' . $item->route;
                    //$data[] = $request->execute()->response()->body;
                }
                catch (\Exception $e)
                {
                    echo $e->xdebug_message;
                }
            }
        }
        Theme::instance()->set_partial('content', 'core/dashboard/index')->set('dashboard_items', $data, false);
    }


}