<?php
/**
 * @created 06.02.13 - 15:58
 * @author stefanriedel
 */
namespace Redmines;
use \Srit\Model;

class Model_Redmine extends Model {
    protected static $_properties = array(
        'id',
        'name',
        'url',
        'api_key',
        'created_at',
        'updated_at'
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => true,
        ),
    );

    public function validate($input = array()) {
        /**
         * @todo Telefonnummern Validierung
         */
        $this->_fieldset = \Fuel\Core\Fieldset::forge()->add_model(get_called_class());
        $this->_fieldset->field('name')->add_rule('required');
        $this->_fieldset->field('url')->add_rule('required')->add_rule('is_url');
        /**
         * @todo prüfen ob api key funktioniert
         */
        $this->_fieldset->field('api_key')->add_rule('required');
        return parent::validate($input);
    }
}