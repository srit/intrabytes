<?php
/**
 * @created 28.01.13 - 11:06
 * @author stefanriedel
 */

namespace Fuel\Migrations;

class Insertlocalesandlanguages {
    public static function up() {
        $insert_locales_columns = array('key', 'group', 'value', 'language_id');
        $insert_locales_values = array(
            array('settings.dashboard.title', 'users', 'Dashboard konfigurieren', 1),
            array('settings.language.id.label', 'core', '#', 1),
            array('settings.language.locale.label', 'core', 'Locale', 1),
            array('settings.language.language.label', 'core', 'Sprache', 1),
            array('settings.language.plain.label', 'core', 'Text', 1),
        );

        foreach($insert_locales_values as $locale ) {

            \Fuel\Core\DB::insert('locales')->columns($insert_locales_columns)->values($locale)->execute();

        }


    }

    public static function down() {
        /**
         * @todo Einrichten
         */
    }
}