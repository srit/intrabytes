<?php

namespace Srit;
use Auth\Auth;
use Fuel\Core\Config;
use Users\Model_User;

/**
 * @created 01.10.12 - 10:39
 * @author stefanriedel
 */
class Controller_Base_User extends Controller_Base_Template_Public {

    /**
     * @var \Users\Model_User
     */
    protected $_user = null;

    public function before() {
        /**
         * Nutzer müssen eingeloggt sein um diesen Controller zu nutzen
         */
        if(!\Auth::check()) {
            Messages::error(__('login.access.denied.login.first.label'));
            Messages::redirect(login_route());
        }
        $this->_user = Auth::instance()->get_user();
        parent::before();
    }

    public function after($response) {

        if(\Input::is_ajax()) {
            return parent::after($response);
        }

        //$this->_navigation = Config::load('navigation', true);

        Theme::instance()->get_template()->set_global('user', $this->_user);
        //Theme::instance()->get_template()->set_global('navigation', $this->_navigation);
        return parent::after($response);
    }
}