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
use Fuel\Core\Theme;
use PHPSecLib\Crypt_Hash;
use Srit\Messages;
use Srit\Model_User;
use Srit\Validation;

class Model_PasswordExceptions extends \Fuel\Core\FuelException
{
}

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

    public static function change_password(Model_User $user, $password)
    {
        Auth::instance()->change_password_without_old($password, $user->username);
        static::send_new_password_success($user);
        Messages::success(__ext('change_password.success.label'));
    }

    public static function validate_password_forget()
    {
        $val = Validation::forge('password_forget');
        $val->add_callable(__CLASS__);
        $val->add('username', __('Nutzername/E-Mail'), array(), array('trim', 'strip_tags', 'required'))
            ->add_rule('user_exists');
        if (!$val->run()) {
            foreach ($val->error() as $error) {
                Messages::error(__ext($error));
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

        $user = static::find('first', array('where' => array(
            'new_password_hash' => $hash
        )));

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
        Messages::success(__ext('messages.prepare_new_password.success'));
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
            throw new \Model_PasswordExceptions(__('exception.model.password.send_prepare_new_password_mail.no.user_email'));
        }

        try {
            $mail = Model_PasswordMail::forge();
            $mail->send_password_hash_mail($user, $hash);
        } catch (\EmailValidationFailedException $e) {
            throw new Model_PasswordExceptions(__('exception.model.password.send_prepare_new_password_mail.no.valid.email'));
        }
        catch (\EmailSendingFailedException $e) {
            throw new Model_PasswordExceptions(__('exception.model.password.send_prepare_new_password_mail.cant.send.email'));
        }
    }

    public static function send_new_password_success(Model_User $user)
    {
        /**
         * @todo E-Mail Model bauen, wir verlegen E-Mail Templates ins theme oder in die DB
         */
        if (empty($user->email)) {
            throw new \Model_PasswordExceptions(__('exception.model.password.send_new_password_success.no.user_email'));
        }

        try {
            $mail = Model_PasswordMail::forge();
            $mail->send_new_password_success($user);
        } catch (\EmailValidationFailedException $e) {
            throw new Model_PasswordExceptions(__('exception.model.password.send_new_password_success.no.valid.email'));
        }
        catch (\EmailSendingFailedException $e) {
            throw new Model_PasswordExceptions(__('exception.model.password.send_new_password_success.cant.send.email'));
        }
    }

    public static function _validation_user_exists($val)
    {
        Validation::active()->set_message('user_exists', __ext('cant.find.user.error'));
        /**
         * @todo fixit!! Das ist so schlecht gelöst
         */
        $ret = Model_User::get_user($val) != false;
        return ($ret);
    }

}