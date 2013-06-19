<?php
/**
 * @created 17.05.13 - 16:15
 * @author stefanriedel
 */

return array(

    /**
     * ----------------------------------------------------------------------
     * global settings
     * ----------------------------------------------------------------------
     */

    // default storage driver
    'driver'      => 'memcached',

    // default expiration (null = no expiration)
    'expiration'  => null,

    // specific configuration settings for the memcached driver
    'memcached'  => array(
        'cache_id'  => 'intrabytes',  // unique id to distinquish fuel cache items from others stored on the same server(s)
        'servers'   => array(   // array of servers and portnumbers that run the memcached service
            'default' => array('host' => '127.0.0.1', 'port' => 11211, 'weight' => 100)
        ),
    ),

);