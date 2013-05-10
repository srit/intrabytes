<?php

/**
 * @created 06.02.13 - 15:48
 * @author stefanriedel
 */

namespace Customers;

use Srit\Logger;
use Srit\Model;

class Model_Customer_Project extends Model {

    protected static $_properties = array(
        'id',
        'name',
        'description',
        'url',
        'redmine_project_label',
        'customer_id',
        'redmine_id',
        'created_at' => array(
            'type' => 'datetime'
        ),
        'updated_at' => array(
            'type' => 'datetime'
        )
    );
    protected static $_belongs_to = array(
        'customer',
        'redmine' => array(
            'model_to' => 'Redmines\\Model_Redmine'
        )
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

    public function redmine_project_url() {
        return $this->redmine->url . '/projects/' . $this->redmine_project_label;
    }

    public static function find($id = null, array $options = array()) {

        //Logger::forge('model')->debug('Find Function Args', array($id, $options));

        $tmp_options = array(
            'related' => array(
                'customer',
                'redmine'
            )
        );
        $options = array_merge_recursive($tmp_options, $options);
        return parent::find($id, $options);
    }

    public static function find_by_customer_id_and_id($customer_id, $id, array $options = array()) {
        $tmp_options = array(
            'where' => array(
                'customer_id' => (int) $customer_id,
                'id' => (int) $id
            )
        );
        $options = array_merge_recursive($options, $tmp_options);
        return static::find('first', $options);
    }
    
    public function validate($input = array()) {
        /**
         * @todo Telefonnummern Validierung
         */
        $this->_fieldset = \Fuel\Core\Fieldset::forge()->add_model(get_called_class());
        $this->_fieldset->field('name')->add_rule('required')->add_rule('min_length', 3);
        $this->_fieldset->field('url')->add_rule('valid_url');
        return parent::validate($input);
    }

    public function __toString() {
        return $this->name;
    }

}