<?php
/**
 * @created 29.01.13 - 14:55
 * @author stefanriedel
 *
 * Default Funktionsdatei
 * Funktionen tun nicht weh!
 * Alles was eh nur in statische Methoden von Klassen gepackt werden
 * würde, kann genauso gut in Funktionen untergebracht werden.
 *
 * Außerdem finden wir hier einige Wrapper für oft genutzte Klassenmethoden in kurzform
 *
 */

/**
 * @todo Sprachmigrationen anlegen
 * @todo Hilfsfunktion form_start und form_end
 */

$theme_instance = null;

/**
 * @param $new_theme_instance \Srit\Theme
 */
function set_theme_instance($new_theme_instance)
{
    global $theme_instance;
    $theme_instance = $new_theme_instance;
}

/**
 * @return \Srit\Theme
 */
function get_theme_instance()
{
    global $theme_instance;
    return $theme_instance;
}

function concat($separator = ' ')
{
    $args = func_get_args();
    $num_args = func_num_args();
    if ($num_args > 1) {
        $string = '';
        foreach ($args as $num => $value) {
            if ($num == 0) {
                continue;
            }
            if (!empty($value)) {
                $string .= $value . $separator;
            }
        }
        $lng_separator = strlen($separator);
        $string = substr($string, 0, -$lng_separator);
    }
    return $string;
}

/**
 * Wrapper für @used \Fuel\Core\Security::xss_clean
 *
 * @param $value
 * @return array|mixed|string
 */
function xss_clean($value)
{
    return \Fuel\Core\Security::xss_clean($value);
}

function html_entities($value)
{
    return \Fuel\Core\Security::htmlentities($value);
}

function format_from_object($property, \Srit\Model $obj)
{
    return $obj->format($property);
}

function format_currency($value)
{
    return \Srit\L10n::instance()->format_currency($value);
}

function format_date($value)
{
    return \Srit\L10n::instance()->format_date($value);
}

function format_datetime($value)
{
    return \Srit\L10n::instance()->format_datetime($value);
}

/**
 * @param int $current
 * @return array
 */
function getMonthArray($current = null)
{

    $months = array();
    for ($m = 1; $m <= 12; ++$m) {
        $months[] = array('month' => ($m >= 10) ? $m : '0' . $m, 'current' => (null == $current || $m != $current) ? false : true);
    }

    return $months;

}


/**
 * @param int $current
 * @param int $before
 * @param int $after
 * @return array
 */
function getYearArray($current = null, $before = 5, $after = 5)
{

    $year = (int)date('Y');
    $years = array();
    for ($y = $year - $before; $y <= $year + $after; ++$y) {
        $years[] = array('year' => $y, 'current' => (null == $current || $y != $current) ? false : true);
    }

    return $years;

}

/**
 * @param string $locale
 * @used \Srit\Locale
 * @return string
 */
function extend_locale($locale)
{
    return \Loc::instance()->getLocalePrefix() . '.' . $locale;
}

function __ext($locale, array $params = array())
{
    return __(extend_locale($locale), $params);
}

function error_text($value)
{
    return html_tag('div', array('class' => 'text-error span12'), $value);
}

/**
 * @param string $locale
 * @param array $locale_params
 * @param array $attr
 * @return string
 */
function html_legend($locale = null, array $locale_params = array(), array $attr = array())
{

    $locale = ($locale == null) ? __(extend_locale('legend.label'), $locale_params) : __($locale, $locale_params);

    return html_tag('div', array('class' => 'span11 header'), html_tag('h4', array(), $locale));
    //return html_tag('legend', $attr, __($locale, $locale_params));
}

/**
 * @param array $label_attr
 * @param string $for
 * @param string $label_locale
 * @return string
 */
