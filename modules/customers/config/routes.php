<?php
/**
 * @created 12.02.13 - 20:26
 * @author stefanriedel
 */

return array(
    'customers/projects/list/(:customer_id)' => 'customers/projects/list/index/$1',
    'customers/projects/add/(:customer_id)' => 'customers/projects/add/index/$1',
    'customers/projects/edit/(:customer_id)/(:project_id)' => 'customers/projects/edit/index/$1',
    'customers/projects/delete/(:customer_id)/(:project_id)' => 'customers/projects/delete/index/$1',
);