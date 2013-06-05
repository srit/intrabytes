<?php
/**
 * @created 05.02.13 - 13:00
 * @author stefanriedel
 */

namespace Core;

class Controller_Customers_Edit extends \Controller_Customers_Customers
{

    public function action_index()
    {
        $this->_set_select_fields_rowsets();
    }

}