<?php
/**
 * @created 05.02.13 - 12:16
 * @author stefanriedel
 */

namespace Customers;
use \Srit\Model;

class Model_Customer extends Model {
    protected static $_properties = array(
        'id',
        'created_at',
        'updated_at',
        'email',
        'company_name',
        'firstname',
        'lastname',
        'phone',
        'fax',
        'street',
        'housenumber',
        'postalcode_id',
        'salutation_id'
    );

    protected static $_has_many = array(
        'customer_contacts' => array(
            'cascade_delete' => true,
        ),
        'customer_projects' => array(
            'cascade_delete' => true
        ),
    );

    protected static $_belongs_to = array(
        'postalcode',
        'salutation'
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

    public static function find($id = null, array $options = array()) {
        $tmp_options = array(
            'related' => array(
                'customer_contacts' => array(
                    'related' => array(
                        'postalcode' => array(
                            'related' => array(
                                'country'
                            )
                        ),
                        'salutation'
                    )
                ),
                'customer_projects' => array(
                    'related' => array(
                        'redmine'
                    )
                ),
                'postalcode' => array(
                    'related' => array(
                        'country'
                    )
                ),
                'salutation'
            ),
            'order_by' => array('id' => 'DESC')
        );
        $options = array_merge_recursive($tmp_options, $options);
        $item = parent::find($id, $options);
        if($item != false && $id !== 'all' && !isset($item->postalcode)) {

            $country_id = (isset($item->country_id)) ? $item->country_id : 0;
            $postalcode_text = (isset($item->postalcode_text)) ? $item->postalcode_text : '';
            $city_text = (isset($item->city_text)) ? $item->city_text : '';


        } elseif($item != false && $id !== 'all' && isset($item->postalcode)) {
            $country_id = (isset($item->postalcode->country_id)) ? $item->postalcode->country_id : 0;
            $postalcode_text = (isset($item->postalcode->postalcode)) ? $item->postalcode->postalcode : 0;
            $city_text = (isset($item->postalcode->city)) ? $item->postalcode->city : 0;
        }

        if($item != false && $id !== 'all') {
            $tmp_data = array(
                'country_id' => $country_id,
                'postalcode_text' => $postalcode_text,
                'city_text' => $city_text
            );
            $item->set($tmp_data);
        }
        return $item;
    }

    public static function forge($data = array(), $new = true, $view = null)
    {
        $item = new static($data, $new, $view);
        if($new == true) {
            $tmp_data = array(
                'country_id' => 0,
                'postalcode_text' => '',
                'city_text' => ''
            );
            $item->set($tmp_data);
        }

        return $item;

    }

    public static function find_for_edit($id = null, array $options = array()) {
        $model_options = array(

        );
        $options = array_merge_recursive($options, $model_options);
        return parent::find($id, $options);
    }

    public function validate($input = array()) {
        /**
         * @todo Telefonnummern Validierung
         */
        $this->_fieldset = \Fuel\Core\Fieldset::forge()->add_model(get_called_class());
        $this->_fieldset->field('email')->add_rule('required')->add_rule('valid_email');
        $this->_fieldset->field('company_name')->add_rule('required')->add_rule('min_length', 3);
        $this->_fieldset->field('firstname')->add_rule('required')->add_rule('min_length', 2);
        $this->_fieldset->field('lastname')->add_rule('required')->add_rule('min_length', 2);
        $this->_fieldset->field('phone')->add_rule('required');
        $this->_fieldset->field('street')->add_rule('required');
        $this->_fieldset->field('housenumber')->add_rule('required');
        $this->_fieldset->add('postalcode_text')->add_rule('required');
        $this->_fieldset->add('city_text')->add_rule('required');
        return parent::validate($input);
    }
    
    /**
     * @param null $cascade
     * @param bool $use_transaction
     * @return bool|void
     */
    public function save($cascade = null, $use_transaction = false) {
       if(empty($this->postalcode_id) && !empty($this->postalcode_text) && !empty($this->country_id)) {
            $postalcode = Model_Postalcode::find_by_postalcode($this->postalcode_text, $this->country_id);
            if($postalcode == false) {
                $postalcode = Model_Postalcode::forge(array('postalcode' => $this->postalcode_text, 'city' => $this->city_text, 'country_id' => $this->country_id));
                $postalcode->save();
            }
            $this->postalcode_id = $postalcode->id;
        }

        static::$_logger->debug('Func get Args save', func_get_args());

        return parent::save($cascade, $use_transaction);
    }

}