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
            array('settings.language.edit.legend', 'core', 'Sprache :sprache bearbeiten', 1),
            array('settings.language.edit.locale.label', 'core', 'Locale', 1),
            array('settings.language.edit.language.label', 'core', 'Sprache', 1),
            array('settings.language.edit.plain.label', 'core', 'Text', 1),
            array('settings.language.edit.save.button.label', 'core', 'Speichern', 1),
            array('settings.language.edit.cancel.button.label', 'core', 'Abbrechen', 1)

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