<?php
/**
 * @created 25.01.13 - 14:24
 * @author stefanriedel
 */

namespace Srit;

use Srit\Model;

class Model_Language extends \CachedModel
{

    public function validate($input = array())
    {
        $this->_fieldset = \Fieldset::forge()->add_model(get_called_class());
        $this->_fieldset->field('locale')->add_rule('required')->add_rule('min_length', 5);
        $this->_fieldset->field('language')->add_rule('required')->add_rule('min_length', 2);
        $this->_fieldset->field('plain')->add_rule('required')->add_rule('min_length', 5);
        return parent::validate($input);
    }

    public static function find_all_active(array $options = array())
    {
        return parent::find_all(array(
            'where' => array(
                'active' => true
            )
        ));
    }

    public static function find_by_language_key($language_key)
    {
        return parent::find('first', array('where' => array(
            'language' => $language_key
        )));
    }

    /**
     * @param null $cascade
     * @param bool $use_transaction
     * @return bool|void
     */
    public function save($cascade = null, $use_transaction = false)
    {

        $old_default = null;

        if ($this->get_default() == 1) {
            /**
             * Es soll nur eine Default Sprache geben.
             */
            $old_default = static::find('first', array('where' => array(
                'default' => 1
            )));
        }

        try {
            parent::save($cascade, $use_transaction);
            if ($old_default != null && $old_default->id != $this->id) {
                $old_default->set('default', 0);
                $old_default->save();
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    protected function create()
    {
        if(parent::create()) {
            static::_add_translate_columns();
            return true;
        }
        return false;
    }

    public function delete($cascade = null, $use_transaction = false)
    {
        parent::delete($cascade, $use_transaction);
        static::_delete_translated_columns();
    }

    protected function _delete_translated_columns()
    {
        $this->_change_localized_tables('drop');
    }

    protected function _add_translate_columns()
    {
        $this->_change_localized_tables('add');
    }

    protected function _change_localized_tables($method)
    {
        if ($localized_tables = \Model_Localized_Table::find_all()) {
            foreach ($localized_tables as $table) {
                $table_name = $table->get_table_name();
                $fields = array();
                foreach ($table->get_localized_table_columns() as $column) {
                    $column_name = $column->get_column_name();
                    $column_name .= '_' . $this->get_language();
                    if ($method == 'add') {
                        $options = array('type' => $column->get_type());
                        if ($column->get_size() > 0) {
                            $options['constraint'] = $column->get_size();
                        }
                        $fields[$column_name] = $options;
                    } else {
                        $fields[] = $column_name;
                    }
                }
                forward_static_call_array(array('\DBUtil', $method . '_fields'), array($table_name, $fields));
            }
        }
    }

}