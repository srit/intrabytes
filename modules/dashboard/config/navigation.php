<?php
/**
 * @created 18.03.13 - 14:54
 * @author stefanriedel
 */

return array(
    'top_left' => array(
        'dashboard' => array(
            'route' => dashboard_route(),
            'acl' => 'Dashboard\\Board.index'
        )
    ),
    'top_right' => array(
        'user_settings' => array(
            'links' => array(
                'dashboard_settings' => array(
                    'route' => named_route('dashboard_settings_user'),
                    'acl' => 'Dashboard\\Settings_User.index'
                )
            )
        )
    )
);