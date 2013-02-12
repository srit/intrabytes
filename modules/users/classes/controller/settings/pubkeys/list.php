<?php
/**
 * @created 07.11.12 - 13:59
 * @author stefanriedel
 */

namespace Users;

use \Core\Theme;

class Controller_Settings_Pubkeys_List extends \Core\Controller_Base_User {

    public function action_index() {
        $this->user_public_keys = $this->_user->user_public_keys;
        Theme::instance($this->template)->set_partial('content', 'users/settings/pubkeys/list/index')
            ->set('user_public_keys', $this->user_public_keys);
    }
}