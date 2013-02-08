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
        Theme::instance($this->template)->set_partial('content', 'customers/add/index')->set('customer', $this->customer);
        if(\Input::post('save', false)) {
            $this->customer->set(\Input::post());
            if($this->customer->validate()) {
                $this->customer->save();
                Messages::instance()->success(__(extend_locale('save.customer.success')));
                Messages::redirect(\Fuel\Core\Uri::create('/customers/list'));
            }
        }
    }

}