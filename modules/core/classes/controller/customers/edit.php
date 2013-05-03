<?php
/**
 * @created 05.02.13 - 13:00
 * @author stefanriedel
 */

namespace Core;

class Controller_Customers_Edit extends Controller_Customers_Customers
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