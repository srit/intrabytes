<?php
/**
 * @created 11.11.12 - 09:07
 * @author stefanriedel
 */

namespace Core;


class Model_Dashboard_Items_User extends \CachedModel
{

    protected static $_belongs_to = array(
        'dashboard_item' => array(
            'model_to' => '\Model_Dashboard_Item'
        ),
        'user' => array(
            'model_to' => '\Model_User'
        )
    );

}