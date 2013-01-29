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
            array('login.index.title', 'users', 'Login', 1),
            array('password.forget.title', 'users', 'Passwort vergessen', 1),
            array('username.label', 'login', 'Nutzername/E-Mail', 1),
            array('username.label', 'forgetpassword', 'Nutzername/E-Mail', 1),
            array('send.label', 'forgetpassword', 'Senden', 1),
            array('password.label', 'login', 'Passwort', 1),
            array('loginbutton.label', 'login', 'Login', 1),
            array('forgetpassword.label', 'login', 'Passwort vergessen', 1),
            array('login.failed', 'messages', 'Nutzername und/oder Passwort falsch.', 1),
            array('login.success', 'messages', 'Sie haben sich erfolgreich eingeloggt.', 1),
            array('allreadyloggedin', 'messages', 'Sie sind bereits eingeloggt.', 1),
            array('prepare_new_password.success', 'messages', 'Weitere Informationen wurden an Ihre hinterlegte E-Mail-Adresse gesendet.', 1),
            array('username.required.error', 'validation', 'Der Benutzername muss ausgefüllt werden.', 1),
            array('password.required.error', 'validation', 'Bitte geben Sie ihr Passwort ein!', 1),
            array('form.invalid', 'validation', 'Das Formular konnte leider nicht verarbeitet werden.', 1)
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