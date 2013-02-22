<?php
/**
 * @created 05.02.2013 - 11:10
 * @author stefanriedel
 */

namespace Customers;

class Controller_Projects extends \Core\Controller_Base_User {

    protected $_crud_objects = array(
        'customer_project' => array()
    );

    protected $_project_config = array();

    public function before() {
        parent::before();
        $this->_project_config = \Fuel\Core\Config::load('project', true);
        $this->_get_content_template()->set('project_config', $this->_project_config);
    }

}