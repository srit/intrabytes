<?php
/**
 * @created 18.03.13 - 11:45
 * @author stefanriedel
 */

namespace Srit;


use Fuel\Core\Config;
use Fuel\Core\Request;
use Fuel\Core\Router;

class HttpNotFoundException extends \HttpException
{
    public function response()
    {
        $route = array_key_exists('_404_', Router::$routes) ? Router::$routes['_404_']->translation : Config::get(
            'routes._404_'
        );
        $response = Request::forge($route, false)->execute()->response();
        return $response;
        //return new \Response(\View::forge('404'), 404);
    }
}

class HttpServerErrorException extends \HttpException
{
    public function response()
    {
        return new \Response(\View::forge('500'), 500);
    }
}