<?php
/**
 * @created 25.02.13 - 21:02
 * @author stefanriedel
 */

namespace Core;

use Srit\Controller_CrudBigTemplate;

class Controller_Settings_Locales extends Controller_CrudBigTemplate {

    protected $_crud_objects = array(
        'srit:locale' => array()
    );

    public function action_list() {

    }

    public function action_edit() {

    }

    public function action_add() {
        if($add_plain = \Input::post('add_plain', false)) {
            $this->_crud_objects['srit:language']['data']->set('plain', xss_clean($add_plain));
        }
    }

    public function action_delete() {

    }

}
