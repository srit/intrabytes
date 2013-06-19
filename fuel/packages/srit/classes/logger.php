<?php
/**
 * @created 13.03.13 - 21:13
 * @author stefanriedel
 */

namespace Srit;
use Monolog\Handler\ChromePHPHandler;

class Logger extends \Monolog\Logger {

    protected static $_instances = array();

    /**
     * @param string $name
     * @return Logger
     */
    public static function forge($name = 'default') {

        if(!isset(static::$_instances[$name])) {
            $instance = new static($name);
            $config = \Config::get('logger');
            $log_level = isset($config['level']) ? $config['level'] : static::ERROR;

            if(isset($config['handler'])) {
                foreach($config['handler'] as $handler) {
                    if($handler instanceof \Monolog\Handler\AbstractHandler) {
                        $instance->pushHandler($handler);
                    } elseif(class_exists($handler)) {
                        $instance->pushHandler(new $handler($log_level));
                    }
                }
            }
            static::$_instances[$name] = $instance;
        }
        return static::$_instances[$name];
    }

}