<?php
/**
 * @created 13.05.13 - 11:13
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Fuel;
use Fuel\Core\Response;
use Fuel\Core\View;

class Controller_BaseTemplate extends Controller_Base
{

    public $template = 'templates/layout';

    protected $_locale_prefix = null;

    protected $_controller_path = '/';

    protected $_controller_path_prefix = '';

    protected $_page_title = null;

    protected $_named_params = array();

    protected $_theme = null;

    public function init()
    {
        parent::init();
        $this->_init_theme();
        $this->_init_extra_controller_vars();
        $this->_init_locale();
        $this->_init_controller_template_vars();
    }

    public function after($response)
    {
        if (empty($response)) {
            $response = Response::forge($this->_theme);
        }

        if (!$response instanceof Response) {
            $response = Response::forge($response);
        }

        Theme::clear($this->template);
        return $response;
        /**if (empty($response))
        {
        $response = $this->_get_template();
        }**/
    }

    public function set_page_title($page_title)
    {
        $this->_page_title = $page_title;
        $this->_get_template()->set('title', $this->_get_page_title());
    }

    protected function _init_controller_template_vars()
    {
        $this->_get_theme()->set_templates_path_prefix($this->_controller_path_prefix);
        $this->_get_theme()->set_partial('content', $this->_controller_path)
            ->set('controller_namespace', $this->_controller_namespace)
            ->set('controller_without_controller_prefix', $this->_controller_without_controller_prefix)
            ->set('controller_action', $this->_controller_action)
            ->set('controller_path', $this->_controller_path)
            ->set('locale_prefix', $this->_locale_prefix);
        if (!empty($this->_named_params)) {
            foreach ($this->_named_params as $name => $value) {
                $this->_get_content_partial()->set($name, $value);
            }
        }
        $this->set_page_title(__ext('title'));

        $additional_js = array();
        $module_js_path = 'modules/' . $this->_controller_namespace_lowercased . '.js';
        $controller_js_path = 'modules/' . $this->_controller_namespace_lowercased . '/' . $this->_controller_without_controller_prefix_lowercased . '.js';
        $action_js_path = 'modules/' . $this->_controller_namespace_lowercased . '/' . $this->_controller_without_controller_prefix_lowercased . '/' . $this->_controller_action . '.js';

        if ($this->_theme->asset->find_file($module_js_path, 'js')) {
            $additional_js[] = $module_js_path;
        }

        if ($this->_theme->asset->find_file($controller_js_path, 'js')) {
            $additional_js[] = $controller_js_path;
        }

        if ($this->_theme->asset->find_file($action_js_path, 'js')) {
            $additional_js[] = $action_js_path;
        }

        if ($this->_theme->asset->find_file(Fuel::$env . '.js', 'js')) {
            $additional_js[] = Fuel::$env . '.js';
        }

        $this->_get_template()->set('additional_js', $additional_js);

    }

    protected function _init_locale()
    {
        $this->_locale_prefix = str_replace('/', '.', $this->_controller_path);
        Locale::instance()->setLocalePrefix($this->_locale_prefix);
    }

    protected function _init_theme()
    {
        $this->_set_theme(Theme::instance($this->template));
        set_theme_instance($this->_get_theme());
        $this->_get_theme()->set_template($this->template);
        $this->_get_template()->set_global('theme', $this->_theme, false);

        $additional_view_dir = ROOT . DS . 'modules' . DS . $this->request->module . DS;
        if (!empty($this->request->module) && is_dir($additional_view_dir)) {
            $this->_theme->add_paths(array(ROOT . 'modules' . DS . $this->request->module . DS));
        }
    }

    protected function _init_extra_controller_vars()
    {
        $this->_controller_path_prefix = strtolower($this->_controller_namespace . '/');
        $this->_controller_path = strtolower($this->_controller_path_prefix . str_replace('_', '/', $this->_controller_without_controller_prefix) . '/' . $this->_controller_action);
        $this->_named_params = $this->request->named_params;
    }

    /**
     * @return View
     */
    protected function _get_content_partial()
    {
        return $this->_get_theme()->get_partial('content', $this->_controller_path);
    }

    /**
     * @return View
     */
    protected function _get_template()
    {
        return $this->_get_theme()->get_template($this->template);
    }

    /**
     * @return string
     */
    protected function & _get_page_title()
    {
        return $this->_page_title;
    }

    /**
     * @return Theme
     */
    protected function _get_theme()
    {
        return $this->_theme;
    }

    /**
     * @param $theme Theme
     */
    protected function _set_theme($theme)
    {
        $this->_theme = $theme;
    }


}