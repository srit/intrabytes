<?php
/**
 * @created 24.02.13 - 13:16
 * @author stefanriedel
 */

namespace Redmines;

use Srit\Controller_Base_User;

class Controller_Redmines extends Controller_Base_User {

    protected $_crud_objects = array(
        'redmine' => array()
    );
}