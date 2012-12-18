<?php
/**
 * @created 09.11.12 - 13:19
 * @author stefanriedel
 */

Autoloader::add_core_namespace('Dashboard');

Autoloader::add_classes(array());

\Users\Model_User::add_relation(
    array(
        'many_many' => array(
            'dashboard_items' => array(
                'model_to' => 'Dashboard\Model_Dashboard_Item',
                'cascade_save' => true,
                'cascade_delete' => true,
            )
        ))

);