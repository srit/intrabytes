<?php
/**
 * @created 18.03.13 - 14:54
 * @author stefanriedel
 */

return array(
    'top_left' => array(
        'dashboard_board' => array(
            'acl' => 'Dashboard\\Board.index',
            'module' => 'dashboard',
            'controller_name' => 'board',
            'action' => 'index'
        )
    ),
    'top_right' => array(
        'user_settings' => array(
            'links' => array(
                'dashboard_settings_user' => array(
                    'acl' => 'Dashboard\\Settings_User.index',
                    'module' => 'dashboard',
                    'controller_name' => 'settings_user',
                    'action' => 'index'
                )
            )
        )
    )
);