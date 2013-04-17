<?php

namespace Srit;

use Fuel\Core\Config;
use Fuel\Core\Fuel;
use Srit\HttpNotFoundException;
use Fuel\Core\Input;
use Srit\Pagination;
use Srit\Request;
use Fuel\Core\Response;
use Fuel\Core\Security;
use Srit\Inflector;
use Srit\Locale;
use Srit\Logger;
use Srit\Navigation;

class Controller_Base_Template extends \Controller_Template
{

    protected $_controller_namespace = '';

    protected $_controller_namespace_lowercased = '';

    protected $_controller_without_controller_prefix = '';

    protected $_controller_without_controller_prefix_lowercased = '';

    protected $_controller_action = '';

    protected $_controller_path = '/';

    protected $_page_title = null;

    protected $_named_params = array();

    public $template = 'templates/layout';

    protected $_navigation_template = 'templates/navbar';

    protected $_breadcrumb_template = 'templates/breadcrumb';

    protected $_last_pages_template = 'templates/last_pages';

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

    public function set_page_title($page_title)
    {
        $this->_page_title = $page_title;
    }

    public function before()
    {
        if (Input::is_ajax()) {
            return parent::before();
        }

        $this->_init_logger();

        /**
         * CSRF Token ist falsch, POST Variablen löschen!
         */
        if (Fuel::$env == Fuel::PRODUCTION && Request::active()->get_method() == 'POST' && false == Security::check_token()) {
            Messages::error(__('validation.form.invalid'));
            foreach ($_POST as $key => $value) {
                unset($_POST[$key]);
            }
        }

        Theme::instance()->set_template($this->template)->set_global('theme', Theme::instance(), false);
        $additional_view_dir = ROOT . DS . 'modules' . DS . $this->request->module . DS;
        if (!empty($this->request->module) && is_dir($additional_view_dir)) {
            /**
             * @todo dynamischer machen das aktuell aktivierte theme sollte unterstützt werden können
             */
            Theme::instance()->add_paths(
                array(
                    ROOT . 'modules' . DS . $this->request->module . DS
                )
            );
        }

        $this->_init_controller_vars();

        if (!empty($this->_crud_objects)) {
            $this->_init_crud_objects();
        }
        $this->_log_controller_data();

        $additional_js = array();
        $controller_main_js_path = 'modules/' . strtolower($this->_controller_namespace) . '/main.js';

        if (Theme::instance()->asset->find_file($controller_main_js_path, 'js')) {
            $additional_js[] = $controller_main_js_path;
        }
        Theme::instance()->get_template($this->template)->set_global('additional_js', $additional_js);
        $this->_last_pages();
    }

    protected function _init_navigation()
    {
        Theme::instance()->set_partial('navigation', $this->_navigation_template);
        Theme::instance()->get_partial('navigation', $this->_navigation_template)->set('top_left', Navigation::forge('top_left'), false);
        Theme::instance()->get_partial('navigation', $this->_navigation_template)->set('top_right', Navigation::forge('top_right'), false);
        Theme::instance()->set_partial('breadcrumb', $this->_breadcrumb_template)->set('navigation', Navigation::instance(), false);
    }

    public function after($response)
    {
        if (!Input::is_ajax()) {
            $this->_init_title();
            $this->_init_navigation();
            // If nothing was returned set the theme instance as the response
            if (empty($response)) {
                $response = Response::forge(Theme::instance());
            }

            if (!$response instanceof Response) {
                $response = Response::forge($response);
            }

            Theme::clear($this->template);
            return $response;
        }

        return parent::after($response);
    }

    /**
     * @todo to navigation?
     */
    protected function _last_pages()
    {

        Last_Pages::setActivePageTitle($this->_page_title);
        Last_Pages::set();
        Theme::instance()->set_partial('last_pages', $this->_last_pages_template)->set('last_pages', Last_Pages::get());

    }

    protected function _init_title()
    {
        Theme::instance()->get_template($this->template)->set_global('title', $this->_page_title);
    }

