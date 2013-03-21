<?php
/**
 * @created 28.02.13 - 16:12
 * @author stefanriedel
 */

namespace Users;

use Auth\Auth;
use Core\Controller_Base_User;

class Controller_Settings_Pubkeys extends Controller_Base_User {

    protected $_crud_objects = array(
        'user_public_key' => array()
    );

    public function before() {
        $this->_crud_objects['user_public_key']['fixed_named_params'] = array(
            'user_id' => Auth::get_user()->id
        );
        return parent::before();
    }

    public function action_list() {

    }

    public function action_edit() {

    }

    public function action_add() {

    }

    public function action_delete() {

    }

    public function action_show() {

    }
}