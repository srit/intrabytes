<?php
/**
 * @created 29.01.13 - 12:56
 * @author stefanriedel
 */

return array(

    '_locale_list_' => 'core/settings/locales/list/(:language_id)',

    'core/settings/locales/list/(:language_id)' => array(
        'core/settings/locales/list',
        'name' => '_locale_list_'
    ),

    'core/settings/languages' => 'core/settings/languages/list',
    'core/settings/locales/list/(:language_id)' => 'core/settings/locales/list/$1',
    //'core/settings/locales/(:language_id)' => 'core/settings/locales/list/$1',
    'core/settings/locales/add/(:language_id)' => 'core/settings/locales/add/$1',
    'core/settings/locales/edit/(:language_id)/(:id)' => 'core/settings/locales/edit/$1/$2'
);