<?php

namespace Srit;

class Model_User extends \CachedModel
{

    protected static $_belongs_to = array(
        'client' => array(
            'model_to' => '\Model_Client'
        ),
        'group' => array(
            'model_to' => '\Model_Group'
        )
    );

    protected static $_has_one = array(
        'user_profile' => array(
            'model_to' => '\Model_User_Profile',
            'cascade_save' => true,
            'cascade_delete' => true,
        )
    );

    protected static $_many_many = array(
        'groups' => array(
            'model_to' => '\Model_Group',
        )
    );

    protected static $_has_many = array(
        'user_public_keys' => array(
            'model_to' => '\Model_User_Public_Key'
        )
    );

    protected static $_observers = array(
        '\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
        ),
        '\Observer_UpdatedAt' => array(
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

    public static function get_user($username_or_email)
    {
        $username_or_email = trim($username_or_email);
        $options = array(
            'where' => array(
                array('username' => $username_or_email),
                'or' => array(array('email' => $username_or_email))),
            'related' => array(
                'client',
                'user_profile',
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

    public function validate_new_password($input = array())
    {
        $this->_fieldset = \Fieldset::forge()->add_model(get_called_class());
        $this->_fieldset->field('password')->add_rule('required')->add_rule('max_length', 255)->add_rule('min_length', 8)->add_rule('is_repeatet', 'password_repeat');
        $this->_fieldset->add('password_repeat')->add_rule('required');
        return parent::validate($input);
    }

    public function __toString()
    {
        $ret = $this->get_username();
        if ($this->get_user_profile()) {
            $ret = $this->get_user_profile()->get_firstname() . ' ' . $this->get_user_profile()->get_lastname();
        }
        return $ret;
    }

    public static function find_my()
    {
        return static::find('first', array('where' => array(
            'id' => \Auth::get_user()->get_id()
        )));
    }

}