function html_label(array $label_attr, $for, $label_locale, array $label_locale_attr = array())
{
    $label_attr['for'] = (isset($attr['for']) && !empty($label_attr['for'])) ? : $for;
    $label_attr['id'] = (isset($attr['id']) && !empty($label_attr['id'])) ? $label_attr['id'] : 'label_' . $for;

    if (preg_match('/\[.*\]/', $label_attr['id'])) {
        $label_attr['for'] = str_replace(array('[', ']'), array('_', ''), $label_attr['for']);
        $label_attr['id'] = str_replace(array('[', ']'), array('_', ''), $label_attr['id']);
    }

    $html = html_tag('label', $label_attr, __($label_locale, $label_locale_attr));
    return $html;
}

function html_input_text_wo_label($name, $value, array $attr = array())
{
    $attr['type'] = 'text';
    return html_input($name, $value, $attr);
}

function html_input_textarea_wo_label($name, $value, array $attr = array())
{
    $attr['name'] = $name;
    $attr['id'] = (!isset($attr['id'])) ? $name : $attr['id'];
    $attr['rows'] = 5;
    $attr['cols'] = 100;
    return html_tag('textarea', $attr, $value);
}

function html_input_password_wo_label($name, $value, array $attr = array())
{
    $attr['type'] = 'password';
    return html_input($name, $value, $attr);
}

function html_hidden($name, $value, array $attr = array())
{
    $attr['type'] = 'hidden';
    $attr['id'] = (isset($attr['id']) && !empty($attr['id'])) ? $attr['id'] : $name;
    $attr['name'] = (isset($attr['name']) && !empty($attr['name'])) ? $attr['name'] : $name;
    $attr['value'] = (isset($attr['value']) && !empty($attr['value'])) ? $attr['value'] : $value;
    return html_tag('input', $attr);
}


function html_input($name, $value, array $attr = array())
{
    $attr['id'] = (isset($attr['id']) && !empty($attr['id'])) ? : $name;


    if (preg_match('/\[.*\]/', $attr['id'])) {
        $attr['id'] = str_replace(array('[', ']'), array('_', ''), $attr['id']);
    }

    $attr['name'] = (isset($attr['name']) && !empty($attr['name'])) ? : $name;
    $attr['value'] = (isset($attr['value']) && !empty($attr['value'])) ? : $value;
    $html = html_tag('input', $attr);
    return $html;
}

function html_checkbox($name, $value, $checked = false, array $attr = array())
{

    $hidden_attr = $attr;
    $hidden_attr['id'] = $name . '_hidden';

    if ($checked == true) {
        $attr['checked'] = 'checked';
    }
    $attr['type'] = 'checkbox';
    /**
     * Wenn das Feld nicht gesetzt ist, default auf 0
     */
    $html = html_hidden($name, 0, $hidden_attr);
    $html .= html_input($name, $value, $attr);
    return $html;
}

function twitter_html_input_checkbox($name, $value, $placeholder_locale = null, array $placeholder_locale_params = array(), $checked = false, array $attr = array())
{
    $label_attr['class'] = 'control-label';
    $placeholder_locale = (!empty($placeholder_locale)) ? $placeholder_locale : __(extend_locale($name . '.label', $placeholder_locale_params));
    $html = html_hidden($name, 0);
    $html .= html_label($label_attr, $name, html_checkbox($name, $value, $checked, $attr) . ' ' . __($placeholder_locale, $placeholder_locale_params));
    return $html;
}

/**
 * @param string $name
 * @param string $value
 * @param string $label_locale
 * @param array $label_locale_params
 * @param array $label_attr
 * @param array $attr
 * @return string
 */
function html_input_text($name, $value, $label_locale, array $label_locale_params = array(), array $label_attr = array(), array $attr = array())
{
    $label_locale = (!empty($label_locale)) ? $label_locale : __(extend_locale($name . '.label', $label_locale_params));
    $html = html_label($label_attr, $name, $label_locale);
    $html .= html_input_text_wo_label($name, $value, $attr);
    return $html;
}

function html_input_textarea($name, $value, $label_locale, array $label_locale_params = array(), array $label_attr = array(), array $attr = array())
{
    $label_locale = (!empty($label_locale)) ? $label_locale : __(extend_locale($name . '.label', $label_locale_params));
    $html = html_label($label_attr, $name, $label_locale);
    $html .= html_input_textarea_wo_label($name, $value, $attr);
    return $html;
}

