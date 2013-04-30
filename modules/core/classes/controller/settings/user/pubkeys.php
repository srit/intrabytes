<?php
/**
 * @created 30.04.13 - 14:13
 * @author stefanriedel
 */

namespace Core;
use Auth\Auth;
use Srit\Controller_Base_User;

class Controller_Settings_User_Pubkeys extends Controller_Base_User {

    protected $_crud_objects = array(
        'srit:user_public_key' => array()
    );

    public function before() {
        $this->_crud_objects['srit:user_public_key']['fixed_named_params'] = array(
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