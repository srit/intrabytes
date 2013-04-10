<?php
/**
 * @created 09.04.13 - 15:18
 * @author stefanriedel
 */
namespace Users;

use Auth\Auth;
use Core\Theme;
use Srit\Controller_Base_User;
use Srit\Logger;

class Controller_Settings_Profile extends Controller_Base_User {

    protected $_crud_objects = array(
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
    }

    public function action_edit() {

    }
}