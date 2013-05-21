<?php
/**
 * @created 29.01.13 - 12:56
 * @author stefanriedel
 */

return array(

    /**
     * Customers
     */
    'core/customers/list' => array('core/customers/list', 'name' => 'core_customers_list'),
    'core/customers/add' => array('core/customers/add', 'name' => 'core_customers_add'),
    'core/customers/edit/(:id)' => array('core/customers/edit', 'name' => 'core_customers_edit'),
    'core/customers/delete/(:id)' => array('core/customers/delete', 'name' => 'core_customers_delete'),
    'core/customers/show/(:id)' => array('core/customers/show', 'name' => 'core_customers_show'),

    /**
     * Contact Persons
     */
    'core/customers/contacts/list/(:customer_id)' => array('core/customers/contacts/list', 'name' => 'core_customers_contacts_list'),
    'core/customers/contacts/add/(:customer_id)' => array('core/customers/contacts/add', 'name' => 'core_customers_contacts_add'),
    'core/customers/contacts/edit/(:customer_id)/(:id)' => array('core/customers/contacts/edit', 'name' => 'core_customers_contacts_edit'),
    'core/customers/contacts/delete/(:customer_id)/(:id)' => array('core/customers/contacts/delete', 'name' => 'core_customers_contacts_delete'),
    'core/customers/contacts/show/(:customer_id)/(:id)' => array('core/customers/contacts/show', 'name' => 'core_customers_contacts_show'),


    /**
     * Projects
     */
    'core/customers/projects/list/(:customer_id)' => array('core/customers/projects/list', 'name' => 'core_customers_projects_list'),
    'core/customers/projects/add/(:customer_id)' => array('core/customers/projects/add', 'name' => 'core_customers_projects_add'),
    'core/customers/projects/edit/(:customer_id)/(:id)' => array('core/customers/projects/edit', 'name' => 'core_customers_projects_edit'),
    'core/customers/projects/delete/(:customer_id)/(:id)' => array('core/customers/projects/delete', 'name' => 'core_customers_projects_delete'),
    'core/customers/projects/show/(:customer_id)/(:id)' => array('core/customers/projects/show', 'name' => 'core_customers_projects_show'),

    'confirmed_email/:hash' => array('core/password/confirmed_email', 'name' => 'confirmed_email'),
    'forget_password' => array('core/password/forget', 'name' => 'forget_password'),
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
    'core/settings/locales/copy/(:id)' => array('core/settings/locales/copy' , 'name' => 'core_settings_locales_copy'),
    'core/settings/locales/edit/(:id)' => array('core/settings/locales/edit', 'name' => 'core_settings_locales_edit'),
    'core/settings/locales/delete/(:id)' => array('core/settings/locales/delete', 'name' => 'core_settings_locales_delete'),
    'core/settings/locales/deletes' => array('core/settings/locales/deletes', 'name' => 'core_settings_locales_deletes'),

    'core/settings/languages/list' => array('core/settings/languages/list', 'name' => 'core_settings_languages_list'),
    'core/settings/languages/add' => array('core/settings/languages/add', 'name' => 'core_settings_languages_add'),
    'core/settings/languages/edit/(:id)' => array('core/settings/languages/edit', 'name' => 'core_settings_languages_edit'),
    'core/settings/languages/delete/(:id)' => array('core/settings/languages/delete', 'name' => 'core_settings_languages_delete'),

);