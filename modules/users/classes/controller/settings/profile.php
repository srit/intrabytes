<?php
/**
 * @created 09.04.13 - 15:18
 * @author stefanriedel
 */
namespace Users;

use Auth\Auth;
use Core\Theme;
use Fuel\Core\Input;
use Fuel\Core\Uri;
use Srit\Controller_Base_User;
use Srit\Logger;
use Srit\Messages;

class Controller_Settings_Profile extends Controller_Base_User {

    /*protected $_crud_objects = array(
        'user_profile' => array(),
        'user' => array()
    );

    public function before() {
        $this->_crud_objects['user_profile']['fixed_named_params'] = array(
            'user_id' => Auth::get_user()->id
        );
        $this->_crud_objects['user']['fixed_named_params'] = array(
            'id' => Auth::get_user()->id
        );
        return parent::before();
    }**/

    public function action_edit() {
        $profile = Model_User_Profile::find_my();
        $user = Model_User::find_my();

        if($user_profile = Input::post('user_profile', false)) {
            $profile->set($user_profile);
            if($profile->validate($user_profile)) {
                $profile->save();
                Messages::instance()->success(__(extend_locale('change_password.success')));
            }
            Messages::redirect(Uri::current() . '#profile');
        }

        if($password_data = Input::post('user', false)) {
            if($user->validate_new_password($password_data)) {
                Auth::instance()->change_password_without_old($password_data['password'], $user->username);
                Messages::success(__(extend_locale('change_password.success')));
            }
            Messages::redirect(Uri::current() . '#password');
        }

        $this->_get_content_template()->set('profile', $profile);
    }
}