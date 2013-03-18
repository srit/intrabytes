<?php
/**
 * @created 18.03.13 - 08:26
 * @author stefanriedel
 */
function users_settings_pubkeys_named_route($name, $route_params = array()) {
    $route_name = 'users_settings_pubkeys_';
    $route_name .= $name;
    return named_route($route_name, $route_params);
}

function users_settings_pubkeys_list_route() {
    $route_name = 'list';
    $route_params = array();
    return users_settings_pubkeys_named_route($route_name, $route_params);
}

function users_settings_pubkeys_add_route() {
    $route_name = 'add';
    $route_params = array();
    return users_settings_pubkeys_named_route($route_name, $route_params);
}

function users_settings_pubkeys_edit_route($id) {
    $route_name = 'edit';
    $route_params['id'] = (int)$id;
    return users_settings_pubkeys_named_route($route_name, $route_params);
}

function users_settings_pubkeys_delete_route($id) {
    $route_name = 'delete';
    $route_params['id'] = (int)$id;
    return users_settings_pubkeys_named_route($route_name, $route_params);
}