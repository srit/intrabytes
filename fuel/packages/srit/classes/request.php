<?php
/**
 * @created 27.03.13 - 12:16
 * @author stefanriedel
 */

namespace Srit;

class Request extends \Fuel\Core\Request
{

    public $controller_name = '';

    public function __construct($uri, $route = true, $method = null)
    {
        parent::__construct($uri, $route, $method);
        $this->controller_name = strtolower(str_replace(ucfirst($this->module).'\Controller_', '', $this->controller));
        if($this->action == null) {
            $this->action = 'index';
        }
    }
}