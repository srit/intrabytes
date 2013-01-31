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
        'default'
    );

    protected static $_has_many = array(
        'locales' => array(
            'cascade_save' => true,
            'cascade_delete' => true,
        ));

    public function validate($factory = 'default') {
        $this->_fieldset = \Fuel\Core\Fieldset::forge()->add_model(get_called_class());
        $this->_fieldset->field('locale')->add_rule('required')->add_rule('min_length', 5);
        $this->_fieldset->field('language')->add_rule('required')->add_rule('min_length', 2);
        $this->_fieldset->field('plain')->add_rule('required')->add_rule('min_length', 5);
        if($this->_fieldset->validation()->run() == false) {
            foreach ($this->_fieldset->validation()->error() as $error) {
                \Core\Messages::error($error);
            }
            return false;
        }
        return true;
    }
}