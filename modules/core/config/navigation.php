<?php
/**
 * @created 22.10.12 - 13:39
 * @author stefanriedel
 */

return array(
    'top_left' => array(

        'core_customers_list' => array(
            'acl' => 'Core\\Customers_List.index',
            'module' => 'core',
            'controller_name' => 'customers_list',
            'action' => 'index',
            'links' => array(
                'core_customers_show' => array(
                    //'route' => customers_show_route(2),
                    'acl' => 'Core\\Customers_Show.index',
                    'module' => 'core',
                    'controller_name' => 'customers_show',
                    'action' => 'index',
                    'show' => false,
                    'named_params' => array(
                        'id'
                    )
                ),
                'core_customers_edit' => array(
                    //'route' => customers_show_route(2),
                    'acl' => 'Core\\Customers_Edit.index',
                    'module' => 'core',
                    'controller_name' => 'customers_edit',
                    'action' => 'index',
                    'show' => false,
                    'named_params' => array(
                        'id'
                    )
                ),
                'core_customers_delete' => array(
                    //'route' => customers_show_route(2),
                    'acl' => 'Core\\Customers_Delete.index',
                    'module' => 'core',
                    'controller_name' => 'customers_delete',
                    'action' => 'index',
                    'show' => false,
                    'named_params' => array(
                        'id'
                    )
                ),
                'core_customers_add' => array(
                    //'route' => customers_show_route(2),
                    'acl' => 'Core\\Customers_Add.index',
                    'module' => 'core',
                    'controller_name' => 'customers_add',
                    'action' => 'index',
                    'show' => false
                ),
                'core_customers_projects_list' => array(
                    //'route' => customers_show_route(2),
                    'acl' => 'Core\\Customers_Projects_List.index',
                    'module' => 'core',
                    'controller_name' => 'customers_projects_list',
                    'action' => 'index',
                    'show' => false,
                    'named_params' => array(
                        'customer_id'
                    ),
                    'links' => array(
                        'core_customers_projects_show' => array(
                            //'route' => customers_show_route(2),
                            'acl' => 'Core\\Customers_Projects_Show.index',
                            'module' => 'core',
                            'controller_name' => 'customers_projects_show',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'customer_id',
                                'id'
                            )
                        ),
                        'core_customers_projects_edit' => array(
                            //'route' => customers_show_route(2),
                            'acl' => 'Core\\Customers_Projects_Edit.index',
                            'module' => 'core',
                            'controller_name' => 'customers_projects_edit',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'customer_id',
                                'id'
                            )
                        ),
                        'core_customers_projects_delete' => array(
                            //'route' => customers_show_route(2),
                            'acl' => 'Core\\Customers_Projects_Delete.index',
                            'module' => 'core',
                            'controller_name' => 'customers_projects_delete',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'customer_id',
                                'id'
                            )
                        ),
                        'core_customers_projects_add' => array(
                            //'route' => customers_show_route(2),
                            'acl' => 'Core\\Customers_Projects_Add.index',
                            'module' => 'core',
                            'controller_name' => 'customers_projects_add',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'customer_id'
                            )
                        )
                    )
                )
            )
        ),

        'core_dashboard' => array(
            'acl' => 'Core\\Dashboard.index',
            'module' => 'core',
            'controller_name' => 'dashboard',
            'action' => 'index'
        )
    ),
    'top_right' => array(
        'core_user_logout' => array(
            'route' => 'logout',
            'acl' => 'Core\\Logout.index',
            'module' => 'core',
            'controller_name' => 'logout',
            'action' => 'index'
        ),
        'settings' => array(
            'route' => 'javascript: void(0)',
            'links' => array(
                'core_settings_locales_list' => array(
                    'acl' => 'Core\\Settings_Locales.list',
                    'module' => 'core',
                    'controller_name' => 'settings_locales',
                    'action' => 'list',
                    'links' => array(
                        'core_settings_locales_add' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_locales',
                            'action' => 'add',
                            'show' => false,
                        ),
                        'core_settings_locales_edit' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_locales',
                            'action' => 'edit',
                            'show' => false,
                            'named_params' => array(
                                'id'
                            ),
                        ),
                        'core_settings_locales_delete' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_locales',
                            'action' => 'delete',
                            'show' => false,
                            'named_params' => array(
                                'id'
                            ),
                        )
                    )
                ),
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
            )
        ),
        'user_settings' => array(
            'route' => 'javascript: void(0)',
            'links' => array(
                'core_settings_user_pubkeys_list' => array(
                    'acl' => 'Core\\Settings_User_Pubkeys.list',
                    'module' => 'core',
                    'controller_name' => 'settings_user_pubkeys',
                    'action' => 'list',
                    'links' => array(
                        'core_settings_user_pubkeys_edit' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_user_pubkeys',
                            'action' => 'edit',
                            'show' => false,
                            'named_params' => array(
                                'id'
                            ),
                        ),
                        'core_settings_user_pubkeys_delete' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_user_pubkeys',
                            'action' => 'delete',
                            'show' => false,
                            'named_params' => array(
                                'id'
                            ),
                        ),
                    )
                ),
                'core_settings_user_profile_edit' => array(
                    'acl' => 'Core\\Settings_User_Profile.edit',
                    'module' => 'core',
                    'controller_name' => 'settings_user_profile',
                    'action' => 'edit',
                ),
                'core_settings_user_dashboard' => array(
                    'acl' => 'Core\\Settings_User.dashboard',
                    'module' => 'core',
                    'controller_name' => 'settings_user',
                    'action' => 'dashboard'
                )
            )
        )
    )
);