    protected function _init_controller_vars()
    {
        $this->_controller_namespace = preg_replace('/(\\\.*)/', '', $this->request->controller);
        $this->_controller_namespace_lowercased = strtolower($this->_controller_namespace);
        $this->_controller_without_controller_prefix = str_replace($this->_controller_namespace . '\Controller_', '', $this->request->controller);
        $this->_controller_without_controller_prefix_lowercased = strtolower($this->_controller_without_controller_prefix);
        $this->_controller_action = $this->request->action;
        $this->_controller_path = strtolower($this->_controller_namespace . '/' . str_replace('_', '/', $this->_controller_without_controller_prefix) . '/' . $this->_controller_action);
        $this->_locale_prefix = str_replace('/', '.', $this->_controller_path);

        Locale::instance()->setLocalePrefix($this->_locale_prefix);
        $this->_named_params = Request::forge()->named_params;
        Theme::instance()->set_partial('content', $this->_controller_path)
            ->set('controller_namespace', $this->_controller_namespace)
            ->set('controller_without_controller_prefix', $this->_controller_without_controller_prefix)
            ->set('controller_action', $this->_controller_action)
            ->set('controller_path', $this->_controller_path)
            ->set('locale_prefix', $this->_locale_prefix);
        if (!empty($this->_named_params)) {
            foreach ($this->_named_params as $name => $value) {
                Theme::instance()->get_partial('content', $this->_controller_path)->set($name, $value);
            }
        }

        $this->set_page_title(__(extend_locale('title')));

        //$this->_logger->debug('Controller Data', array($this->_controller_namespace, $this->_controller_without_controller_prefix, $this->_controller_action, $this->_controller_path, $this->_named_params, $this->_locale_prefix));
    }

    /**
     * @return \Fuel\Core\View
     * @throws \Exception
     */
    protected function _get_content_template()
    {
        if (empty($this->_controller_path)) {
            throw new Exception(__(extend_locale('exception.controller_path_undefined')));
        }
        return Theme::instance()->get_partial('content', $this->_controller_path);
    }

    private function _init_logger()
    {
        $this->_logger = Logger::forge('controller');
    }

    private function _log_controller_data()
    {
        $this->_logger->debug('controller', array($this->_controller_without_controller_prefix));
        return;
        $reflector = new \ReflectionClass(get_called_class());
        $namespace = $reflector->getNamespaceName();
        $this->_logger->addDebug('Controller Namespace: ', array($namespace));
        $this->_logger->addDebug('Module: ', array($this->request->module));
        $this->_logger->addDebug('Controller: ', array($this->request->controller));
        $this->_logger->addDebug('Action: ', array($this->request->action));
    }


    /*******************
     ******************* CRUD
     *******************/

    protected $_crud_last_controller_part = '';

    protected $_crud_objects = array();

    protected $_crud_action = null;

    protected $_crud_redirect_uri = null;

    protected $_crud_actual_object = null;

    protected $_crud_pagination_config = array();

    protected $_crud_pagination = array();

    protected function _init_crud_objects()
    {

        Config::load('crud', true);
        $crud_options = Config::get('crud.default');
        $this->_init_crud_vars();

        if (Input::post('cancel', false)) {
            Messages::redirect(Uri::create($this->_crud_redirect_uri));
        }

        if (in_array($this->_crud_action, $crud_options['crud_actions'])) {

            $this->_iterate_crud_objects();


            $this->_get_content_template()
                ->set('crud_objects', $this->_crud_objects, false)
                ->set('pagination', $this->_crud_pagination, false);

        }
    }

    protected function _init_crud_vars()
    {
        Config::load('crud', true);
        $crud_options = Config::get('crud.default');

        $expl_controller_without_controller_prefix = explode('_', $this->_controller_without_controller_prefix);
        $this->_crud_last_controller_part = array_pop($expl_controller_without_controller_prefix);
        $this->_crud_action = (in_array($this->_controller_action, $crud_options['crud_actions'])) ? $this->_controller_action : strtolower($this->_crud_last_controller_part);

        $route_prefix = str_replace(array($this->_crud_action, '/index'), array('list', ''), $this->_controller_path);
        $route_function_prefix = str_replace('/', '_', $route_prefix);
        $this->_crud_redirect_uri = named_route($route_function_prefix, $this->_named_params, false);

        if (empty($this->_crud_redirect_uri)) {
            //simple way
            $this->_crud_redirect_uri = Uri::create($route_prefix . '/' . implode('/', $this->_named_params));
        }

        $this->_get_content_template()
            ->set('last_controller_part', $this->_crud_last_controller_part)
            ->set('crud_action', $this->_crud_action);

        //$this->_logger->debug('Crud Controller Data', array($this->_last_controller_part, $this->_crud_action, $this->_crud_list_uri));
    }


