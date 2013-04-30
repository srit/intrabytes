<?php
/**
 * @created 01.10.12 - 20:15
 * @author stefanriedel
 */

namespace Core;

use Auth\Auth;
use Email\Email;
use Fuel\Core\Config;
use Fuel\Core\Str;
use PHPSecLib\Crypt_Hash;
use Srit\Messages;
use Srit\Validation;

class Model_PasswordExceptions extends \Fuel\Core\FuelException {}

class Model_Password extends Model_User
{

    protected static $_table_name = 'users';

    public static function validate_confirmed_forget_email()
    {
        $val = Validation::forge('password_forget');
        $val->add_callable(__CLASS__);
        $val->add('username', __('Nutzername/E-Mail'), array(), array('trim', 'strip_tags', 'required'))
            ->add_rule('user_exists');

    }

    public static  function change_password(Model_User $user, $password) {
        Auth::instance()->change_password_without_old($password, $user->username);
        Messages::success(__('Sie haben Ihr Passwort erfolgreich geändert.'));
    }

    public static function validate_new_password() {
        $val = Validation::forge('new_password');
        $val->add_callable(__CLASS__);
        $val->add('password', __('Passwort'), array(), array(array('required'), array('min_length', 8)));
        $val->add('repeat_password', __('Passwort wiederholen'), array(), array('repeat_password'));
        if (!$val->run()) {
            foreach ($val->error() as $error) {
                \Core\Messages::error($error);
            }
            $ret = false;
        } else {
            $ret = true;
        }
        return $ret;
    }

    public static function _validation_repeat_password($val)
    {
        Validation::active()->set_message('repeat_password', __('Die beiden Passwörter stimmen nicht überein.'));
        $active = \Validation::active();
        $password_value = $active->input('password');
        $ret = ($password_value === $val );
        return ($ret);
    }

    public static function validate_password_forget()
    {
        $val = Validation::forge('password_forget');
        $val->add_callable(__CLASS__);
        $val->add('username', __('Nutzername/E-Mail'), array(), array('trim', 'strip_tags', 'required'))
            ->add_rule('user_exists');
        if (!$val->run()) {
            foreach ($val->error() as $error) {
                Messages::error($error);
            }
            $ret = false;
        } else {
            $ret = true;
        }
        return $ret;
    }

    public static function get_user_by_password_hash($hash)
    {
        $hash = trim($hash);
        $properties = static::$_properties;
        $p = array_combine($properties, $properties);

        $user = static::query()
            ->where_open()
            ->or_where('new_password_hash', '=', $hash)
            ->where_close()
            ->get_one();

        return $user ? : false;
    }

    public static function send_new_password(Model_User $user)
    {
        try {
            $new_password = Auth::instance()->reset_password($user->username);
        } catch (\SimpleUserUpdateException $e) {
            throw new Model_PasswordExceptions(__('Beim aktuallisieren des Benutzers ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut. ' . $e->getMessage()));
        }
        static::send_new_password_mail($user, $new_password);
        Messages::success(__('Ihr neues Passwort, wurde an Ihre hinterlegte E-Mail-Adresse versendet.'));

    }

    public static function send_new_password_mail(Model_User $user, $new_password)
    {
        $email = Email::forge('system');
        $email->subject(__('Ihr angefordertes Passwort.'));
        $email->to($user->email, $user);
        $body = <<<STRING
    Hallo :username,

    anbei erhalten Sie Ihr neues Passwort. Bitte beachten Sie, dass nach dem nächsten Login, Sie direkt aufgefordert werden ein neues Passwort zu vergeben.
    Bitte überspringen Sie aus Sicherheitsgründen diesen Punkt nicht.

    Ihr neues Passwort: :password

    Beste Grüße
STRING;

        $body = __($body, array(':username' => $user->username, ':password' => $new_password));
        $email->body($body);

        try {
            $email->send();
        } catch (\EmailValidationFailedException $e) {
            throw new Model_PasswordExceptions(__('Die E-Mail-Adresse ist nicht korrekt: ' . $e->getMessage()));
        }
        catch (\EmailSendingFailedException $e) {
            throw new Model_PasswordExceptions(__('E-Mail konnte nicht gesendet werden: ' . $e->getMessage()));
        }
    }

    public static function prepare_new_password(Model_User $user)
    {
        $hasher = new Crypt_Hash();
        $hash = base64_encode($hasher->pbkdf2(Str::random('alnum', 8), Config::get('auth.salt'), 10000, 32));

        Auth::instance()->update_user(
            array(
                'new_password_hash' => $hash,
            ),
            $user->username
        );
        static::send_prepare_new_password_mail($user, $hash);
        Messages::success(__('messages.prepare_new_password.success'));
    }

    /**
     * @param Model_User $user
     * @param $hash
     * @throws \Model_PasswordExceptions
     */
    public static function send_prepare_new_password_mail(Model_User $user, $hash)
    {
        /**
         * @todo E-Mail Model bauen, wir verlegen E-Mail Templates ins theme oder in die DB
         */
        if (empty($user->email)) {
            throw new \Model_PasswordExceptions(__('Keine E-Mail Adresse vorhanden.'));
        }
        $mail = Email::forge();
        $mail->subject(__('Sie haben ein neues Passwort angefordert'));
        $mail->to($user->email, $user);

        $body = <<<STRING
    Hallo :username,
    für Ihren Account wurde ein neues Passwort angefordert.

    Bitte folgen Sie dem Link: :link, um diese Aktion zu bestätigen. Danach wird Ihnen eine weitere E-Mail mit weiterführenden Informationen zugesandt.

    Beste Grüße
STRING;
        $body = __($body, array(':username' => $user->username, ':link' => \Uri::create('/users/password/confirmed_email/' . $hash)));


        $mail->body($body);

        try {
            $mail->send();
        } catch (\EmailValidationFailedException $e) {
            throw new Model_PasswordExceptions(__('Die E-Mail-Adresse ist nicht korrekt: ' . $e->getMessage()));
        }
        catch (\EmailSendingFailedException $e) {
            throw new Model_PasswordExceptions(__('E-Mail konnte nicht gesendet werden: ' . $e->getMessage()));
        }
    }

    public static function _validation_user_exists($val)
    {
        Validation::active()->set_message('user_exists', __('Nutzername oder E-Mail nicht bekannt.'));
        /**
         * @todo fixit!! Das ist so schlecht gelöst
         */
        $ret = Model_User::get_user($val) != false;
        return ($ret);
    }

}