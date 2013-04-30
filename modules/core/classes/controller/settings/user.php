<?php
/**
 * @created 21.03.13 - 08:41
 * @author stefanriedel
 */

namespace Core;

use Srit\Controller_Base_User;
use Srit\Theme;

class Controller_Settings_User extends Controller_Base_User {

    public function action_dashboard() {
        Theme::instance()->set_partial('content', 'core/settings/user/dashboard');
    }
}