function html_input_password($name, $value, $label_locale, array $label_locale_params = array(), array $label_attr = array(), array $attr = array())
{
    $html = html_label($label_attr, $name, $label_locale);
    $html .= html_input_password_wo_label($name, $value, $attr);
    return $html;
}

/**
 * @param string $name
 * @param string $value
 * @param string $locale
 * @param array $locale_params
 * @param array $attr
 * @return string
 */
function html_submit_button($name, $value, $locale, array $locale_params = array(), array $attr = array())
{
    $attr['id'] = (isset($attr['id']) && !empty($attr['id'])) ? : $name;
    $attr['name'] = (isset($attr['name']) && !empty($attr['name'])) ? : $name;
    $attr['type'] = (isset($attr['type']) && !empty($attr['type'])) ? : 'submit';
    $attr['value'] = (isset($attr['value']) && !empty($attr['value'])) ? : $value;
    return html_button(__($locale, $locale_params), $attr);
}

function twitter_html_input_text_wo_label($name, $value, $placeholder_locale = null, array $placeholder_locale_params = array(), array $attr = array())
{
    $attr['placeholder'] = empty($placeholder_locale) ? __(extend_locale($name . '.label'), $placeholder_locale_params) : __($placeholder_locale, $placeholder_locale_params);
    //$attr['placeholder'] = __($placeholder_locale, $placeholder_locale_params);
    $html = html_input_text_wo_label($name, $value, $attr);
    return $html;
}

function twitter_html_input_password_wo_label($name, $value, $placeholder_locale, array $placeholder_locale_params = array(), array $attr = array())
{
    $attr['placeholder'] = __($placeholder_locale, $placeholder_locale_params);
    $html = html_input_password_wo_label($name, $value, $attr);
    return $html;
}

function twitter_submit_group($with_save = true, $with_save_next = true, $with_cancel = true)
{

    $save_button = ($with_save == true) ? twitter_html_submit_button('save', 'save', extend_locale('save.button.label'), array(), array('class' => 'btn-info')) . ' ' : '';
    $save_next_button = ($with_save_next == true) ? twitter_html_submit_button('save_next', 'save_next', extend_locale('save_next.button.label'), array(), array('class' => 'btn-success')) . ' ' : '';
    $cancel_buttons = ($with_cancel == true) ? twitter_html_submit_button('cancel', 'cancel', extend_locale('cancel.button.label'), array(), array('class' => 'btn-warning')) . ' ' : '';

    return html_tag('div', array('class' => 'control-group'),
        html_tag('div', array('class' => 'controls'),
            $save_button .
            $save_next_button .
            $cancel_buttons
        ));
}

function twitter_delete_group()
{
    return html_tag('div', array('class' => 'control-group'), html_tag('div', array('class' => 'controls'), twitter_html_submit_button('delete', 'delete', extend_locale('delete.button.label'), array(), array('class' => 'btn-danger')) . ' ' . twitter_html_submit_button('cancel', 'cancel', extend_locale('cancel.button.label'), array(), array('class' => 'btn-warning'))));
}

/**
 * @param string $name
 * @param string $value
 * @param string $label_locale
 * @param array $label_locale_params
 * @param array $label_attr
 * @param array $attr
 * @return string
 */
function twitter_html_input_text($name, $value, $label_locale = null, array $label_locale_params = array(), array $label_attr = array(), array $attr = array())
{
    $label_attr['class'] = 'control-label';
    $attr['placeholder'] = $label_locale = empty($label_locale) ? __(extend_locale($name . '.label'), $label_locale_params) : __($label_locale, $label_locale_params);
    $html = html_label($label_attr, $name, $label_locale);
    $html .= html_tag('div', array('class' => 'controls'), html_input_text_wo_label($name, $value, $attr));
    return $html;
}

