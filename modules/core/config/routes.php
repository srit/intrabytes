<?php
/**
 * @created 29.01.13 - 12:56
 * @author stefanriedel
 */

return array(

    'login' => array('core/login', 'name' => 'login'),
    'logout' => array('core/logout', 'name' => 'logout'),

    'core/dashboard' => array('core/dashboard/index', 'name' => 'core_dashboard'),
    'core/settings/user/dashboard' => array('core/settings/user/dashboard', 'name' => 'core_settings_user_dashboard'),
    'core/settings/user/profile/edit' => array('core/settings_user_profile/edit', 'name' => 'core_settings_user_profile_edit'),

    'core/settings/user/pubkeys/list' => array('core/settings/user/pubkeys/list', 'name' => 'core_settings_user_pubkeys_list'),
    'core/settings/user/pubkeys/add' => array('core/settings/user/pubkeys/add', 'name' => 'core_settings_user_pubkeys_add'),
    'core/settings/user/pubkeys/edit/(:id)' => array('core/settings/user/pubkeys/edit', 'name' => 'core_settings_user_pubkeys_edit'),
    'core/settings/user/pubkeys/delete/(:id)' => array('core/settings/user/pubkeys/delete', 'name' => 'core_settings_user_pubkeys_delete'),

    'core/navigation' => array('core/navigation/index', 'name' => 'core_navigation_index'),

    'core/settings/modules/list' => array('core/settings/modules/list', 'name' => 'core_modules_list'),

    'core/settings/locales/list' => array('core/settings/locales/list', 'name' => 'core_settings_locales_list'),
    'core/settings/locales/add' => array('core/settings/locales/add' , 'name' => 'core_settings_locales_add'),
    'core/settings/locales/edit/(:id)' => array('core/settings/locales/edit', 'name' => 'core_settings_locales_edit'),
    'core/settings/locales/delete/(:id)' => array('core/settings/locales/delete', 'name' => 'core_settings_locales_delete'),
    'core/settings/locales/deletes' => array('core/settings/locales/deletes', 'name' => 'core_settings_locales_deletes'),

    'core/settings/languages/list' => array('core/settings/languages/list', 'name' => 'core_settings_languages_list'),
    'core/settings/languages/add' => array('core/settings/languages/add', 'name' => 'core_settings_languages_add'),
    'core/settings/languages/edit/(:id)' => array('core/settings/languages/edit', 'name' => 'core_settings_languages_edit'),
    'core/settings/languages/delete/(:id)' => array('core/settings/languages/delete', 'name' => 'core_settings_languages_delete'),

);