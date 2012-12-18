<?php
/**
 * @created 16.11.12 - 10:02
 * @author stefanriedel
 */

namespace Core;
use Users\Model_User;

class Controller_Base_User_Raw extends Controller_Base_User {

    public $template = 'templates/raw';

    /**
     * @var \Users\Model_User
     */
    protected $_user = null;

    public function before() {
        /**
         * Nutzer müssen eingeloggt sein um diesen Controller zu nutzen
         */
        if(!\Auth::check()) {
            Messages::error('Access denied. Please login first');
            \Response::redirect('/users/login');
        }
        $this->_user = \Auth::instance()->get_user();
        parent::before();
    }

    public function after($response) {
        Theme::instance($this->template)->get_template()->set_global('user', $this->_user);
        return parent::after($response);
    }
}