<?php
/**
 * @created 05.02.13 - 13:00
 * @author stefanriedel
 */

namespace Customers;

use \Core\Messages;
use \Core\Theme;

class Controller_Add extends Controller_Customers
{

    public function action_index()
    {

        $this->salutations = Model_Salutation::find_all_for_html_select();
        $this->countries = Model_Country::find_all_for_html_select();

        $this->country_id = (isset($this->_crud_objects['customer']['data']->country_id)) ? $this->_crud_objects['customer']['data']->country_id : 0;
        $this->postalcode_text = (isset($this->_crud_objects['customer']['data']->postalcode_text)) ? $this->_crud_objects['customer']['data']->postalcode_text : '';
        $this->city_text = (isset($this->_crud_objects['customer']['data']->city_text)) ? $this->_crud_objects['customer']['data']->city_text : '';

        $this->_get_content_template()
            ->set('salutations', $this->salutations)
            ->set('countries', $this->countries)
            ->set('postalcode_text', $this->postalcode_text)
            ->set('country_id', $this->country_id)
            ->set('city_text', $this->city_text);
    }

}