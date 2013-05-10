<?php
/**
 * @created 18.03.13 - 16:01
 * @author stefanriedel
 */

return array(
    'top_left' => array(
        'customers' => array(
            'route' => customers_list_route(),
            'acl' => 'Customers\\List.index',
            'module' => 'customers',
            'controller_name' => 'list',
            'action' => 'index',
            'links' => array(
                'customers_show' => array(
                    //'route' => customers_show_route(2),
                    //'acl' => 'Customers\\Show.index',
                    'module' => 'customers',
                    'controller_name' => 'show',
                    'action' => 'index',
                    'show' => false,
                    'named_params' => array(
                        'id'
                    )
                ),
                'customers_edit' => array(
                    //'route' => customers_show_route(2),
                    //'acl' => 'Customers\\Show.index',
                    'module' => 'customers',
                    'controller_name' => 'edit',
                    'action' => 'index',
                    'show' => false,
                    'named_params' => array(
                        'id'
                    )
                ),
                'customers_delete' => array(
                    //'route' => customers_show_route(2),
                    //'acl' => 'Customers\\Show.index',
                    'module' => 'customers',
                    'controller_name' => 'delete',
                    'action' => 'index',
                    'show' => false,
                    'named_params' => array(
                        'id'
                    )
                ),
                'customers_add' => array(
                    //'route' => customers_show_route(2),
                    //'acl' => 'Customers\\Show.index',
                    'module' => 'customers',
                    'controller_name' => 'add',
                    'action' => 'index',
                    'show' => false
                ),
                'customers_projects_list' => array(
                    //'route' => customers_show_route(2),
                    //'acl' => 'Customers\\Show.index',
                    'module' => 'customers',
                    'controller_name' => 'projects_list',
                    'action' => 'index',
                    'show' => false,
                    'named_params' => array(
                        'customer_id'
                    ),
                    'links' => array(
                        'customers_projects_show' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'customers',
                            'controller_name' => 'projects_show',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'customer_id',
                                'id'
                            )
                        ),
                        'customers_projects_edit' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'customers',
                            'controller_name' => 'projects_edit',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'customer_id',
                                'id'
                            )
                        ),
                        'customers_projects_delete' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'customers',
                            'controller_name' => 'projects_delete',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'customer_id',
                                'id'
                            )
                        ),
                        'customers_projects_add' => array(
                            //'route' => customers_show_route(2),
                            //'acl' => 'Customers\\Show.index',
                            'module' => 'customers',
                            'controller_name' => 'projects_add',
                            'action' => 'index',
                            'show' => false,
                            'named_params' => array(
                                'customer_id'
                            )
                        )
                    )
                )
            )
        )
    )
);