function twitter_html_input_textarea($name, $value, $label_locale = null, array $label_locale_params = array(), array $label_attr = array(), array $attr = array())
{
    $label_attr['class'] = 'control-label';
    $label_locale = empty($label_locale) ? __(extend_locale($name . '.label'), $label_locale_params) : __($label_locale, $label_locale_params);
    $html = html_label($label_attr, $name, $label_locale);
    $html .= twitter_html_input_textarea_wo_label($name, $value, $label_locale, $label_locale_params);
    return $html;
}


function twitter_html_input_textarea_wo_label($name, $value, $label_locale = null, array $label_locale_params = array())
{
    $attr['placeholder'] = empty($label_locale) ? __(extend_locale($name . '.label'), $label_locale_params) : __($label_locale, $label_locale_params);
    $html = html_tag('div', array('class' => 'controls'), html_input_textarea_wo_label($name, $value, $attr));
    return $html;
}

function twitter_html_input_password($name, $value = null, $label_locale = null, array $label_locale_params = array(), array $label_attr = array(), array $attr = array())
{
    $label_attr['class'] = 'control-label';
    $label_locale = empty($label_locale) ? __(extend_locale($name . '.label'), $label_locale_params) : __($label_locale, $label_locale_params);
    $attr['placeholder'] = __($label_locale, $label_locale_params);
    $html = html_input_password($name, $value, $label_locale, $label_locale_params, $label_attr, $attr);
    return $html;
}

/**
 * @param string $name
 * @param string $value
 * @param string $locale
 * @param array $locale_params
 * @param array $attr
 * @return string
 */
function twitter_html_submit_button($name, $value, $locale = null, array $locale_params = array(), array $attr = array())
{
    $locale = empty($locale) ? __(extend_locale($name . '.label'), $locale_params) : __($locale, $locale_params);
    $attr['class'] = (isset($attr['class'])) ? 'btn ' . $attr['class'] : 'btn';
    return html_submit_button($name, $value, $locale, $locale_params, $attr);
}

/**
 * @param $value
 * @param array $attr
 * @return string
 */
function html_button($value, array $attr = array())
{
    return html_tag('button', $attr, $value);
}

function security_field()
{
    return html_hidden(\Config::get('security.csrf_token_key'), \Security::fetch_token());
}

/**
 *
 * Erzeugt eine Buttonliste, welche ausgeklappt wird, wenn diese angeklickt wird
 *
 * @param array $list
 * @param $value_locale
 * @param array $value_locale_params
 * @return string
 */
function twitter_button_group(array $list, $value_locale, array $value_locale_params = array(), $btn_size = 'btn-small')
{
    $html = '<div class="btn-group">';
    $html .= html_button(__($value_locale, $value_locale_params), array('class' => 'btn ' . $btn_size, 'data-toggle' => 'dropdown'));
    $html .= html_button(html_tag('span', array('class' => 'caret')), array('class' => 'btn ' . $btn_size . ' dropdown-toggle', 'data-toggle' => 'dropdown'));

    $list_elements = '';
    foreach ($list as $li) {
        if (isset($li['is_divider']) && $li['is_divider'] == true) {
            $list_elements .= html_tag('li', array('class' => 'divider'));
        } else {
            $list_elements .= html_tag('li', $li['attr'], $li['value']);
        }
    }

    $html .= html_tag('ul', array('class' => 'dropdown-menu'), $list_elements);

    $html .= '</div>';

    return $html;
}

/**
 *
 * erzeugt ein true oder false icon
 *
 * @param bool $value
 * @return string
 */
function boolean_icon($value)
{
    if ((bool)$value == true) {
        $html = html_tag('span', array('class' => 'badge badge-success'), html_tag('i', array('class' => 'icon-white icon-ok'), ''));
    } else {
        $html = html_tag('span', array('class' => 'badge badge-important'), html_tag('i', array('class' => 'icon-white icon-remove'), ''));
    }
    return $html;
}

/**
 * @return string
 */
function back_button($text, array $attr = array(), $offset = 1)
{
    return html_anchor(\Last_Pages::get_last_logic_page($offset), $text, $attr);
}

