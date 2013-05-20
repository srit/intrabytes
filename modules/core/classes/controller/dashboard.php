<?php
/**
 * @created 30.09.12 - 15:20
 * @author stefanriedel
 */

namespace Core;

use Srit\Controller_BaseBigTemplate;
use Srit\Model_Navigation;
use Srit\Request;

class Controller_Dashboard extends Controller_BaseBigTemplate {

    public function action_index() {
        $dashboard_items = Model_Dashboard_Item::find_my();
        $data = array();

        if(count($dashboard_items) > 0) {
            foreach($dashboard_items as $key => $item) {
                try
                {
                    $request = Request::forge($item->route, false);
                    $data[] = $request->execute()->response()->body;
                }
                catch (\Exception $e)
                {
                    echo $e->getMessage();
                }
            }
        }
        $this->_get_content_partial()->set('dashboard_items', $data, false);
    }


}