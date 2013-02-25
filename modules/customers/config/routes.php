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
    'customers/projects/edit/(:customer_id)/(:id)' => 'customers/projects/edit/index/$1',
    'customers/projects/delete/(:customer_id)/(:id)' => 'customers/projects/delete/index/$1',
);