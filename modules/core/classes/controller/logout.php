<?php
/**
 * @created 01.10.12 - 10:41
 * @author stefanriedel
 */

namespace Core;

use Auth\Auth;
use Fuel\Core\Uri;
use Srit\Controller_Base_User;
use Srit\Controller_BaseBigTemplate;
use Srit\Messages;

class Controller_Logout extends Controller_BaseBigTemplate
{
    public function action_index()
    {
        Auth::logout();
        Messages::success(__ext('validation.login.success'));
        Messages::redirect(Uri::create('login'));
    }

}