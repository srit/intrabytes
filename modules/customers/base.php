<?php
/**
 * @created 15.03.13 - 10:16
 * @author stefanriedel
 */

function customers_named_route($name, $route_params = array()) {
    $route_name = 'customers_';
    $route_name .= $name;
    return named_route($route_name, $route_params);
}

function customers_list_route() {
    $route_name = 'list';
    $route_params = array();
    return customers_named_route($route_name, $route_params);
}

function customers_add_route() {
    $route_name = 'add';
    $route_params = array();
    return customers_named_route($route_name, $route_params);
}

function customers_edit_route($id) {
    $route_name = 'edit';
    $route_params['id'] = (int)$id;
    return customers_named_route($route_name, $route_params);
}

function customers_delete_route($id) {
    $route_name = 'delete';
    $route_params['id'] = (int)$id;
    return customers_named_route($route_name, $route_params);
}

function customers_show_route($id) {
    $route_name = 'show';
    $route_params['id'] = (int)$id;
    return customers_named_route($route_name, $route_params);
}

function customers_projects_named_route($name, $route_params = array()) {
    $route_name = 'projects_';
    $route_name .= $name;
    return customers_named_route($route_name, $route_params);
}


function customers_projects_edit_route($id, $customer_id) {
    $route_name = 'edit';
    $route_params['customer_id'] = (int)$customer_id;
    $route_params['id'] = (int)$id;
    return customers_projects_named_route($route_name, $route_params);
}

function customers_projects_delete_route($id, $customer_id) {
    $route_name = 'delete';
    $route_params['customer_id'] = (int)$customer_id;
    $route_params['id'] = (int)$id;
    return customers_projects_named_route($route_name, $route_params);
}

function customers_projects_show_route($id, $customer_id) {
    $route_name = 'show';
    $route_params['customer_id'] = (int)$customer_id;
    $route_params['id'] = (int)$id;
    return customers_projects_named_route($route_name, $route_params);
}

function customers_projects_list_route($customer_id) {
    $route_name = 'list';
    $route_params['customer_id'] = (int)$customer_id;
    return customers_projects_named_route($route_name, $route_params);
}

function customers_projects_add_route($customer_id) {
    $route_name = 'add';
    $route_params['customer_id'] = (int)$customer_id;
    return customers_projects_named_route($route_name, $route_params);
}

/**
 * Customer Projects
 */
function customers_customer_contacts_named_route($name, $route_params = array()) {
    $route_name = 'customer_contacts_';
    $route_name .= $name;
    return customers_named_route($route_name, $route_params);
}


function customers_customer_contacts_edit_route($id, $customer_id) {
    $route_name = 'edit';
    $route_params['customer_id'] = (int)$customer_id;
    $route_params['id'] = (int)$id;
    return customers_customer_contacts_named_route($route_name, $route_params);
}

function customers_customer_contacts_delete_route($id, $customer_id) {
    $route_name = 'delete';
    $route_params['customer_id'] = (int)$customer_id;
    $route_params['id'] = (int)$id;
    return customers_customer_contacts_named_route($route_name, $route_params);
}

function customers_customer_contacts_show_route($id, $customer_id) {
    $route_name = 'show';
    $route_params['customer_id'] = (int)$customer_id;
    $route_params['id'] = (int)$id;
    return customers_customer_contacts_named_route($route_name, $route_params);
}

function customers_customer_contacts_list_route($customer_id) {
    $route_name = 'list';
    $route_params['customer_id'] = (int)$customer_id;
    return customers_customer_contacts_named_route($route_name, $route_params);
}

function customers_customer_contacts_add_route($customer_id) {
    $route_name = 'add';
    $route_params['customer_id'] = (int)$customer_id;
    return customers_customer_contacts_named_route($route_name, $route_params);
}