    /**
     * @return void
     */
    protected function _extract_crud_object()
    {
        $this->_crud_objects[$this->_crud_actual_object] = array();
        $explode_crud = explode(':', $this->_crud_actual_object);


        /**
         * wenn ein namspace mit angegeben wurde,
         * versuchen diesen aufzulösen
         *
         * evtl macht es auch sinn zu prüfen, ob das Model mit dem Namespace angegeben wurde
         * z.B. Srit\Model_Languages
         *
         */
        if (count($explode_crud) > 1) {
            $model = Inflector::camelize($explode_crud[1]);
            $model = Inflector::underscore($model);
            $this->_crud_objects[$this->_crud_actual_object]['model_object_name'] = (strstr($model, 'Model_')) ? $model : 'Model_' . $model;
            $this->_crud_objects[$this->_crud_actual_object]['model_object_name'] = ucfirst($explode_crud[0]) . '\\' . $this->_crud_objects[$this->_crud_actual_object]['model_object_name'];
        } else {
            list($model) = $explode_crud;
            $model = Inflector::camelize($model);
            $model = Inflector::underscore($model);
            $this->_crud_objects[$this->_crud_actual_object]['model_object_name'] = (strstr($model, 'Model_')) ? $model : 'Model_' . $model;
            $this->_crud_objects[$this->_crud_actual_object]['model_object_name'] = $this->_controller_namespace . '\\' . $this->_crud_objects[$this->_crud_actual_object]['model_object_name'];
        }

        $this->_crud_objects[$this->_crud_actual_object]['fixed_named_params'] = array();
        if (isset($crud['fixed_named_params']) && !empty($crud['fixed_named_params'])) {
            $this->_crud_objects[$this->_crud_actual_object]['fixed_named_params'] = $crud['fixed_named_params'];
        }
    }

    protected function _extract_model_options(array $my_options = array())
    {
        $this->_named_params = array_merge($this->_named_params, $this->_crud_objects[$this->_crud_actual_object]['fixed_named_params']);
        if($my_options != array()) {
            $this->_named_params = array_merge($this->_named_params, $my_options);
        }
        $this->_crud_objects[$this->_crud_actual_object]['options'] = array('where' => $this->_named_params);
    }

    protected function _action_list()
    {
        $this->_crud_filter();
        $this->_crud_order();
        $this->_paginate();
        $this->_crud_objects[$this->_crud_actual_object]['data'] = forward_static_call_array(array($this->_crud_objects[$this->_crud_actual_object]['model_object_name'], 'find'), array('all', $this->_crud_objects[$this->_crud_actual_object]['options']));
    }

    protected function _action_add()
    {
        $this->_action_create();
        $this->_save();
    }

    protected function _action_edit() {
        $this->_action_modfiy();
        $this->_check_data_not_empty();
        $this->_save();
    }

    protected function _action_show() {
        $this->_action_modfiy();
        $this->_check_data_not_empty();
    }

    protected function _action_delete() {
        $this->_action_modfiy();
        $this->_check_data_not_empty();
        $this->_delete();
    }

    protected function _action_modfiy()
    {
        $this->_crud_objects[$this->_crud_actual_object]['data'] = forward_static_call_array(array($this->_crud_objects[$this->_crud_actual_object]['model_object_name'], 'find'), array('first', $this->_crud_objects[$this->_crud_actual_object]['options']));
        $this->set_page_title(__(extend_locale('title'), array('extend' => $this->_crud_objects[$this->_crud_actual_object]['data']->__toString())));
    }

    protected function _save() {
        if (Input::post('save', false) || Input::post('save_next', false)) {
            /**
             * edit oder add
             */
            $form_data = Input::post();
            /**
             * für mehrfach formulare auf einer seite brauchen wir die kennung
             * dabei heißen die formularfelder zum beispiel customer[name], customer[street] etc.
             */
            $new_data = (isset($form_data[$this->_crud_actual_object]) && is_array($form_data[$this->_crud_actual_object])) ? $form_data[$this->_crud_actual_object] : $form_data;
            $this->_crud_objects[$this->_crud_actual_object]['data']->set($new_data);
            if ($this->_crud_objects[$this->_crud_actual_object]['data']->validate($new_data)) {
                $this->_crud_objects[$this->_crud_actual_object]['data']->save();
                Messages::instance()->success(__(extend_locale('success')));
                if (Input::post('save', false)) {
                    $redirect_uri = $this->_crud_redirect_uri;
                } else {
                    $redirect_uri = Uri::current();
                }
                Messages::redirect($redirect_uri);
            }
        }
    }

    protected function _check_data_not_empty()
    {
        if (in_array($this->_crud_action, array('show', 'edit', 'delete')) && empty($this->_crud_objects[$this->_crud_actual_object]['data'])) {
            throw new HttpNotFoundException;
        }
    }

    protected function _delete()
    {
        if (Input::post('delete', false)) {
            $this->_crud_objects[$this->_crud_actual_object]['data']->delete();
            Messages::instance()->success(__(extend_locale('success')));
            Messages::redirect($this->_crud_redirect_uri);
        }
    }

