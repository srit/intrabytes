<?php
/**
 * @created 07.11.12 - 13:59
 * @author stefanriedel
 */

namespace Users;

use \Core\Theme;

class Controller_Settings_Pubkeys_Edit extends \Core\Controller_Base_User {

    public function action_index() {

        var_dump($this->params());exit;

        //$this->user_public_key = Model_User_Public_Key::find_for_edit();

        Theme::instance($this->template)->set_partial('content', 'users/settings/pubkeys/edit/index')
            ->set('user_public_keys', $this->user_public_keys);
    }
}