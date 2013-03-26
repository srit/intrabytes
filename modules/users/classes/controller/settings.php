<?php
/**
 * @created 07.11.12 - 13:59
 * @author stefanriedel
 */

namespace Users;

use Core\Theme;
use Srit\Controller_Base_User;

class Controller_Settings extends Controller_Base_User {

    public function action_dashboard() {
        Theme::instance()->set_partial('content', 'users/settings/dashboard');
    }
}