<?php
/**
 * @created 07.05.13 - 19:22
 * @author stefanriedel
 */

namespace Srit;

class Controller_Base extends \Controller
{

    protected $_controller_namespace = null;

    protected $_controller_namespace_lowercased = null;

    protected $_controller_without_controller_prefix = null;

    protected $_controller_without_controller_prefix_lowercased = null;

    protected $_controller_action = null;

    protected $_controller_acl_condition = null;

    /**
     * @var Model_User
     */
    protected $_user = null;

    public function init()
    {
        $this->_init_controller_name();
        $this->_check_permissions();
    }


    public function before()
    {
        if (\Input::is_ajax()) {
            /**
             * Ajax weitesgehend mittels REST abfackeln
             */
            throw new \Exception(__('exception.srit.controller_base.before.not_ajax_allowed_here'));
        }
        $this->init();
        parent::before();
    }

    public function after($response)
    {
        return parent::after($response); // TODO: Change the autogenerated stub
    }


    protected function _init_controller_name()
    {
        $this->_controller_namespace = preg_replace('/(\\\.*)/', '', $this->request->controller);
        $this->_controller_namespace_lowercased = strtolower($this->_controller_namespace);
        $this->_controller_without_controller_prefix = str_replace($this->_controller_namespace . '\Controller_', '', $this->request->controller);
        $this->_controller_without_controller_prefix_lowercased = strtolower($this->_controller_without_controller_prefix);
        $this->_controller_action = $this->request->action;
    }

    protected function _check_permissions()
    {

        \Config::load('project', true);
        $this->_controller_acl_condition = (!empty($this->_controller_namespace)) ? $this->_controller_namespace . '\\' : '';
        $this->_controller_acl_condition .= $this->_controller_without_controller_prefix . '.' . $this->_controller_action;


        if (\Config::get('project.locked_mode') == 1
            && !in_array($this->_controller_acl_condition, \Config::get('project.locked_exceptions'))
            && !\Auth::check()) {
            \Messages::error(__('access.denied.login.first.label'));
            \Messages::redirect(login_route());
        }

        if (!\Auth::has_access($this->_controller_acl_condition)) {
            throw new \HttpPermissionDeniedException;
        }
    }
}