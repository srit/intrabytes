<?php
/**
 * @created 06.02.13 - 15:58
 * @author stefanriedel
 */
namespace Srit;
use \Srit\Model;

class Model_Country extends Model {
    protected static $_properties = array(
        'id',
        'name',
        'language_id'
    );

    protected static $_has_many = array(
        'postalcodes'
    );

    protected static $_belongs_to = array(
        'language'
    );
}