<?php
/**
 * @created 07.11.12 - 13:59
 * @author stefanriedel
 */

namespace Users;

use \Core\Messages;
use \Core\Theme;

class Controller_Settings_Pubkeys_Edit extends \Core\Controller_Base_User {

    public function action_index() {
        if(\Input::post('cancel', false)) {
            \Response::redirect(\Uri::create('/users/settings/pubkeys/list'));
        }
        $this->id = $this->param('id');
        if(!empty($this->id)) {
            $this->user_public_key = Model_User_Public_Key::find_for_edit($this->id, $this->_user->id);
        } else {
            throw new \Fuel\Core\FuelException(__('exception.expected.parameters.notexists'));
        }

        if(\Input::post('save', false)) {
            $this->user_public_key->set(\Input::post());
            if($this->user_public_key->validate()) {
                $this->user_public_key->save();
                Messages::instance()->success(__(extend_locale('edit.pubkey.success')));
                Messages::redirect(\Fuel\Core\Uri::create('/users/settings/pubkeys/list'));
            }
        }

        Theme::instance($this->template)->set_partial('content', 'users/settings/pubkeys/edit/index')
            ->set('user_public_key', $this->user_public_key);
    }
}