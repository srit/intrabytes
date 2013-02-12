<?php
/**
 * @created 11.02.2013
 * @author stefanriedel
 */

namespace Customers;

use \Core\Messages;
use \Core\Theme;

class Controller_Postalcodes_Rest extends \Core\Controller_Base_User_Raw {
    
    public function action_search() {
        $query = $_GET['query'];
        $country_id = $_GET['country_id'];
        $postalcodes = Model_Postalcode::find_like_postalcode($query, $country_id);
        $ret_array = array('options' => array());
        if(!empty($postalcodes)) {
            foreach($postalcodes as $postalcode) {
                $ret_array['options'][] = concat(' - ', $postalcode->postalcode, $postalcode->city);
            }
        }
        return $ret_array;
    }
    
    public function action_fetch() {
        $postalcode = $_GET['postalcode'];
        $country_id = $_GET['country_id'];
        $postalcode_model = Model_Postalcode::find_by_postalcode($postalcode, $country_id);
        return $postalcode_model->to_array();
    }
    
}