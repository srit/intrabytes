<?php
/**
 * @created 11.11.12 - 09:07
 * @author stefanriedel
 */

namespace Core;

use Srit\CachedModel;

class Model_Dashboard_Items_User extends CachedModel
{

    protected static $_properties = array(
        'id',
        'dashboard_item_id',
        'user_id',
        'order',
    );

    protected static $_belongs_to = array(
        'dashboard_item',
        'user' => array(
            'model_to' => 'Srit\Model_User'
        )
    );

}