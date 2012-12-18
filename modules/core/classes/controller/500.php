<?php
/**
 * @created 19.10.12 - 12:50
 * @author stefanriedel
 */

namespace Core;

class Controller_500 extends \Core\Controller_Base_Template_Blank_Public {

    public function action_index() {
        Theme::instance($this->template)->get_template()->set_global('title', __('Fehler'));
        Theme::instance($this->template)->set_partial('content', '500/index');
    }

}