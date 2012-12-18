<?php
/**
 * @created 01.10.12 - 10:41
 * @author stefanriedel
 */

namespace Users;

class Controller_Logout extends \Core\Controller_Base_User
{
    public function action_index()
    {
        \Auth::logout();
        \Core\Messages::success(__('Sie haben sich erfolgreich ausgeloggt.'));
        \Core\Messages::redirect(\Uri::create('/users/login'));
    }

}