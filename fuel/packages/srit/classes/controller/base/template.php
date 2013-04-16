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
use Oil\Exception;
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

    protected $_last_controller_part = '';

    protected $_controller_path = '/';

    protected $_crud_objects = array();

    protected $_crud_action = null;

    protected $_crud_redirect_uri = null;

    protected $_pagination_config = array();


    protected $_page_title = null;

    /**
     * @var \Fuel\Core\Pagination
     */
    protected $_pagination = array();

    protected $_named_params = array();

    protected $_model_object_name = null;

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

    protected function _init_crud_objects()
    {

        Config::load('crud', true);
        $crud_options = Config::get('crud.default');
        $this->_init_crud_vars();

        if (Input::post('cancel', false)) {
            Messages::redirect(Uri::create($this->_crud_redirect_uri));
        }

        if (in_array($this->_crud_action, $crud_options['crud_actions'])) {

            foreach ($this->_crud_objects as $key => $crud) {

                //$this->_logger->debug('Crud Array', array($key, $crud));

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
                //$this->_logger->debug('Explode Crud', $explode_crud);

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
                    $this->_model_object_name = (strstr($model, 'Model_')) ? $model : 'Model_' . $model;
                    $this->_model_object_name = ucfirst($explode_crud[0]) . '\\' . $this->_model_object_name;
                } else {
                    list($model) = $explode_crud;
                    $model = Inflector::camelize($model);
                    $model = Inflector::underscore($model);
                    /**
                     * @todo fail - build objects!
                     */
                    $this->_model_object_name = (strstr($model, 'Model_')) ? $model : 'Model_' . $model;
                    $this->_model_object_name = $this->_controller_namespace . '\\' . $this->_model_object_name;
                }

                $fixed_named_params = array();

                if (isset($crud['fixed_named_params']) && !empty($crud['fixed_named_params'])) {
                    $fixed_named_params = $crud['fixed_named_params'];
                }

                $merged_named_params = array_merge($this->_named_params, $fixed_named_params);

                $options = array('where' => $merged_named_params);
                //$this->_logger->debug('Options:', $options);

                if ($this->_crud_action == 'list') {
                    if(is_callable(array($this->_model_object_name, 'properties'))) {
                        /**
                         * @todo bad? why not in the model?
                         */
                        $properties = forward_static_call(array($this->_model_object_name, 'properties'));
                    }
                    //list ist im moment die einzige action, welche ein find_all machen sollte

                    if ($filter_type = Input::get('filter_type', false) OR $filter_data = Input::get($crud_object, false)) {
                        $not_filtered = array('filter_type', 'page', 'order', 'order_field', 'order_type');
                        $cleaned_filter = array();
                        if(!isset($filter_data)) {
                            $filter_data = Input::get();
                        }
                        //ist der button und sollte entfernt werden
                        foreach ($filter_data as $field_name => $value) {
                            if (isset($properties) AND isset($properties[$field_name]) AND ($value = trim($value)) != '' AND !in_array($field_name, $not_filtered)) {
                                $field_value_pair = array($field_name => $value);
                                if ($filter_type == 'filter_like') {
                                    $options['where'] = array_merge($options['where'], array(array($field_name, 'LIKE', '%' . $value . '%')));
                                } else {
                                    $options['where'] = array_merge($options['where'], $field_value_pair);
                                }
                                $cleaned_filter = array_merge($cleaned_filter, $field_value_pair);
                            }
                        }
                        $this->_crud_objects[$crud_object]['filter'] = $cleaned_filter;
                    }

                    if($get = Input::get()
                        AND (isset($get['order']) OR isset($get[$crud_object]['order']))
                        AND (isset($get['order_field']) OR isset($get[$crud_object]['order_field']))
                        AND (isset($get['order_type']) OR isset($get[$crud_object]['order_type']))) {
                        $order_field = isset($get['order_field'] ) ? $get['order_field'] : $get[$crud_object]['order_field'];
                        $order_type = isset($get['order_type'] ) ? $get['order_type'] : $get[$crud_object]['order_type'];

                        if(!empty($order_field) && !empty($order_type) && in_array(strtolower($order_type), array('asc', 'desc'))) {
                            if(!isset($options['order_by'])) {
                                $options['order_by'] = array();
                            }
                            $options['order_by'][] = array($order_field, strtoupper($order_type));
                        }
                    }

                    $data_cnt = forward_static_call_array(array($this->_model_object_name, 'count'), array($options));

                    $this->_pagination_config[$crud_object] = array(
                        'total_items' => $data_cnt,
                        'per_page' => 25,
                        'pagination_url' => Uri::current(),
                        'uri_segment' => 'page',
                        'show_first' => true,
                        'show_last' => true,
                    );

                    $this->_pagination[$crud_object] = Pagination::forge($crud_object, $this->_pagination_config[$crud_object]);

                    $options['limit'] = $this->_pagination[$crud_object]->per_page;
                    $options['offset'] = $this->_pagination[$crud_object]->offset;

                    $data = forward_static_call_array(array($this->_model_object_name, 'find'), array('all', $options));
                } elseif ($this->_crud_action == 'add') {
                    $data = forward_static_call_array(array($this->_model_object_name, 'forge'), array($merged_named_params));
                } else {
                    $data = forward_static_call_array(array($this->_model_object_name, 'find'), array('first', $options));
                    //extend the title
                    $this->set_page_title(__(extend_locale('title'), array('extend' => $data->__toString())));
                }

                if (in_array($this->_crud_action, array('show', 'edit', 'delete')) && empty($data)) {
                    throw new HttpNotFoundException;
                }

                if (Input::post('save', false) || Input::post('save_next', false)) {
                    /**
                     * edit oder add
                     */

                    $form_data = Input::post();
                    /**
                     * für mehrfach formulare auf einer seite brauchen wir die kennung
                     * dabei heißen die formularfelder zum beispiel customer[name], customer[street] etc.
                     */
                    $new_data = (isset($form_data[$crud_object]) && is_array($form_data[$crud_object])) ? $form_data[$crud_object] : $form_data;
                    $data->set($new_data);
                    if ($data->validate($new_data)) {
                        $data->save();
                        Messages::instance()->success(__(extend_locale('success')));
                        if (Input::post('save', false)) {
                            $redirect_uri = $this->_crud_redirect_uri;
                        } else {
                            $redirect_uri = Uri::current();
                        }
                        Messages::redirect($redirect_uri);
                    }
                }

                if (Input::post('delete', false)) {
                    $data->delete();
                    Messages::instance()->success(__(extend_locale('success')));
                    Messages::redirect($this->_crud_redirect_uri);
                }

                $this->_crud_objects[$crud_object]['data'] = $data;
                $this->_crud_objects[$crud_object]['data_cnt'] = (isset($data_cnt)) ? $data_cnt : null;
            }


            $this->_get_content_template()
                ->set('crud_objects', $this->_crud_objects, false)
                ->set('pagination', $this->_pagination, false);

        }
    }

    protected function _init_crud_vars()
    {
        Config::load('crud', true);
        $crud_options = Config::get('crud.default');

        $expl_controller_without_controller_prefix = explode('_', $this->_controller_without_controller_prefix);
        $this->_last_controller_part = array_pop($expl_controller_without_controller_prefix);
        $this->_crud_action = (in_array($this->_controller_action, $crud_options['crud_actions'])) ? $this->_controller_action : strtolower($this->_last_controller_part);

        $route_prefix = str_replace(array($this->_crud_action, '/index'), array('list', ''), $this->_controller_path);
        $route_function_prefix = str_replace('/', '_', $route_prefix);
        $this->_crud_redirect_uri = named_route($route_function_prefix, $this->_named_params, false);

        if (empty($this->_crud_redirect_uri)) {
            //simple way
            $this->_crud_redirect_uri = Uri::create($route_prefix . '/' . implode('/', $this->_named_params));
        }

        $this->_get_content_template()
            ->set('last_controller_part', $this->_last_controller_part)
            ->set('crud_action', $this->_crud_action);

        //$this->_logger->debug('Crud Controller Data', array($this->_last_controller_part, $this->_crud_action, $this->_crud_list_uri));
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

}
