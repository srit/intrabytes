<?php
/**
 * @created 19.10.12 - 12:50
 * @author stefanriedel
 */

namespace Core;

class Controller_500 extends \Controller_BaseBlankTemplate {

    public function action_index() {
        /**
         * @todo Seitentitel kann jederzeit geändert werden
         */
        $this->_get_template()->set_global('title', __('Fehler'));
    }

}