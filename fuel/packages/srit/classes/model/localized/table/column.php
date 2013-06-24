<?php
/**
 * @created 24.06.13 - 14:57
 * @author stefanriedel
 */

namespace Srit;

class Model_Localized_Table_Column extends \CachedModel
{

    protected static $_belongs_to = array(
        'localized_table' => array(
            'model_to' => '\Model_Localized_Table',
            'cascade_save' => true,
            'cascade_delete' => true,
        ));

    public function __toString()
    {
        return $this->get_columns_name();
    }
}