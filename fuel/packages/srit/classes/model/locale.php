<?php

namespace Srit;

class Model_Locale extends \CachedModel
{
    protected static $_observers = array(
        '\Observer_Translated' => array(
            'properties' => array('value')
        )
    );

    public function save($cascade = null, $use_transaction = false) {
        var_dump($this->to_array());exit;
    }

    public static function find_all_by_locale($locale = null)
    {
        return static::find_all();
    }

    public static function find_groups_like_group($group, array $options = array())
    {
        $options = array_merge_recursive($options, array(
            'where' => array(
                array('group', 'LIKE', $group . '%')
            ),
            'group_by' => 'group'
        ));
        $items = static::find_all($options);
        return $items ? : false;
    }

    public function cutted_value($length = 50)
    {
        $tmp_value = strip_tags(xss_clean($this->value));

        return strlen($tmp_value) > $length ? substr($tmp_value, 0, $length) . '...' : $this->value;
    }

}
