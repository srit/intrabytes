<?php
/**
 * @created 30.09.12 - 15:20
 * @author stefanriedel
 */

namespace Dashboard;

use \Core\Theme;

class Controller_Board extends \Core\Controller_Base_User {

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
                    \Debug::dump($e);
                }
            }
        }


        Theme::instance($this->template)->get_template()->set_global('title', __('Dashboard'));
        Theme::instance($this->template)->set_partial('content', 'dashboard/board/index')->set('dashboard_items', $data, false);
    }
}