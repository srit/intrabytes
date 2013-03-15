<?php
/**
 * @created 12.02.13 - 20:26
 * @author stefanriedel
 */

return array(
    'customers/list/(:any)' => 'customers/list',
    'customers/projects/list/(:customer_id)/(:any)' => 'customers/projects/list/index/$1',
    'customers/projects/list/(:customer_id)' => 'customers/projects/list/index/$1',
    'customers/projects/add/(:customer_id)' => 'customers/projects/add/index/$1',

    'customers/projects/edit/(:customer_id)/(:id)' => array('customers/projects/edit', 'name' => 'customers_projects_edit'),
    'customers/projects/delete/(:customer_id)/(:id)' => array('customers/projects/delete', 'name' => 'customers_projects_delete'),

    'customers/projects/show/(:customer_id)/(:id)' => 'customers/projects/show/index/$1/$2',
);