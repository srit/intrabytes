<?php

namespace Core;
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
            Messages::error(extend_locale('access.denied.label'));
            Messages::redirect('/users/login');
        }
        $this->_user = \Auth::instance()->get_user();
        parent::before();
    }

    public function after($response) {

        if(\Input::is_ajax()) {
            return parent::after($response);
        }

        Theme::instance($this->template)->get_template()->set_global('user', $this->_user);
        return parent::after($response);
    }
}