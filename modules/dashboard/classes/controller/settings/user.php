<?php
/**
 * @created 21.03.13 - 08:41
 * @author stefanriedel
 */

namespace Dashboard;

use Core\Controller_Base_User;
use Core\Theme;

class Controller_Settings_User extends Controller_Base_User {

    public function action_index() {
        Theme::instance($this->template)->set_partial('content', 'dashboard/settings/user/index');
    }
}