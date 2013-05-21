<?php
/**
 * @created 13.05.13 - 13:04
 * @author stefanriedel
 */

namespace Srit;

class Controller_BaseBigTemplate extends Controller_BaseTemplate {

    protected $_navigation_template = 'templates/navbar';

    protected $_breadcrumb_template = 'templates/breadcrumb';

    protected $_last_pages_template = 'templates/last_pages';

    public function init()
    {
        parent::init();
        $this->_init_navigation();
        $this->_init_last_pages();
    }

    protected function _init_navigation()
    {
        $this->_get_theme()->set_partial('navigation', $this->_navigation_template);
        $this->_get_theme()->get_partial('navigation', $this->_navigation_template)->set('top_left', Navigation::forge('top_left'), false);
        $this->_get_theme()->get_partial('navigation', $this->_navigation_template)->set('top_right', Navigation::forge('top_right'), false);
        $this->_get_theme()->set_partial('breadcrumb', $this->_breadcrumb_template)->set('navigation', Navigation::instance(), false);
    }

    protected function _init_last_pages()
    {

        Last_Pages::setActivePageTitle($this->_page_title);
        Last_Pages::set();
        $this->_get_theme()->set_partial('last_pages', $this->_last_pages_template)->set('last_pages', Last_Pages::get());

    }

}