<?php

namespace Core;
use \Core\Model;


class Model_Mandant extends Model
{
    protected static $_properties = array(
        'id',
        'name' => array(
            'data_type' => 'varchar',
            'label' => 'name',
            'validation' => array(
                'required',
                'min_length' => array(2),
                'max_length' => array(50)
            ),
            'form' => array('type' => 'text'),
            'default' => 'Mandant name'
        ),
        'description' => array(
            'data_type' => 'varchar',
            'label' => 'description',
            'validation' => array(
                'max_length' => array(255)
            ),
            'form' => array(
                'type' => 'text'
            )
        ),
        'created_at' => array(
            'data_type' => 'int',
            'label' => 'created at',
            'form' => array(
                'type' => false, // this prevents this field from being rendered on a form
            ),
        ),
        'updated_at' => array(
            'data_type' => 'int',
            'label' => 'updated at',
            'form' => array(
                'type' => false, // this prevents this field from being rendered on a form
            ),
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



}
