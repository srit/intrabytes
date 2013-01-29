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
            array('settings.language.label', 'nav', 'Spracheinstellungen', 1),
            array('settings_language.index.title', 'core', 'Spracheinstellungen', 1),
            array('board.index.title', 'dashboard', 'Dashboard', 1),
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