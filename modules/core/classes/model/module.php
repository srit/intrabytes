<?php
/**
 * @created 23.04.13 - 21:22
 * @author stefanriedel
 */

namespace Core;

use Srit\CachedModel;

class Model_Module extends CachedModel {

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => true,
        ),
    );

}