<?php
/**
 * @created 01.10.12 - 12:52
 * @author stefanriedel
 */

namespace Core;

class Controller_Password extends \Controller_BaseBlankTemplate
{
    public function action_forget()
    {

        var_dump(\Model_User::forge());

        if (\Input::post('submit', false)) {
            $validate_forget = \Model_User::validate_password_forget();
            if ($validate_forget) {
                /**
                 * @todo refaktorieren
                 */
                $user = \Model_User::get_user(\Input::param('username'));
                \Model_User::prepare_new_password($user);
            }
        }
    }

    public function action_confirmed_email()
    {
        $hash = $this->param('hash');
        $user = \Model_User::get_user_by_password_hash($this->param('hash'));
        $hash_true = true;
        $password_changed = false;
        if(false == $user) {
            /**
             * @todo locale
             */
            \Messages::error(__('Sie scheinen einen veralteten Link aufgerufen zu haben.'));
            $hash_true = false;
        }

        if (\Input::post('submit', false)) {
            $input = \Input::post('user');
            $validate_new_password = $user->validate_new_password($input);

            if($validate_new_password) {
                /**
                 *@todo refaktorieren
                 */
                $user = \Model_User::get_user($user->username);
                \Model_User::change_password($user, $input['password']);
                $password_changed = true;
            }
        }
        $this->_get_content_partial()
                            ->set('hash', $hash)
                            ->set('hash_true', $hash_true)
                            ->set('password_changed', $password_changed);

    }
}


