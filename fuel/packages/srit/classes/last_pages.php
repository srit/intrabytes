<?php
/**
 * @created 29.03.13 - 14:07
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Arr;
use Fuel\Core\Cookie;
use Fuel\Core\Uri;

class Last_Pages
{

    const MAX_STATIC_PAGES = 5;

    protected static $_active_page_title = '';

    protected static $_last_pages = array();

    public static function setActivePageTitle($active_page_title)
    {
        self::$_active_page_title = $active_page_title;
    }

    public static function get()
    {
        if (empty(static::$_last_pages)) {
            $last_pages_serialized = Cookie::get('last_pages', serializer(array()));
            $last_pages = unserializer($last_pages_serialized);
            static::$_last_pages = $last_pages;
        }

        return static::$_last_pages;
    }

    public static function set()
    {
        $last_pages = static::get();
        if ($uri = Uri::current() AND (!isset($last_pages[0]) OR $last_pages[0]['title'] != static::$_active_page_title) AND ($uri != login_route() AND $uri != logout_route())) {

            if (Arr::in_array_recursive(static::$_active_page_title, $last_pages)) {
                foreach ($last_pages as $i => $page) {
                    if ($page['title'] == static::$_active_page_title) {
                        unset($last_pages[$i]);
                    }
                }
            }

            $last_page = array(
                'uri' => Uri::current(),
                'title' => static::$_active_page_title,
                'time' => time()
            );
            array_unshift($last_pages, $last_page);

            foreach ($last_pages as $i => $last_page) {
                if ($i >= self::MAX_STATIC_PAGES) {
                    unset($last_pages[$i]);
                }
            }

            static::$_last_pages = $last_pages;
            Cookie::set('last_pages', serializer($last_pages));
        }

    }
}