<?php
/**
 * @created 12.10.12 - 13:02
 * @author stefanriedel
 */

namespace Core;
use Auth\Auth_Login_SimpleAuth;
use Users\Model_User;

/**
 * @todo auf ORM umstellen und ins User Modul
 */
class Auth_Login_ICCRMAuth extends Auth_Login_SimpleAuth
{

    /**
     * @var \Users\Model_User
     */
    protected $_user = null;

    protected $config = array(
        'drivers' => array('group' => array('Core\\ICCRMGroup')),
        'additional_fields' => array('profile_fields'),
    );

    /**
     * @var array
     */
    protected $_columns = array(
        'mandant_id',
        'username',
        'password',
        'pepper',
        'email',
        'last_login',
        'login_hash',
        'password_resetted',
        'password_resetted_at',
        'new_password_hash'
    );


    /**
     * @param string $values
     * @param string null $username
     * @return bool
     * @throws SimpleUserUpdateException
     * @throws SimpleUserWrongPassword
     */
    public function update_user($values, $username = null)
    {
        $username = $username ? : $this->user['username'];
        $current_values = \DB::select_array(\Config::get('simpleauth.table_columns', array('*')))
            ->where('username', '=', $username)
            ->from(\Config::get('simpleauth.table_name'))
            ->execute(\Config::get('simpleauth.db_connection'));

        if (empty($current_values)) {
            throw new \SimpleUserUpdateException('Username not found', 4);
        }

        $update = array();
        if (array_key_exists('username', $values)) {
            throw new \SimpleUserUpdateException('Username cannot be changed.', 5);
        }

        if (array_key_exists('password', $values)) {
            if (empty($values['old_password'])
                or $current_values->get('password') != $this->hash(trim($values['old_password']), $current_values->get('pepper'))
            ) {
                throw new \SimpleUserWrongPassword('Old password is invalid');
            }

            $password = trim(strval($values['password']));
            $pepper = static::generate_pepper();
            if ($password === '') {
                throw new \SimpleUserUpdateException('Password can\'t be empty.', 6);
            }
            $update['pepper'] = $pepper;
            $update['password'] = $this->hash($password, $pepper);
            $update['password_resetted'] = '';
            $update['password_resetted_at'] = 0;
            $update['new_password_hash'] = '';
            $update['updated_at'] = time();
            unset($values['password']);
        }
        if (array_key_exists('old_password', $values)) {
            unset($values['old_password']);
        }
        if (array_key_exists('email', $values)) {
            $email = filter_var(trim($values['email']), FILTER_VALIDATE_EMAIL);
            if (!$email) {
                throw new \SimpleUserUpdateException('Email address is not valid', 7);
            }
            $update['email'] = $email;
            unset($values['email']);
        }
        if (array_key_exists('group', $values)) {
            if (is_numeric($values['group'])) {
                $update['group'] = (int)$values['group'];
            }
            unset($values['group']);
        }

        if (isset($values['new_password_hash'])) {
            $update['password_resetted'] = true;
            $update['password_resetted_at'] = time();
            $update['new_password_hash'] = $values['new_password_hash'];
            unset($update['new_password_hash']);
        }


        $rest_columns = array_diff_key($values, $this->_columns);
        foreach ($rest_columns as $key => $val) {
            if (in_array($key, $this->_columns)) {
                $update[$key] = $val;
                unset($values[$key]);
            }
        }


        if (!empty($values)) {
            $profile_fields = @unserialize($current_values->get('profile_fields')) ? : array();
            foreach ($values as $key => $val) {
                if ($val === null) {
                    unset($profile_fields[$key]);
                } else {
                    $profile_fields[$key] = $val;
                }
            }
            $update['profile_fields'] = serialize($profile_fields);
        }

        $update['updated_at'] = time();

        $affected_rows = \DB::update(\Config::get('simpleauth.table_name'))
            ->set($update)
            ->where('username', '=', $username)
            ->execute(\Config::get('simpleauth.db_connection'));

        // Refresh user
        if ($this->user['username'] == $username) {
            $this->user = \DB::select_array(\Config::get('simpleauth.table_columns', array('*')))
                ->where('username', '=', $username)
                ->from(\Config::get('simpleauth.table_name'))
                ->execute(\Config::get('simpleauth.db_connection'))->current();
        }

        return $affected_rows > 0;
    }

    public function change_password_without_old($password, $username) {
        $password = trim(strval($password));
        $pepper = static::generate_pepper();
        if ($password === '') {
            throw new \SimpleUserUpdateException(__('Das Passwort darf nicht leer sein.'), 6);
        }
        $update['pepper'] = $pepper;
        $update['password'] = $this->hash($password, $pepper);
        $update['password_resetted'] = '';
        $update['password_resetted_at'] = 0;
        $update['new_password_hash'] = '';
        $update['updated_at'] = time();

        $affected_rows = \DB::update(\Config::get('simpleauth.table_name'))
            ->set($update)
            ->where('username', '=', $username)
            ->execute(\Config::get('simpleauth.db_connection'));

        // Refresh user
        if ($this->user['username'] == $username) {
            $this->user = \DB::select_array(\Config::get('simpleauth.table_columns', array('*')))
                ->where('username', '=', $username)
                ->from(\Config::get('simpleauth.table_name'))
                ->execute(\Config::get('simpleauth.db_connection'))->current();
        }

        return $affected_rows > 0;
    }

