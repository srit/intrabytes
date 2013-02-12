<?php

namespace Core;

class Controller_Base_Template extends \Controller_Template
{
    public $template = 'templates/layout';

    protected $_locale_prefix = null;

    /**
     * @var \Theme
     */
    protected $_theme_instance = null;

    public $date_format = 'de';

    public $navbars = array();

    public function before() {

        if(\Input::is_ajax()) {
            return parent::before();
        }

        /**
         * CSRF Token ist falsch, POST Variablen löschen!
         */
        if(\Fuel\Core\Request::active()->get_method() == 'POST' && false == \Security::check_token()) {
            Messages::error(__('validation.form.invalid'));
            foreach($_POST as $key => $value) {
                unset($_POST[$key]);
            }
        }


        Theme::instance($this->template)->set_template($this->template)->set_global('theme', Theme::instance($this->template), false);


        $additional_view_dir = ROOT . DS . 'modules' . DS . $this->request->module . DS;
        if(!empty($this->request->module) && is_dir($additional_view_dir)) {
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
    }

    public function after($response) {
        if ( ! \Input::is_ajax())
        {
            // If nothing was returned set the theme instance as the response
            if (empty($response))
            {
                $response = \Response::forge(Theme::instance($this->template));
            }

            if ( ! $response instanceof Response)
            {
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

}
