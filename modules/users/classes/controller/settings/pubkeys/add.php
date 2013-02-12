<?php
/**
 * @created 07.11.12 - 13:59
 * @author stefanriedel
 */

namespace Users;

use \Core\Messages;
use \Core\Theme;

class Controller_Settings_Pubkeys_Add extends \Core\Controller_Base_User {

    public function action_index() {
        $this->user_public_key = Model_User_Public_Key::forge();

        if(\Input::post('cancel', false)) {
            \Response::redirect(\Uri::create('/users/settings/pubkeys/list'));
        }

        if(\Input::post('save', false)) {
            $this->user_public_key->set(\Input::post());
            if($this->user_public_key->validate()) {
                $this->user_public_key->save();
                Messages::instance()->success(__(extend_locale('edit.pubkey.success')));
                Messages::redirect(\Uri::create('/users/settings/pubkeys/list'));
            }
        }

        Theme::instance($this->template)->set_partial('content', 'users/settings/pubkeys/add/index')
            ->set('user_public_key', $this->user_public_key);
    }
}