<?php
/**
 * @created 05.02.13 - 13:00
 * @author stefanriedel
 */

namespace Customers;

use \Core\Messages;
use \Core\Theme;

class Controller_Add extends \Core\Controller_Base_User {

    public function action_index() {
        if(\Input::post('cancel', false)) {
            \Response::redirect(\Uri::create('/customers/list'));
        }
        
        $this->customer = Model_Customer::forge();
        $this->salutations = Model_Salutation::find_all_for_html_select();
        $this->countries = Model_Country::find_all_for_html_select();
        
        if(\Input::post('save', false)) {
            $this->customer->set(\Input::post());
            if($this->customer->validate()) {
                $this->customer->save();
                Messages::instance()->success(__(extend_locale('save.customer.success')));
                Messages::redirect(\Fuel\Core\Uri::create('/customers/list'));
            }

        }

        $this->country_id = (isset($this->customer->country_id)) ? $this->customer->country_id : 0;
        $this->postalcode_text = (isset($this->customer->postalcode_text)) ? $this->customer->postalcode_text : '';
        $this->city_text = (isset($this->customer->city_text)) ? $this->customer->city_text : '';

        Theme::instance($this->template)->set_partial('content', 'customers/edit/index')
                ->set('customer', $this->customer)
                ->set('salutations', $this->salutations)
                ->set('countries', $this->countries)
                ->set('postalcode_text', $this->postalcode_text)
                ->set('city_text', $this->city_text)
                ->set('country_id', $this->country_id);
    }

}