<?php
/**
 * @created 22.10.12 - 13:39
 * @author stefanriedel
 */

return array(
    'top_left' => array(
        'core_board' => array(
            'acl' => 'Dashboard\\Board.index',
            'module' => 'core',
            'controller_name' => 'board',
            'action' => 'index'
        )
    ),
    'top_right' => array(
        'settings' => array(
            'route' => 'javascript: void(0)',
            'links' => array(
                'core_settings_languages_list' => array(
                    'acl' => 'Core\\Settings_Languages.list',
                    'module' => 'core',
                    'controller_name' => 'settings_languages',
                    'action' => 'list',
                    'links' => array(
                        'core_settings_languages_show' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'core',
                            'controller_name' => 'settings_languages',
                            'action' => 'show',
                            'show' => false,
                            'named_params' => array(
                                'id'
                            )
                        ),
                        'core_settings_languages_edit' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'core',
                            'controller_name' => 'settings_languages',
                            'action' => 'edit',
                            'show' => false,
                            'named_params' => array(
                                'id'
                            )
                        ),
                        'core_settings_languages_delete' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'core',
                            'controller_name' => 'settings_languages',
                            'action' => 'delete',
                            'show' => false,
                            'named_params' => array(
                                'id'
                            )
                        ),
                        'core_settings_languages_add' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'core',
                            'controller_name' => 'settings_languages',
                            'action' => 'add',
                            'show' => false
                        ),
                    )
                ),
                'core_settings_locales_list' => array(
                    'module' => 'core',
                    'controller_name' => 'settings_locales',
                    'action' => 'list',
                    'show' => false,
                    'named_params' => array(
                        'language_id'
                    ),
                    'links' => array(
                        'core_settings_locales_add' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_locales',
                            'action' => 'add',
                            'show' => false,
                            'named_params' => array(
                                'language_id'
                            ),
                        ),
                        'core_settings_locales_edit' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_locales',
                            'action' => 'edit',
                            'show' => false,
                            'named_params' => array(
                                'language_id',
                                'id'
                            ),
                        ),
                        'core_settings_locales_delete' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_locales',
                            'action' => 'delete',
                            'show' => false,
                            'named_params' => array(
                                'language_id',
                                'id'
                            ),
                        )
                    )
                ),
            )
        ),
        'user_settings' => array(
            'links' => array(
                'core_settings_user' => array(
                    'acl' => 'Dashboard\\Settings_User.index',
                    'module' => 'core',
                    'controller_name' => 'settings_user',
                    'action' => 'index'
                )
            )
        )
    )
);