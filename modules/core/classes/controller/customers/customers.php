<?php
/**
 * @created 05.02.2013 - 11:10
 * @author stefanriedel
 */

namespace Core;

use Srit\Controller_Base_User;

class Controller_Customers_Customers extends Controller_Base_User {

    protected $_crud_objects = array(
        'customer' => array()
    );

    public function _set_select_fields_rowsets()
    {
        $this->salutations = Model_Salutation::find_all_for_html_select();
        $this->countries = Model_Country::find_all_for_html_select();

        $this->_get_content_template()
            ->set('salutations', $this->salutations)
            ->set('countries', $this->countries);
    }
}