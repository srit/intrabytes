<?php
/**
 * @created 28.01.13 - 11:06
 * @author stefanriedel
 */

namespace Fuel\Migrations;

class Insertlocalesandlanguages {
    public static function up() {
        $language = \Fuel\Core\DB::insert('languages')->columns(array('locale', 'language', 'plain'))->values(array('de_DE.UTF8', 'de', 'Deutsch'))->execute();
        $language_id = (int)$language[0];

        $insert_locales_columns = array('key', 'group', 'value', 'language_id');
        $insert_locales_values = array(
            array('logout.label', 'nav', 'Logout :name', $language_id),
            array('dashboard.label', 'nav', 'Dashboard', $language_id),
            array('settings.label', 'nav', 'Einstellungen', $language_id),
            array('dashboard.config.label', 'usernav', 'Dashboard konfigurieren', $language_id),
            array('logout.label', 'usernav', 'Logout', $language_id),
        );

        foreach($insert_locales_values as $locale ) {

            \Fuel\Core\DB::insert('locales')->columns($insert_locales_columns)->values($locale)->execute();

        }


    }

    public static function down() {
        \Fuel\Core\DBUtil::truncate_table('locales');
        \Fuel\Core\DBUtil::truncate_table('languages');
    }
}