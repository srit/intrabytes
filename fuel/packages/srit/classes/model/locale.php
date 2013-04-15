<?php

namespace Srit;


use Srit\Model;

class Model_Locale extends Model
{
    /**protected static $_properties = array(
        'id',
        'key',
        'group',
        'value',
        'language_id'
    );**/

    protected static $_observers = array(
        'Srit\\Observer_Translated' => array(
            'properties' => array('value')
        )
    );

    protected static $_belongs_to = array(
        'language'
    );

    public static function find_all_by_language_and_locale($language, $locale = null)
    {
        $language_relation_where = array('language' => $language);
        if ($locale != null) {
            $language_relation_where = array_merge($language_relation_where, array('locale' => $locale));
        }

        $items = static::query()
            ->related('language', array('where' => $language_relation_where))
            ->get();

        return $items ? : false;

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

    public function cutted_value($length = 50) {
        $tmp_value = strip_tags(xss_clean($this->value));

        return strlen($tmp_value) > $length ? substr($tmp_value, 0, $length) . '...' : $this->value;
    }

}
