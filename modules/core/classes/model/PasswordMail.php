<?php
/**
 * @created 02.05.13 - 11:40
 * @author stefanriedel
 */

namespace Core;

use Email\Email;
use Srit\Model_User;
use Srit\Theme;

class Model_PasswordMail
{

    protected static $_instances = array();

    protected $_email = null;

    protected $_name = null;

    public static function  forge($name = null, $setup = null, $config = array())
    {
        if(!isset(static::$_instances[$name])) {
            static::$_instances[$name] = new self($name, $setup, $config);
        }
        return static::$_instances[$name];
    }

    public function __construct($name = null, $setup = null, array $config = array())
    {

        $this->_name = $name;
        $this->_email = Email::forge($setup, $config);

    }

    public function send_new_password_success(Model_User $user)
    {
        $this->_email->subject(__('Dein Passwort wurde geändert.'));
        $this->_email->to($user->email, $user);
        $body = Theme::instance()->view('core/emails/new_password_success', array('user' => $user, 'link' => named_route('forget_password')));
        $this->_email->body($body);
        $this->_email->send();
    }

    public function send_password_hash_mail(Model_User $user, $hash)
    {
        $this->_email->subject(__('Neues Passwort angefordert'));
        $this->_email->to($user->email, $user);
        $body = Theme::instance()->view('core/emails/password_hash_mail', array('user' => $user, 'link' => named_route('confirmed_email', array('hash' => $hash))));
        $this->_email->body($body);
        $this->_email->send();
    }

}