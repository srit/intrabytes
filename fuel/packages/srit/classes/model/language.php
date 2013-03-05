<?php
/**
 * @created 25.01.13 - 14:24
 * @author stefanriedel
 */

namespace Srit;
use \Srit\Model;

class Model_Language extends Model
{
    protected static $_properties = array(
        'id',
        'locale',
        'language',
        'plain',
        'default',
        'currency',
        'thousand_separator',
        'dec_point',
        'date_format'
    );

    protected static $_has_many = array(
        'locales' => array(
            'cascade_save' => true,
            'cascade_delete' => true,
        ));

    public function validate($input = array()) {
        $this->_fieldset = \Fuel\Core\Fieldset::forge()->add_model(get_called_class());
        $this->_fieldset->field('locale')->add_rule('required')->add_rule('min_length', 5);
        $this->_fieldset->field('language')->add_rule('required')->add_rule('min_length', 2);
        $this->_fieldset->field('plain')->add_rule('required')->add_rule('min_length', 5);
        return parent::validate($input);
    }

    public static function find_all(array $options = array()) {
        return parent::find_all(array(
            'related' => array('locales')
        ));
    }
    
    public static function find_by_language_key($language_key) {
        return parent::find('first', array('where' => array(
            'language' => $language_key
        )));
    }

    /**
     * @param null $cascade
     * @param bool $use_transaction
     * @return bool|void
     */
    public function save($cascade = null, $use_transaction = false) {

        $old_default = null;

        if($this->default == 1) {
            /**
             * Es soll nur eine Default Sprache geben.
             */
            $old_default = static::find('first', array('where' => array(
                'default' => 1
            )));
        }

        try {
            parent::save($cascade, $use_transaction);
            if($old_default != null && $old_default->id != $this->id) {
                $old_default->set('default', 0);
                $old_default->save();
            }
        } catch(\Exception $e) {
            throw $e;
        }
    }
}