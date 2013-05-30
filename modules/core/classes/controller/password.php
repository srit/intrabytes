<?php
/**
 * @created 01.10.12 - 12:52
 * @author stefanriedel
 */

namespace Core;

use Fuel\Core\Input;
use Srit\Controller_BaseBlankTemplate;
use Srit\Messages;
use Srit\Theme;
use Srit\Controller_Base_Template_Blank_Public;

class Controller_Password extends Controller_BaseBlankTemplate
{
    public function action_forget()
    {
        if (Input::post('submit', false)) {
            $validate_forget = Model_Password::validate_password_forget();
            if ($validate_forget) {
                $user = \Model_User::get_user(Input::param('username'));
                Model_Password::prepare_new_password($user);
            }
        }
    }

    public function action_confirmed_email()
    {
        $hash = $this->param('hash');
        $user = Model_Password::get_user_by_password_hash($this->param('hash'));
        $hash_true = true;
        $password_changed = false;
        if(false == $user) {
            /**
             * @todo locale
             */
            Messages::error(__('Sie scheinen einen veralteten Link aufgerufen zu haben.'));
            $hash_true = false;
        }

        if (Input::post('submit', false)) {
            $input = Input::post('user');
            $validate_new_password = $user->validate_new_password($input);

            if($validate_new_password) {
                $user = \Model_User::get_user($user->username);
                Model_Password::change_password($user, $input['password']);
                $password_changed = true;
            }
        }
        $this->_get_content_partial()
                            ->set('hash', $hash)
                            ->set('hash_true', $hash_true)
                            ->set('password_changed', $password_changed);

    }
}