    protected function _iterate_crud_objects()
    {
        /**
         * @todo flexible iterator
         */
        foreach ($this->_crud_objects as $key => $crud) {

            if (!is_string($key)) {
                $this->_crud_actual_object = $crud;
            } else {
                $this->_crud_actual_object = $key;
            }

            $this->_extract_crud_object();
            $this->_extract_model_options();

            switch ($this->_crud_action) {
                case 'list':
                    $this->_action_list();
                    break;
                case 'add':
                    $this->_action_add();
                    break;
                case 'edit':
                    $this->_action_edit();
                    break;
                case 'show':
                    $this->_action_show();
                    break;
                case 'delete':
                    $this->_action_delete();
                    break;
            }
        }
    }

    protected function _paginate()
    {
        $this->_crud_objects[$this->_crud_actual_object]['data_cnt'] = forward_static_call_array(array($this->_crud_objects[$this->_crud_actual_object]['model_object_name'], 'count'), array($this->_crud_objects[$this->_crud_actual_object]['options']));
        $this->_crud_pagination_config[$this->_crud_actual_object] = array(
            'total_items' => $this->_crud_objects[$this->_crud_actual_object]['data_cnt'],
            'per_page' => 25,
            'pagination_url' => Uri::current(),
            'uri_segment' => 'page',
            'show_first' => true,
            'show_last' => true,
        );
        $this->_crud_pagination[$this->_crud_actual_object] = Pagination::forge($this->_crud_actual_object, $this->_crud_pagination_config[$this->_crud_actual_object]);
        $this->_crud_objects[$this->_crud_actual_object]['options']['limit'] = $this->_crud_pagination[$this->_crud_actual_object]->per_page;
        $this->_crud_objects[$this->_crud_actual_object]['options']['offset'] = $this->_crud_pagination[$this->_crud_actual_object]->offset;
    }

    protected function _action_create()
    {
        $this->_crud_objects[$this->_crud_actual_object]['data'] = forward_static_call_array(array($this->_crud_objects[$this->_crud_actual_object]['model_object_name'], 'forge'), array($this->_named_params));
    }

    /**
     * @param $properties
     */
    protected function _crud_filter()
    {

        if (is_callable(array($this->_crud_objects[$this->_crud_actual_object]['model_object_name'], 'properties'))) {
            /**
             * @todo bad? why not in the model?
             */
            $properties = forward_static_call(array($this->_crud_objects[$this->_crud_actual_object]['model_object_name'], 'properties'));
        }

        if ($filter_type = Input::get('filter_type', false) OR $filter_data = Input::get($this->_crud_actual_object, false)) {
            $not_filtered = array('filter_type', 'page', 'order', 'order_field', 'order_type');
            $cleaned_filter = array();
            if (!isset($filter_data)) {
                $filter_data = Input::get();
            }
            //ist der button und sollte entfernt werden
            foreach ($filter_data as $field_name => $value) {
                if (isset($properties) AND isset($properties[$field_name]) AND ($value = trim($value)) != '' AND !in_array($field_name, $not_filtered)) {
                    $field_value_pair = array($field_name => $value);
                    if ($filter_type == 'filter_like') {
                        $this->_crud_objects[$this->_crud_actual_object]['options']['where'] = array_merge($this->_crud_objects[$this->_crud_actual_object]['options']['where'], array(array($field_name, 'LIKE', '%' . $value . '%')));
                    } else {
                        $this->_crud_objects[$this->_crud_actual_object]['options']['where'] = array_merge($this->_crud_objects[$this->_crud_actual_object]['options']['where'], $field_value_pair);
                    }
                    $cleaned_filter = array_merge($cleaned_filter, $field_value_pair);
                }
            }
            $this->_crud_objects[$this->_crud_actual_object]['filter'] = $cleaned_filter;
        }
    }

    protected function _crud_order()
    {
        if ($get = Input::get()
            AND (isset($get['order']) OR isset($get[$this->_crud_actual_object]['order']))
                AND (isset($get['order_field']) OR isset($get[$this->_crud_actual_object]['order_field']))
                    AND (isset($get['order_type']) OR isset($get[$this->_crud_actual_object]['order_type']))
        ) {
            $order_field = isset($get['order_field']) ? $get['order_field'] : $get[$this->_crud_actual_object]['order_field'];
            $order_type = isset($get['order_type']) ? $get['order_type'] : $get[$this->_crud_actual_object]['order_type'];

            if (!empty($order_field) && !empty($order_type) && in_array(strtolower($order_type), array('asc', 'desc'))) {
                if (!isset($this->_crud_objects[$this->_crud_actual_object]['options']['order_by'])) {
                    $this->_crud_objects[$this->_crud_actual_object]['options']['order_by'] = array();
                }
                $this->_crud_objects[$this->_crud_actual_object]['options']['order_by'][] = array($order_field, strtoupper($order_type));
            }
        }
    }

}
