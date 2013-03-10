<?php
/**
 * @created 01.10.12 - 12:52
 * @author stefanriedel
 */

namespace Users;

use Core\Theme;

class Controller_Password extends \Core\Controller_Base_Template_Blank_Public
{
    public function action_forget()
    {
        if (\Input::post('submit', false)) {
            $validate_forget = Model_Password::validate_password_forget();
            if ($validate_forget) {
                $user = Model_User::get_user(\Input::param('username'));
                Model_Password::prepare_new_password($user);
            }


        }
        Theme::instance($this->template)->set_partial('content', 'users/password/forget');
    }

    public function action_confirmed_email()
    {
        $hash = $this->param('hash');
        $user = Model_Password::get_user_by_password_hash($this->param('hash'));
        $hash_true = true;
        $password_changed = false;
        if(false == $user) {
            \Core\Messages::error(__('Sie scheinen einen veralteten Link aufgerufen zu haben.'));
            $hash_true = false;
        }

        if (\Input::post('submit', false)) {
            $validate_new_password = Model_Password::validate_new_password();
            if($validate_new_password) {
                Model_Password::change_password($user, \Input::param('password'));
                $password_changed = true;
            }
        }
        Theme::instance($this->template)->set_partial('content', 'users/password/confirmed_email')
                            ->set('hash', $hash)
                            ->set('hash_true', $hash_true)
                            ->set('password_changed', $password_changed);

    }
}


