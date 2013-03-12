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

function core_settings_languages_list_route() {
    $route_name = 'list';
    return core_settings_languages_named_route($route_name);
}

function core_settings_languages_edit_route($id) {
    $route_name = 'edit';
    $route_params['id'] = (int)$id;
    return core_settings_languages_named_route($route_name, $route_params);
}

function core_settings_languages_add_route() {
    $route_name = 'add';
    return core_settings_languages_named_route($route_name);
}

function core_settings_languages_delete_route($id) {
    $route_name = 'delete';
    $route_params['id'] = (int)$id;
    return core_settings_languages_named_route($route_name, $route_params);
}

function core_settings_locales_list_route($language_id) {
    $route_name = 'list';
    $route_params['language_id'] = (int)$language_id;
    return core_settings_locales_named_route($route_name, $route_params);
}

function core_settings_locales_add_route($language_id) {
    $route_name = 'add';
    $route_params['language_id'] = (int)$language_id;
    return core_settings_locales_named_route($route_name, $route_params);
}

function core_settings_locales_edit_route($id, $language_id) {
    $route_name = 'edit';
    $route_params['language_id'] = (int)$language_id;
    $route_params['id'] = $id;
    return core_settings_locales_named_route($route_name, $route_params);
}

function core_settings_locales_delete_route($id, $language_id) {
    $route_name = 'delete';
    $route_params['language_id'] = (int)$language_id;
    $route_params['id'] = $id;
    return core_settings_locales_named_route($route_name, $route_params);
}