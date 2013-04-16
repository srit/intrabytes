<?php
/**
 * @created 21.03.13 - 10:00
 * @author stefanriedel
 */

return array(
    'top_right' => array(
        'user_settings' => array(
            'route' => 'javascript: void(0)',
            'links' => array(
                'user_pubkey_settings' => array(
                    'route' => users_settings_pubkeys_list_route(),
                    'acl' => 'Users\\Settings_Pubkeys.list',
                    'module' => 'users',
                    'controller_name' => 'settings_pubkeys',
                    'action' => 'list'
                ),
                'users_settings_profile_edit' => array(
                    'acl' => 'Users\\Settings_Profile.edit',
                    'module' => 'users',
                    'controller_name' => 'settings_profile',
                    'action' => 'edit',
                )
            )
        ),
        'user_logout' => array(
            'route' => logout_route(),
            'acl' => 'Users\\Logout.index',
            'module' => 'users',
            'controller_name' => 'logout',
            'action' => 'index'
        )
    )
);