<?php
/**
 * @created 05.02.13 - 13:00
 * @author stefanriedel
 */

namespace Customers;

class Controller_Add extends Controller_Customers
{

    public function action_index()
    {

        $this->salutations = Model_Salutation::find_all_for_html_select();
        $this->countries = Model_Country::find_all_for_html_select();

        $this->_get_content_template()
            ->set('salutations', $this->salutations)
            ->set('countries', $this->countries);
    }

}