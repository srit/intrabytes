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

function customers_projects_named_route($name, $route_params = array()) {
    $route_name = 'projects_';
    $route_name .= $name;
    return customers_named_route($route_name, $route_params);
}


function customers_projects_edit_route($id, $customer_id) {
    $route_name = 'edit';
    $route_params['customer_id'] = (int)$customer_id;
    $route_params['id'] = $id;
    return customers_projects_named_route($route_name, $route_params);
}

function customers_projects_delete_route($id, $customer_id) {
    $route_name = 'delete';
    $route_params['customer_id'] = (int)$customer_id;
    $route_params['id'] = $id;
    return customers_projects_named_route($route_name, $route_params);
}