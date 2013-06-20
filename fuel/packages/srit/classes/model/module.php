<?php

namespace Srit;

class Model_Module extends \CachedModel
{
    protected static $_observers = array(
        '\Observer_Translated' => array(
            'properties' => array('title', 'description')
        ),
        '\Observer_Serialized' => array(
            'properties' => array(
                'config'
            )
        ),
    );

    public static function is_active($module_name) {
        $options = array(
            'where' => array(
                'active' => 1,
                'name' => (string)$module_name
            )
        );
        $data = static::find('first', $options);
        return $data ? : false;
    }

    public static function find_active() {
        $options = array(
            'where' => array(
                'active' => 1,

            ),
            'order_by' => array('sort' => 'DESC')
        );
        return static::find_all($options);
    }

    public static function find($id = null, array $options = array()) {
        if(!isset($options['order_by'])) {
            $options = array_merge($options, array('order_by' => 'sort'));
        }
        return parent::find($id, $options);
    }

    public function __toString() {
        return $this->get_name();
    }


    /**
     * @return array|mixed
     * @todo observer für cached verfügbar machen!
     */
    public function get_config() {
        $config = $this->get('config');
        if(!is_array($config)) {
            $config = unserializer($config);
        }
        return $config;
    }

}
