<?php
/**
 * @created 28.09.12 - 10:03
 * @author stefanriedel
 */
namespace Core;

use Auth\Auth;
use Fuel\Core\Fieldset;
use Fuel\Core\Input;
use Srit\Controller_Base_Template_Blank_Public;
use Srit\Messages;
use Srit\Theme;

class Controller_Login extends Controller_Base_Template_Blank_Public
{
    public function before()
    {
        // already logged in?
        if (Auth::check()) {
            Messages::error(__('messages.allreadyloggedin'));
            Messages::redirect(Input::post('redirect_to', \Uri::create(\Config::get('routes._root_'))));
        }

        parent::before();
    }


    public function action_index()
    {

        //Auth::instance()->change_password_without_old('IbmmSs10Mz!', 'sr');

        /**
         * @todo refaktorieren nach Model <-- Logik hat hier kaum was verloren.
         * @see \Users\Controller_Password::action_forget()
         */
        $fieldset = Fieldset::forge('login');
        $fieldset->add('username', __('Username'), array('maxlength' => 50), array(array('required')))
            ->add('password', __('Password'), array('type' => 'password', 'maxlength' => 255), array(array('required'), array('min_length', 8)))
            ->add('submit', '', array('tag' => 'button', 'class' => 'btn btn-success', 'value' => "<i class='icon-user icon-white'></i> " . __('Login')));
        if (Input::post('submit', false)) {
            if (!$fieldset->validation()->run()) {
                foreach ($fieldset->validation()->error() as $error) {

                    Messages::error($error);
                }
            } else {
                $auth = Auth::instance();
                if ($auth->login(\Input::param('username'), \Input::param('password'))) {
                    Messages::success(__('messages.login.success'));
                    Messages::redirect(\Input::post('redirect_to', '/'));
                } else {
                    Messages::error(__('messages.login.failed'));
                }
            }
        }

        $username = Input::post('username', false);

        Theme::instance()->set_partial('content', 'core/login/index')->set('fieldset', $fieldset, false)->set('username', $username);
    }
}