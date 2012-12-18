<?php
/**
 * @created 07.11.12 - 13:59
 * @author stefanriedel
 */

namespace Users;

use \Core\Theme;

class Controller_Settings extends \Core\Controller_Base_User {

    public function action_dashboard() {
        Theme::instance($this->template)->get_template()->set_global('title', __('Dashboard Einstellungen'));
        Theme::instance($this->template)->set_partial('content', 'users/settings/dashboard');
    }
}