<?php
/**
 * @created 22.10.12 - 13:39
 * @author stefanriedel
 */

return array(
    'top_left' => array(),
    'top_right' => array(
        'settings' => array(
            'route' => 'javascript: void(0)',
            'links' => array(
                'languages' => array(
                    'route' => core_settings_languages_list_route(),
                    'acl' => 'Core\\Settings_Languages.list',
                    'module' => 'core',
                    'controller_name' => 'settings_languages',
                    'action' => 'list',
                    'links' => array(
                        'languages_show' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'core',
                            'controller_name' => 'settings_languages',
                            'action' => 'show',
                            'show' => false
                        ),
                        'languages_edit' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'core',
                            'controller_name' => 'settings_languages',
                            'action' => 'edit',
                            'show' => false
                        ),
                        'languages_delete' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'core',
                            'controller_name' => 'settings_languages',
                            'action' => 'delete',
                            'show' => false
                        ),
                        'languages_add' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'core',
                            'controller_name' => 'settings_languages',
                            'action' => 'add',
                            'show' => false
                        ),
                        'locales_list' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_locales',
                            'action' => 'list',
                            'show' => false
                        ),
                        'locales_add' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_locales',
                            'action' => 'add',
                            'show' => false
                        ),
                        'locales_edit' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_locales',
                            'action' => 'edit',
                            'show' => false
                        ),
                        'locales_delete' => array(
                            'module' => 'core',
                            'controller_name' => 'settings_locales',
                            'action' => 'delete',
                            'show' => false
                        )
                    )
                ),
            )
        ),
    )
);