<?php

namespace Core;

use Monolog\Logger;
use Monolog\Handler\ChromePHPHandler;

class Controller_Base_Template extends \Controller_Template {

    protected $_crud_objects = array();
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

    public function before() {

        if (\Input::is_ajax()) {
            return parent::before();
        }

        $this->_logger = new Logger('controller');
        $this->_logger->pushHandler(new ChromePHPHandler(\Config::get('logger.level')));

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
        $this->_init_crud_objects();
        $this->_log_controller_data();
    }

    public function after($response) {
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

    protected function _define_global_locales() {
        Theme::instance($this->template)->get_template()->set_global('title', __(extend_locale('title')));
    }

    protected function _init_crud_objects() {

        \Config::load('crud', true);
        $crud_options = \Config::get('crud.default');
        $expl_controller = explode('_', $this->request->controller);
        $last_controller_part = strtolower(array_pop($expl_controller));
        
        $this->_logger->debug($last_controller_part);
        
        if (!empty($this->_crud_objects) && 
                (in_array($this->request->action, $crud_options['crud_actions']) || 
                in_array($last_controller_part, $crud_options['crud_actions'])
                )) {
            
            
            
            foreach ($this->_crud_objects as $crud) {
                $explode_crud = explode(':', $crud);
                /**
                 * wenn ein namspace mit angegeben wurde,
                 * versuchen diesen aufzulösen
                 */
                if (count($explode_crud) > 1) {
                    
                } else {
                    list($model) = $explode_crud;
                    $model = \Inflector::camelize($model);
                    $model = \Inflector::underscore($model);
                    $model_object_name = (strstr($model, 'Model_')) ? $model : 'Model_' . $model;

                    /**
                     * aktuellen Namspace ermitteln
                     */
                    $reflector = new \ReflectionClass(get_called_class());
                    $namespace = $reflector->getNamespaceName();
                    $model_object_name = $namespace . '\\' . $model_object_name;
                }

                $params = \Fuel\Core\Request::forge()->named_params;
                $params = empty($params) ? \Fuel\Core\Request::forge()->method_params : $params;

                forward_static_call_array(array($model_object_name, 'find_for_edit'), $params);
            }
        }
    }

    private function _log_controller_data() {        
        $reflector = new \ReflectionClass(get_called_class());
        $namespace = $reflector->getNamespaceName();
        $this->_logger->addDebug('Controller Namespace: ' . $namespace);
        $this->_logger->addDebug('Module: ' . $this->request->module);
        $this->_logger->addDebug('Controller: ' . $this->request->controller);
        $this->_logger->addDebug('Action: ' . $this->request->action);
    }

}