    /**
     *
     * Komplette Überladung der Elternmethode
     *
     * @param string $username
     * @return string
     * @throws SimpleUserUpdateException
     */
    public function reset_password($username)
    {
        $new_password = \Str::random('alnum', 8);
        $pepper = static::generate_pepper();
        $password_hash = $this->hash($new_password, $pepper);

        $affected_rows = \DB::update(\Config::get('simpleauth.table_name'))
            ->set(array('password' => $password_hash, 'pepper' => $pepper, 'new_password_hash' => '', 'password_resetted_at' => 0))
            ->where('username', '=', $username)
            ->execute(\Config::get('simpleauth.db_connection'));

        if (!$affected_rows) {
            throw new \SimpleUserUpdateException('Failed to reset password, user was invalid.', 8);
        }

        return $new_password;
    }

    public static function generate_pepper() {
        return md5(\Str::random());
    }

    /**
     * Default password hash method
     *
     * @param   string
     * @return  string
     */
    public function hash($password, $pepper)
    {
        $password = $password . '.' . $pepper;
        return Password::password_hash($password, PASSWORD_BCRYPT, array("cost" => 10, 'salt' => \Config::get('auth.salt')));
    }

    public function verify_password($password, $pepper, $hash, $username) {
        $password = $password . '.' . $pepper;
        if(Password::password_verify($password, $hash)) {

            /**
             * Hash musserneuert werden
             */
            if(true === Password::password_needs_rehash($hash, PASSWORD_BCRYPT, array('cost' => 10, 'salt' => \Config::get('auth.salt')))) {
                $this->change_password_without_old($password, $username);
            }
            return true;
        }

    }

    public function validate_user($username_or_email = '', $password = '')
    {
        $username_or_email = trim($username_or_email) ?: trim(\Input::post(\Config::get('simpleauth.username_post_key', 'username')));
        $password = trim($password) ?: trim(\Input::post(\Config::get('simpleauth.password_post_key', 'password')));

        if (empty($username_or_email) or empty($password))
        {
            return false;
        }

        $this->user = \DB::select_array(\Config::get('simpleauth.table_columns', array('*')))
            ->where_open()
            ->where('username', '=', $username_or_email)
            ->or_where('email', '=', $username_or_email)
            ->where_close()
            ->from(\Config::get('simpleauth.table_name'))
            ->execute(\Config::get('simpleauth.db_connection'))->current();

        if(!$this->user) {
            return false;
        }



        if (false == $this->verify_password($password, $this->user['pepper'], $this->user['password'], $this->user['username'])) {
            $this->user = false;
        }

        return $this->user;
    }

    public function create_user($username, $password, $email, $group = 1, array $profile_fields = array())
    {
        $password = trim($password);
        $pepper = static::generate_pepper();
        $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

        if (empty($username) or empty($password) or empty($email))
        {
            throw new \SimpleUserUpdateException('Username, password or email address is not given, or email address is invalid', 1);
        }

        $same_users = \DB::select_array(\Config::get('simpleauth.table_columns', array('*')))
            ->where('username', '=', $username)
            ->or_where('email', '=', $email)
            ->from(\Config::get('simpleauth.table_name'))
            ->execute(\Config::get('simpleauth.db_connection'));

        if ($same_users->count() > 0)
        {
            if (in_array(strtolower($email), array_map('strtolower', $same_users->current())))
            {
                throw new \SimpleUserUpdateException('Email address already exists', 2);
            }
            else
            {
                throw new \SimpleUserUpdateException('Username already exists', 3);
            }
        }

        $user = array(
            'username'        => (string) $username,
            'pepper'          => $pepper,
            'password'        => $this->hash((string) $password, $pepper),
            'email'           => $email,
            'group'           => (int) $group,
            'profile_fields'  => serialize($profile_fields),
            'last_login'      => 0,
            'login_hash'      => '',
            'created_at'      => \Date::forge()->get_timestamp()
        );
        $result = \DB::insert(\Config::get('simpleauth.table_name'))
            ->set($user)
            ->execute(\Config::get('simpleauth.db_connection'));

        return ($result[1] > 0) ? $result[0] : false;
    }

    public function get_user() {
        if(null == $this->_user) {
            $this->_user = Model_User::get_user($this->get_email());
        }
        return $this->_user;
    }

    public function get_groups()
    {
        if (empty($this->user))
        {
            return false;
        }

        $gr = $this->get_user()->group;
        $groups = array(array('Core\\ICCRMGroup', $gr->name => $gr));
        return $groups;
        //return array(array('SimpleGroup', $this->user['group']));
    }

}