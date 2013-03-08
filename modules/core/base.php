<?php
/**
 * @created 08.03.13 - 10:50
 * @author stefanriedel
 */

function core_named_route($name, $route_params = array()) {
    $route_name = 'core_';
    $route_name .= $name;
    return named_route($route_name, $route_params);
}

function core_settings_named_route($name, $route_params = array()) {
    $route_name = 'settings_';
    $route_name .= $name;
    return core_named_route($route_name, $route_params);
}

function core_settings_languages_named_route($name, $route_params = array()) {
    $route_name = 'languages_';
    $route_name .= $name;
    return core_settings_named_route($route_name, $route_params);
}

function core_settings_locales_named_route($name, $route_params = array()) {
    $route_name = 'locales_';
    $route_name .= $name;
    return core_settings_named_route($route_name, $route_params);
}

function core_settings_languages_list_route($route_params = array()) {
    $route_name = 'list';
    return core_settings_languages_named_route($route_name, $route_params);
}

function core_settings_languages_edit_route($route_params = array()) {
    $route_name = 'edit';
    return core_settings_languages_named_route($route_name, $route_params);
}

function core_settings_languages_add_route($route_params = array()) {
    $route_name = 'add';
    return core_settings_languages_named_route($route_name, $route_params);
}

function core_settings_languages_delete_route($route_params = array()) {
    $route_name = 'delete';
    return core_settings_languages_named_route($route_name, $route_params);
}

function core_settings_locales_list_route($route_params) {
    $route_name = 'list';
    return core_settings_locales_named_route($route_name, $route_params);
}

function core_settings_locales_add_route($route_params) {
    $route_name = 'add';
    return core_settings_locales_named_route($route_name, $route_params);
}

function core_settings_locales_edit_route($route_params) {
    $route_name = 'edit';
    return core_settings_locales_named_route($route_name, $route_params);
}

function core_settings_locales_delete_route($route_params) {
    $route_name = 'delete';
    return core_settings_locales_named_route($route_name, $route_params);
}