function html_anchor($href, $value = null, $attr = array(), $secure = null)
{
    if (preg_match('#^((http:|www\.).*)# i', $href, $matches) and !preg_match('#' . $_SERVER['HTTP_HOST'] . '# i', $matches[0])) {
        $attr['target'] = (!isset($attr['target'])) ? '_blank' : $attr['target'];
    }

    if (!preg_match('#^(\w+://|javascript:|\#)# i', $href)) {
        $urlparts = explode('?', $href, 2);
        $href = \Uri::create($urlparts[0], array(), isset($urlparts[1]) ? $urlparts[1] : array(), $secure);
    } elseif (!preg_match('#^(javascript:|\#)# i', $href) and  is_bool($secure)) {
        $href = http_build_url($href, array('scheme' => $secure ? 'https' : 'http'));
    }
    // Create and display a URL hyperlink
    is_null($value) and $value = $href;

    $value = __($value);

    $attr['href'] = $href;

    return html_tag('a', $attr, $value);
}

function html_select($name, array $options, $value, $label_locale, array $label_locale_params = array(), array $label_attr = array(), $multiselect = false, array $attr = array())
{
    $html = html_label($label_attr, $name, $label_locale, $label_locale_params);
    $html .= html_select_wo_label($name, $options, $value, $multiselect, $attr);
    return $html;
}

function html_select_wo_label($name, array $options, $value = null, $multiselect = false, array $attr = array())
{

    $attr['id'] = (isset($attr['id']) && !empty($attr['id'])) ? : $name;


    if (preg_match('/\[.*\]/', $attr['id'])) {
        $attr['id'] = str_replace(array('[', ']'), array('_', ''), $attr['id']);
    }


    $attr['name'] = (isset($attr['name']) && !empty($attr['name'])) ? : $name;
    $attr['multiple'] = $multiselect;
    $options_html = '';
    foreach ($options as $key => $opt) {
        $opt = __($opt);
        $opt_attr = array();
        $opt_attr['selected'] = $key == $value;
        $opt_attr['value'] = $key;
        $options_html .= html_tag('option', $opt_attr, $opt);
    }
    return html_tag('select', $attr, $options_html);

}

function twitter_html_select_wo_label($name, array $options, $value = null, $multiselect = false, array $attr = array())
{
    $html = html_tag('div', array('class' => 'controls'), html_select_wo_label($name, $options, $value, $multiselect, $attr));
    return $html;
}

function twitter_html_select($name, array $options, $value = null, $label_locale = null, array $label_locale_params = array(), array $label_attr = array(), $multiselect = false, array $attr = array())
{
    $label_attr['class'] = 'control-label';
    $attr['placeholder'] = $label_locale = empty($label_locale) ? __(extend_locale($name . '.label'), $label_locale_params) : __($label_locale, $label_locale_params);
    $html = html_label($label_attr, $name, $label_locale);
    $html .= html_tag('div', array('class' => 'controls'), html_select_wo_label($name, $options, $value, $multiselect, $attr));
    return $html;
}

function form_help_text($prefix)
{
    return __(extend_locale($prefix . '.help.label'));
}

function h($size, $value, $attr = array())
{
    $size = (int)$size;
    $size = ($size > 0 && $size < 7) ? $size : 6;
    return html_tag('h' . $size, $attr, $value);
}

function h1($value, $attr = array())
{
    return h(1, $value, $attr);
}

function h2($value, $attr = array())
{
    return h(2, $value, $attr);
}

function h3($value, $attr = array())
{
    return h(3, $value, $attr);
}

function h4($value, $attr = array())
{
    return h(4, $value, $attr);
}

function h5($value, $attr = array())
{
    return h(5, $value, $attr);
}

function h6($value, $attr = array())
{
    return h(6, $value, $attr);
}

