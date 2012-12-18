<?php
/**
 * @created 28.09.12 - 10:03
 * @author stefanriedel
 */
namespace Users;

use \Core\Messages;
use \Core\Theme;

class Controller_Login extends \Core\Controller_Base_Template_Blank_Public
{
    public function before()
    {
        // already logged in?
        if (\Auth::check()) {
            \Core\Messages::error(__('Sie sind bereits eingeloggt'));
            \Core\Messages::redirect(\Input::post('redirect_to', '/'));
        }

        parent::before();
    }


    public function action_index()
    {

        Theme::instance($this->template)->get_template()->set_global('title', __('User Login'));


        /**
         * @todo refaktorieren nach Model <-- Logik hat hier kaum was verloren.
         * @see \Users\Controller_Password::action_forget()
         */
        $fieldset = \Fieldset::forge('login');
        $fieldset->add('username', __('Username'), array('maxlength' => 50), array(array('required')))
            ->add('password', __('Password'), array('type' => 'password', 'maxlength' => 255), array(array('required'), array('min_length', 8)))
            ->add('submit', '', array('tag' => 'button', 'class' => 'btn btn-success', 'value' => "<i class='icon-user icon-white'></i> " . __('Login')));
        if (\Input::post('submit', false)) {
            if (!$fieldset->validation()->run()) {
                foreach ($fieldset->validation()->error() as $error) {
                    \Core\Messages::error($error);
                }
            } else {
                $auth = \Auth::instance();
                if ($auth->login(\Input::param('username'), \Input::param('password'))) {
                    \Core\Messages::success(__('Sie haben sich erfolgreich eingeloggt.'));
                    \Core\Messages::redirect(\Input::post('redirect_to', '/'));
                } else {
                    \Core\Messages::error(__('Nutzername und/oder Passwort falsch.'));
                }
            }
        }

        Theme::instance($this->template)->set_partial('content', 'users/login/index')->set('fieldset', $fieldset, false);
    }
}