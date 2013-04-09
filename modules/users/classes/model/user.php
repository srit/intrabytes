<?php

namespace Users;
use \Srit\Model;

class Model_User extends Model
{

    protected static $_properties = array(
        'id',
        'client_id',
        'username',
        'password',
        'group_id',
        'customer_contact_id',
        'email',
        'last_login',
        'login_hash',
        'profile_fields',
        'created_at',
        'updated_at',
        'password_resetted',
        'password_resetted_at'
    );

    protected static $_belongs_to = array(
        'client',
        'group',
        'customer_contact' => array(
            'model_to' => 'Customers\\Model_Customer_Contact'
        )
    );

    protected static $_has_one = array(
        'user_profile' => array(
            'cascade_save' => true,
            'cascade_delete' => true,
        )
    );

    protected static $_many_many = array(
        'groups'
    );

    protected static $_has_many = array(
        'user_public_keys'
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

    /**public static function get_user($username_or_email)
    {
        $username_or_email = trim($username_or_email);
        $properties = static::$_properties;
        $p = array_combine($properties, $properties);

        $user = static::query()
            ->related('client')
            ->related('profile')
            ->where_open()
            ->or_where('username', '=', $username_or_email)
            ->or_where('email', '=', $username_or_email)
            ->where_close()
            ->get_one();

        return $user ? : false;
    }  **/

    public static function get_user($username_or_email) {
        $username_or_email = trim($username_or_email);
        $options = array(
            'where' => array(
                array('username' => $username_or_email),
                'or' => array(array('email' => $username_or_email))),
            'related' => array(
                'client',
                'customer_contact',
                'user_public_keys',
                'group' => array(
                    'related' => array(
                        'roles' => array(
                            'related' => array(
                                'acls'
                            )
                        )
                    )
                )
            )
        );
        return static::find('first', $options);
    }

    /*public static function validate($factory)
    {
        $val = \Validation::forge($factory);
        $val->add_field('username', 'Username', 'required|max_length[50]');
        $val->add_field('password', 'Password', 'required|max_length[255]');
        $val->add_field('group', 'Group', 'required|valid_string[numeric]');
        $val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
        $val->add_field('last_login', 'Last Login', 'required|valid_string[numeric]');
        $val->add_field('login_hash', 'Login Hash', 'required|max_length[255]');
        $val->add_field('profile_fields', 'Profile Fields', 'required');

        return $val;
    }*/

    public function __toString()
    {
        $ret = $this->username;
        if(isset($this->user_profile)) {
            $ret = $this->user_profile->firstname . ' ' . $this->user_profile->lastname;
        }
        return $ret;
    }
}
