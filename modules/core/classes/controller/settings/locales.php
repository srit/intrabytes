<?php
/**
 * @created 25.02.13 - 21:02
 * @author stefanriedel
 */

namespace Core;

use Srit\HttpNotFoundException;
use Srit\Controller_CrudBigTemplate;
use Srit\Exception;
use Srit\Messages;
use Srit\Model_Locale;
use Srit\Uri;

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

    public function action_copy() {
        if(($id = $this->param('id', 0)) > 0) {
            if($locale = Model_Locale::find($id)) {
                $copy = $locale->to_array();
                unset($copy['id']);
                $copy_object = Model_Locale::forge($copy);
                $copy_object->save();
                Messages::instance()->success(__ext('copy.success.label'));
                Messages::redirect(Uri::create(named_route('core_settings_locales_edit', array('id' => $copy_object->get_id()))));
            } else {
                throw new HttpNotFoundException;
            }

        } else {
            throw new Exception(__ext('exception.controller_settings_locales.action_copy.wrong_parameters'));
        }
    }

    public function action_delete() {

    }

}