function named_route($route_name, $route_params = array(), $route_must_exists = false)
{
    if ($route_must_exists == true && !\Router::get_route($route_name)) {
        throw new \Exception(__('exception.function.named_route.route_not_exists', array('route_name' => $route_name)));
    } elseif (!\Router::get_route($route_name)) {
        $route_path = $route_path_wo_params = str_replace('_', '/', $route_name);
        if(!empty($route_params)) {
            foreach($route_params as $pa_key => $p) {
                $route_path .= '/(:' . $pa_key . ')';
            }
        }
        $route_options = array($route_path_wo_params, 'name' => $route_name);
        \Router::add($route_path, $route_options);
        //return null;
    }

    $route = \Router::$routes[$route_name]->path;
    /**
     * um zu prüfen ob alle erforderlichen parameter mit übergeben wurden
     */
    if (preg_match_all('/(?<=:)[\w_]{1,}/', $route, $params)) {
        if (empty($route_params)) {
            throw new \Exception(__('exception.function.named_route.no_route_params'));
        }
        foreach ($params[0] as $p) {
            if (!isset($route_params[$p])) {
                throw new \Exception(__('exception.function.named_route.missing_route_param', array('param', $p)));
            }
        }
    }
    return \Router::get($route_name, $route_params);
}

function twitter_anchor($route, $label, array $attr = array(), $secure = false)
{
    $attr['class'] = isset($attr['class']) ? $attr['class'] . ' ' : '';
    $attr['class'] .= 'btn';
    return html_anchor($route, $label, $attr, $secure);
}

function serializer($value)
{
    return addslashes(serialize($value));
}

function unserializer($value)
{
    return unserialize(stripslashes($value));
}

function current_uri()
{
    return \Uri::current();
}

function order_anchor($name, $label, $model_name = null)
{
    $params = \Input::get();
    $uri = \Request::active()->uri;
    if ((isset($params['order']) || isset($params[$model_name]['order']))
        && ((isset($params['order_field']) && $params['order_field'] == $name) || (isset($params[$model_name]) && isset($params[$model_name]['order_field']) && $params[$model_name]['order_field'] == $name))
    ) {
        if ($model_name != null) {
            $get_params[$model_name] = array(
                'order' => 1,
                'order_field' => $name,
                'order_type' => (isset($params[$model_name]) && isset($params[$model_name]['order_type']) && $params[$model_name]['order_type'] == 'ASC') ? 'DESC' : 'ASC'
            );
            unset($params[$model_name]['order'], $params[$model_name]['order_type'], $params[$model_name]['order_field']);
        } else {
            $get_params = array(
                'order' => 1,
                'order_field' => $name,
                'order_type' => ($params['order_type'] == 'ASC') ? 'DESC' : 'ASC'
            );
            unset($params['order'], $params['order_type'], $params['order_field']);
        }

        $get_params = array_merge($params, $get_params);

        $class_name = isset($get_params['order_type']) ? strtolower($get_params['order_type']) : strtolower($get_params[$model_name]['order_type']);

        $anchor_params = array('class' => $class_name);
    } else {
        if ($model_name != null) {
            $get_params[$model_name] = array(
                'order' => 1,
                'order_field' => $name,
                'order_type' => 'ASC'
            );
        } else {
            $get_params[$model_name] = array(
                'order' => 1,
                'order_field' => $name,
                'order_type' => 'ASC'
            );
        }

        $get_params = array_merge($params, $get_params);
        $anchor_params = array();
    }
    $uri = \Uri::create($uri, array(), $get_params);
    return html_anchor($uri, $label, $anchor_params);
}


function html_js_void_anchor($value, $id, $attr = array())
{
    $attr['id'] = $id;
    return html_anchor('javascript: void(0)', $value, $attr);
}

function globr($pattern = '*', $flags = 0, $path = false, $depth = 0, $level = 0)
{
    $tree = array();

    $files = glob($path . $pattern, $flags);
    $paths = glob($path . '*', GLOB_ONLYDIR | GLOB_NOSORT);

    if (!empty($paths) && ($level < $depth || $depth == -1)) {
        $level++;
        foreach ($paths as $sub_path) {
            $tree[$sub_path] = globr($pattern, $flags, $sub_path . DIRECTORY_SEPARATOR, $depth, $level);
        }
    }

    $tree = array_merge($tree, $files);

    return $tree;
}