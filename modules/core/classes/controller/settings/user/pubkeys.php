<?php
/**
 * @created 30.04.13 - 14:13
 * @author stefanriedel
 */

namespace Core;

class Controller_Settings_User_Pubkeys extends \Controller_CrudBigTemplate
{

    protected $_crud_objects = array(
        '\Model_User_Public_Key' => array()
    );

    public function before()
    {
        if (\Auth::check()) {
            $this->_crud_objects['\Model_User_Public_Key']['fixed_named_params'] = array(
                'user_id' => \Auth::get_user()->id
            );
        }
        return parent::before();
    }

    public function action_list()
    {

    }

    public function action_edit()
    {

    }

    public function action_add()
    {

    }

    public function action_delete()
    {

    }

    public function action_show()
    {

    }
}