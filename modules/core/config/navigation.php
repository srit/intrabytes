<?php
/**
 * @created 22.10.12 - 13:39
 * @author stefanriedel
 */

return array(
    'main' => array(
        'dashboard' => array(
            'route' => \Fuel\Core\Router::get('_root_'),
            'label' => '<i class="icon-dashboard"></i> ' . __('Dashboard'),
        ),
        'settings' => array(
            'route' => 'javascript: void(0)',
            'label' => '<i class="icon-wrench"></i> ' . __('Einstellungen'),
            'links' => array(
                'mandants' => array(
                    'route' => array(
                        'route' => 'mandants/list',
                        'label' => '<i class="icon-briefcase"></i> ' . __('Mandanten')
                    )
                ),
                'users' => array(
                    'route' => 'users/list',
                    'label' => '<i class="icon-user"></i> ' . __('Nutzer'),
                )
            )
        )
    )
);