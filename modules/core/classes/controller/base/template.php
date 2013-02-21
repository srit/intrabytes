<?php

namespace Core;

use Monolog\Logger;
use Monolog\Handler\ChromePHPHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\RotatingFileHandler;

class Controller_Base_Template extends \Controller_Template
{

    protected $_controller_namespace = '';

    protected $_controller_without_controller_prefix = '';

    protected $_controller_action = '';

    protected $_last_controller_part = '';

    protected $_controller_path = '/';

    protected $_crud_objects = array();

    protected $_crud_action = null;

    protected $_crud_redirect_uri = null;

    protected $_named_params = array();

    protected $_model_object_name = null;

    public $template = 'templates/layout';
    protected $_locale_prefix = null;

    /**
     * @var \Theme
     */
    protected $_theme_instance = null;
    public $date_format = 'de';
    public $navbars = array();

    /**
     *
     * @var Logger
     */
    protected $_logger = null;

    public function before()
    {

        if (\Input::is_ajax()) {
            return parent::before();
        }

        $this->_init_logger();

        /**
         * CSRF Token ist falsch, POST Variablen löschen!
         */
        if (\Fuel\Core\Request::active()->get_method() == 'POST' && false == \Security::check_token()) {
            Messages::error(__('validation.form.invalid'));
            foreach ($_POST as $key => $value) {
                unset($_POST[$key]);
            }
        }


        Theme::instance($this->template)->set_template($this->template)->set_global('theme', Theme::instance($this->template), false);


        $additional_view_dir = ROOT . DS . 'modules' . DS . $this->request->module . DS;
        if (!empty($this->request->module) && is_dir($additional_view_dir)) {
            /**
             * @todo dynamischer machen das aktuell aktivierte theme sollte unterstützt werden können
             */
            Theme::instance($this->template)->add_paths(
                array(
                    ROOT . 'modules' . DS . $this->request->module . DS
                )
            );
        }

        $this->_define_global_locales();
        if (!empty($this->_crud_objects)) {
            $this->_init_crud_objects();
        }
        $this->_log_controller_data();
    }

    public function after($response)
    {
        if (!\Input::is_ajax()) {
            // If nothing was returned set the theme instance as the response
            if (empty($response)) {
                $response = \Response::forge(Theme::instance($this->template));
            }

            if (!$response instanceof Response) {
                $response = \Response::forge($response);
            }

            Theme::clear($this->template);

            return $response;
        }

        return parent::after($response);
    }

    protected function _define_global_locales()
    {
        Theme::instance($this->template)->get_template()->set_global('title', __(extend_locale('title')));
    }

    protected function _init_crud_objects()
    {

        \Config::load('crud', true);
        $crud_options = \Config::get('crud.default');
        $this->_prepare_controller_vars();

        if (\Input::post('cancel', false)) {
            Messages::redirect(\Uri::create($this->_crud_redirect_uri));
        }

        if (in_array($this->_crud_action, $crud_options['crud_actions'])) {

            foreach ($this->_crud_objects as $key => $crud) {

                $this->_logger->debug('Crud Array', array($key, $crud));

                if (!is_string($key)) {
                    $this->_crud_objects[$crud] = array();
                    $crud_object = $crud;
                } else {
                    $crud_object = $key;
                    if (!is_array($crud)) {
                        $this->_crud_objects[$key] = array();
                    }
                }

                $explode_crud = explode(':', $crud_object);
                $this->_logger->debug('Explode Crud', $explode_crud);

                /**
                 * wenn ein namspace mit angegeben wurde,
                 * versuchen diesen aufzulösen
                 */
                if (count($explode_crud) > 1) {

                } else {
                    list($model) = $explode_crud;
                    $model = \Inflector::camelize($model);
                    $model = \Inflector::underscore($model);
                    $this->_model_object_name = (strstr($model, 'Model_')) ? $model : 'Model_' . $model;
                    $this->_model_object_name = $this->_controller_namespace . '\\' . $this->_model_object_name;
                }

                $options = array('where' => $this->_named_params);
                $this->_logger->debug('Options:', $options);

                /**
                 * @todo Cancel Button wurde betätigt
                 */

                if ($this->_crud_action == 'list') {
                    //list ist im moment die einzige action, welche ein find_all machen sollte
                    $data = forward_static_call_array(array($this->_model_object_name, 'find'), array('all', $options));
                } elseif ($this->_crud_action == 'add') {
                    $data = forward_static_call_array(array($this->_model_object_name, 'forge'), array($this->_named_params));
                } else {
                    $data = forward_static_call_array(array($this->_model_object_name, 'find'), array('first', $options));
                }

                if (\Input::post('save', false)) {
                    /**
                     * edit oder add
                     */
                    $data->set(\Input::post());
                    if ($data->validate()) {
                        $data->save();
                        Messages::instance()->success(__(extend_locale('edit.customer.success')));

                        Messages::redirect(\Uri::create($this->_crud_redirect_uri));
                    }
                }

                if (\Input::post('delete', false)) {
                    $data->delete();
                    Messages::instance()->success(__(extend_locale('delete.customer.success')));

                    Messages::redirect(\Uri::create($this->_crud_redirect_uri));
                }

                $this->_crud_objects[$crud_object]['data'] = $data;
            }
            Theme::instance($this->template)->get_partial('content', $this->_controller_path)->set('crud_objects', $this->_crud_objects);

        }
    }

