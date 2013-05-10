<?php
/**
 * @created 07.05.13 - 19:22
 * @author stefanriedel
 */

namespace Srit;
use Auth\Auth;
use Fuel\Core\Controller;


class Controller_Base extends Controller {

    protected $_controller_namespace = null;

    protected $_controller_namespace_lowercased = null;

    protected $_controller_without_controller_prefix = null;

    protected $_controller_without_controller_prefix_lowercased = null;

    protected $_controller_action = null;

    /**
     * @var Model_User
     */
    protected $_user = null;

    public function init() {
        $this->_init_controller_name();
    }



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

    public function _init_controller_name()
    {
        $this->_controller_namespace = preg_replace('/(\\\.*)/', '', $this->request->controller);
        $this->_controller_namespace_lowercased = strtolower($this->_controller_namespace);
        $this->_controller_without_controller_prefix = str_replace($this->_controller_namespace . '\Controller_', '', $this->request->controller);
        $this->_controller_without_controller_prefix_lowercased = strtolower($this->_controller_without_controller_prefix);
        $this->_controller_action = $this->request->action;
    }
}