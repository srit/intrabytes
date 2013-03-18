<?php
/**
 * @created 18.03.13 - 12:06
 * @author stefanriedel
 */

function redmines_named_route($name, $route_params = array()) {
    $route_name = 'redmines_';
    $route_name .= $name;
    return named_route($route_name, $route_params);
}

function redmines_list_route() {
    $route_name = 'list';
    $route_params = array();
    return redmines_named_route($route_name, $route_params);
}

function redmines_add_route() {
    $route_name = 'add';
    $route_params = array();
    return redmines_named_route($route_name, $route_params);
}

function redmines_edit_route($id) {
    $route_name = 'edit';
    $route_params['id'] = (int)$id;
    return redmines_named_route($route_name, $route_params);
}

function redmines_delete_route($id) {
    $route_name = 'delete';
    $route_params['id'] = (int)$id;
    return redmines_named_route($route_name, $route_params);
}

function redmines_show_route($id) {
    $route_name = 'show';
    $route_params['id'] = (int)$id;
    return redmines_named_route($route_name, $route_params);
}