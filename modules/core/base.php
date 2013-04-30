<?php
/**
 * @created 08.03.13 - 10:50
 * @author stefanriedel
 */


/**
 * @todo ins routing auslagern
 */



function base_route() {
    return \Fuel\Core\Uri::create('/');
}

function logout_route() {
    return \Fuel\Core\Uri::create('/logout');
}

function login_route() {
    return \Fuel\Core\Uri::create('/login');
}


function forget_password_route() {
    return \Fuel\Core\Uri::create('/core/password/forget');
}

function confirmed_email_password_route($hash) {
    \Fuel\Core\Uri::create('/users/password/confirmed_email/:hash', array('hash' => $hash));
}

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

function core_settings_locales_list_route() {
    $route_name = 'list';
    return core_settings_locales_named_route($route_name);
}

function core_settings_locales_add_route() {
    $route_name = 'add';
    return core_settings_locales_named_route($route_name);
}

function core_settings_locales_edit_route($id) {
    $route_name = 'edit';
    $route_params['id'] = (int)$id;
    return core_settings_locales_named_route($route_name, $route_params);
}

function core_settings_locales_delete_route($id) {
    $route_name = 'delete';
    $route_params['id'] = (int)$id;
    return core_settings_locales_named_route($route_name, $route_params);
}

function core_settings_locales_deletes_route() {
    $route_name = 'deletes';
    return core_settings_locales_named_route($route_name);
}

function twitter_translate_textareas($name, $model) {
    $languages = \Srit\Model_Language::find_all_active();
    $textareas = array();
    if($languages) {
        foreach($languages as $language) {
            $textarea_name = $name . '_' . $language->language;
            $value = (!empty($model->{$textarea_name})) ? $model->{$textarea_name} : '';
            $textareas[$textarea_name] = array(
                'language' => $language->language,
                'textarea' => twitter_html_input_textarea_wo_label($textarea_name, $value)
            );
        }
    }
    return \Srit\Theme::instance()->view('templates/_partials/form/translate_textareas.php', array('textareas' => $textareas, 'tab_id' => 'tab_' . $name), false);
}

function core_users_settings_pubkeys_named_route($name, $route_params = array()) {
    $route_name = 'core_users_settings_pubkeys_';
    $route_name .= $name;
    return named_route($route_name, $route_params);
}

function core_users_settings_pubkeys_list_route() {
    $route_name = 'list';
    $route_params = array();
    return core_users_settings_pubkeys_named_route($route_name, $route_params);
}

function core_users_settings_pubkeys_add_route() {
    $route_name = 'add';
    $route_params = array();
    return core_users_settings_pubkeys_named_route($route_name, $route_params);
}

function core_users_settings_pubkeys_edit_route($id) {
    $route_name = 'edit';
    $route_params['id'] = (int)$id;
    return core_users_settings_pubkeys_named_route($route_name, $route_params);
}

function core_users_settings_pubkeys_delete_route($id) {
    $route_name = 'delete';
    $route_params['id'] = (int)$id;
    return core_users_settings_pubkeys_named_route($route_name, $route_params);
}
