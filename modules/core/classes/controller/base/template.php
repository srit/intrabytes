<?php

namespace Core;

use Monolog\Logger;
use Monolog\Handler\ChromePHPHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\RotatingFileHandler;

class Controller_Base_Template extends \Controller_Template
{

    protected $_crud_objects = array();

    protected $_crud_action = null;

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
        $this->_init_crud_objects();
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
        $expl_controller = explode('_', $this->request->controller);
        $last_controller_part = strtolower(array_pop($expl_controller));
        $action = $this->request->action;

        if (!empty($this->_crud_objects) &&
            (in_array($action, $crud_options['crud_actions']) ||
                in_array($last_controller_part, $crud_options['crud_actions'])
            )
        ) {

            $this->_crud_action = (in_array($this->request->action, $crud_options['crud_actions'])) ? $this->reques->action : $last_controller_part;
            $this->_logger->debug('Crud Action:', array($this->_crud_action));

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
                    $model_object_name = (strstr($model, 'Model_')) ? $model : 'Model_' . $model;
                    $this->_logger->debug('Model Objekt Name:', array($model_object_name));
                    /**
                     * aktuellen Namspace ermitteln
                     */
                    $reflector = new \ReflectionClass(get_called_class());
                    $namespace = $reflector->getNamespaceName();
                    $model_object_name = $namespace . '\\' . $model_object_name;
                }

                $named_params = \Fuel\Core\Request::forge()->named_params;
                //$params = empty($params) ? \Fuel\Core\Request::forge()->method_params : $params;


                $this->_logger->debug('Primärschlüssel: ', array($model_object_name::primary_key()));
                $this->_logger->debug('Named Parameter', $named_params);

                $options = array('where' => $named_params);
                $this->_logger->debug('Options:', $options);


                if ($this->_crud_action == 'list') {
                    //list ist im moment die einzige action, welche ein find_all machen sollte
                    $data = $model_object_name::find('all', $options);
                } else {
                    $data = $model_object_name::find('first', $options);
                }

                $this->_crud_objects[$crud_object]['data'] = $data;
            }

            /**
             * Fürs Template
             */
            $expl_controller = explode('_', $this->request->controller);
            unset($expl_controller[0]);
            $template_path = $namespace . '/';
            $template_path .= implode('/', $expl_controller);
            $template_path .= '/' . $action;
            $template_path = strtolower($template_path);
            Theme::instance($this->template)->set_partial('content', $template_path)->set('crud_objects', $this->_crud_objects);
            $this->_logger->debug("Template Pfad", array($template_path));

        }
    }

    private function _init_logger()
    {
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
