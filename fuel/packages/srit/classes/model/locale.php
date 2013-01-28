<?php

namespace Srit;
use \Srit\Model;


class Model_Locale extends Model
{
    protected static $_properties = array(
        'id',
        'key',
        'group',
        'value',
        'language_id'
    );

    protected static $_belongs_to = array(
        'language'
    );

    public static function find_all_by_language_and_locale($language, $locale = null) {
        $language_relation_where = array('language' => $language);
        if($locale != null) {
            $language_relation_where = array_merge($language_relation_where, array('locale' => $locale));
        }

        $items = static::query()
            ->related('language', array('where' => $language_relation_where))
            ->get();

        return $items ?: false;

    }

}
