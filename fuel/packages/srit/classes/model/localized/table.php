<?php
/**
 * @created 24.06.13 - 14:55
 * @author stefanriedel
 */

namespace Srit;

class Model_Localized_Table extends \CachedModel {
    protected static $_has_many = array(
        'localized_table_columns' => array(
            'model_to' => '\Model_Localized_Table_Column',
            'cascade_save' => true,
            'cascade_delete' => true,
        ));

    public function __toString()
    {
        return $this->get_table_name();
    }

    public static function find($id = null, array $options = array()) {
        $tmp_options = array(
            'related' => array(
                'localized_table_columns'
            ),
        );
        $options = array_merge_recursive($tmp_options, $options);
        return parent::find($id, $options);
    }
}