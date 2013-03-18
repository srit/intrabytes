<?php
/**
 * @created 12.02.13 - 20:26
 * @author stefanriedel
 */

return array(

    /**
     * Customers
     */
    'customers/list' => array('customers/list', 'name' => 'customers_list'),
    'customers/add' => array('customers/add', 'name' => 'customers_add'),
    'customers/edit/(:id)' => array('customers/edit', 'name' => 'customers_edit'),
    'customers/delete/(:id)' => array('customers/delete', 'name' => 'customers_delete'),
    'customers/show/(:id)' => array('customers/show', 'name' => 'customers_show'),

    /**
     * Contact Persons
     */
    'customers/customer_contacts/list/(:customer_id)' => array('customers/customer_contacts/list', 'name' => 'customers_customer_contacts_list'),
    'customers/customer_contacts/add/(:customer_id)' => array('customers/customer_contacts/add', 'name' => 'customers_customer_contacts_add'),
    'customers/customer_contacts/edit/(:customer_id)/(:id)' => array('customers/customer_contacts/edit', 'name' => 'customers_customer_contacts_edit'),
    'customers/customer_contacts/delete/(:customer_id)/(:id)' => array('customers/customer_contacts/delete', 'name' => 'customers_customer_contacts_delete'),
    'customers/customer_contacts/show/(:customer_id)/(:id)' => array('customers/customer_contacts/show', 'name' => 'customers_customer_contacts_show'),


    /**
     * Projects
     */
    'customers/projects/list/(:customer_id)' => array('customers/projects/list', 'name' => 'customers_projects_list'),
    'customers/projects/add/(:customer_id)' => array('customers/projects/add', 'name' => 'customers_projects_add'),
    'customers/projects/edit/(:customer_id)/(:id)' => array('customers/projects/edit', 'name' => 'customers_projects_edit'),
    'customers/projects/delete/(:customer_id)/(:id)' => array('customers/projects/delete', 'name' => 'customers_projects_delete'),
    'customers/projects/show/(:customer_id)/(:id)' => array('customers/projects/show', 'name' => 'customers_projects_show'),
);