    /**
     * @todo crud spezifisches auslagern, wir benötige diese Daten in jedem Fall und können sicher auch anhand der Controller_Action das benötigte Template setzen
     */
    protected function _prepare_controller_vars()
    {
        \Config::load('crud', true);
        $crud_options = \Config::get('crud.default');

        $this->_controller_namespace = preg_replace('/(\\\.*)/', '', $this->request->controller);
        $this->_controller_without_controller_prefix = str_replace($this->_controller_namespace . '\Controller_', '', $this->request->controller);
        $this->_controller_action = $this->request->action;
        $this->_named_params = \Request::forge()->named_params;

        $expl_controller_without_controller_prefix = explode('_', $this->_controller_without_controller_prefix);
        $this->_last_controller_part = array_pop($expl_controller_without_controller_prefix);

        $this->_crud_action = (in_array($this->_controller_action, $crud_options['crud_actions'])) ? $this->_controller_action : strtolower($this->_last_controller_part);
        $this->_controller_path = strtolower($this->_controller_namespace . '/' . str_replace('_', '/', $this->_controller_without_controller_prefix) . '/' . $this->_controller_action);

        /**
         * @todo evtl. auslagern
         */
        Theme::instance($this->template)->set_partial('content', $this->_controller_path);


        if (!empty($this->_named_params)) {
            foreach ($this->_named_params as $name => $value) {
                Theme::instance($this->template)->get_partial('content', $this->_controller_path)->set($name, $value);
            }
        }

        $this->_crud_redirect_uri = str_replace(array($this->_crud_action, '/index'), array('list', ''), $this->_controller_path) . '/' . implode('/', $this->_named_params);

        $this->_logger->debug('Controller Data', array($this->_controller_namespace, $this->_controller_without_controller_prefix, $this->_controller_action, $this->_last_controller_part, $this->_crud_action, $this->_controller_path, $this->_named_params, $this->_crud_redirect_uri));
    }

    private function _init_logger()
    {

        /**
         * @todo Logger Class erstellen (forge)
         */

        $log_level = \Config::get('logger.level');

        $this->_logger = new Logger('controller');
        $this->_logger->pushHandler(new ChromePHPHandler($log_level));
        $this->_logger->pushHandler(new FirePHPHandler($log_level));
    }

    private function _log_controller_data()
    {
        $reflector = new \ReflectionClass(get_called_class());
        $namespace = $reflector->getNamespaceName();
        $this->_logger->addDebug('Controller Namespace: ', array($namespace));
        $this->_logger->addDebug('Module: ', array($this->request->module));
        $this->_logger->addDebug('Controller: ', array($this->request->controller));
        $this->_logger->addDebug('Action: ', array($this->request->action));
    }

}
