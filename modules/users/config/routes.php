<?php
/**
 * @created 12.10.12 - 11:35
 * @author stefanriedel
 */

return array(
    'users/password/confirmed_email/:hash' => 'users/password/confirmed_email',

    'users/settings/pubkeys/list' => array('users/settings/pubkeys/list', 'name' => 'users_settings_pubkeys_list'),
    'users/settings/pubkeys/add' => array('users/settings/pubkeys/add', 'name' => 'users_settings_pubkeys_add'),
    'users/settings/pubkeys/edit/(:id)' => array('users/settings/pubkeys/edit', 'name' => 'users_settings_pubkeys_edit'),
    'users/settings/pubkeys/delete/(:id)' => array('users/settings/pubkeys/delete', 'name' => 'users_settings_pubkeys_delete'),
);