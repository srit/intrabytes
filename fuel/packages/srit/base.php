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
function extend_locale ($locale) {
    return \Srit\Locale::instance()->getLocalePrefix() . '.' . $locale;
}

/**
 * @param string $locale
 * @param array $locale_params
 * @param array $attr
 * @return string
 */
function html_legend($locale, array $locale_params = array(), array $attr = array()) {
    return html_tag('legend', $attr, __($locale, $locale_params));
}

/**
 * @param array $label_attr
 * @param string $for
 * @param string $label_locale
 * @return string
 */
function html_label(array $label_attr, $for, $label_locale)
{
    $label_attr['for'] = (isset($attr['for']) && !empty($label_attr['for'])) ? : $for;
    $label_attr['id'] = (isset($attr['id']) && !empty($label_attr['id'])) ? $label_attr['id'] : 'label_' . $for;
    $html = html_tag('label', $label_attr, __($label_locale, $label_attr));
    return $html;
}

function html_input_text_wo_label($name, $value, array $attr = array()) {
    $attr['type'] = 'text';
    return html_input($name, $value, $attr);
}

function html_input_password_wo_label($name, $value, array $attr = array()) {
    $attr['type'] = 'password';
    return html_input($name, $value, $attr);
}

function html_hidden($name, $value, array $attr = array()) {
    $attr['type'] = 'hidden';
    $attr['id'] = (isset($attr['id']) && !empty($attr['id'])) ?: $name;
    $attr['name'] = (isset($attr['name']) && !empty($attr['name'])) ?: $name;
    $attr['value'] = (isset($attr['value']) && !empty($attr['value'])) ?: $value;
    return html_tag('input', $attr);
}

function html_input($name, $value, array $attr = array()) {
    $attr['id'] = (isset($attr['id']) && !empty($attr['id'])) ?: $name;
    $attr['name'] = (isset($attr['name']) && !empty($attr['name'])) ?: $name;
    $attr['value'] = (isset($attr['value']) && !empty($attr['value'])) ?: $value;
    $html = html_tag('input', $attr);
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
function html_input_text($name, $value, $label_locale, array $label_locale_params = array(), array $label_attr = array(), array $attr = array()) {
    $html = html_label($label_attr, $name, $label_locale);
    $html .= html_input_text_wo_label($name, $value, $attr);
    return $html;
}

function html_input_password($name, $value, $label_locale, array $label_locale_params = array(), array $label_attr = array(), array $attr = array()) {
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
function html_submit_button($name, $value, $locale, array $locale_params = array(), array $attr = array()) {
    $attr['id'] = (isset($attr['id']) && !empty($attr['id'])) ?: $name;
    $attr['name'] = (isset($attr['name']) && !empty($attr['name'])) ?: $name;
    $attr['type'] = (isset($attr['type']) && !empty($attr['type'])) ?: 'submit';
    $attr['value'] = (isset($attr['value']) && !empty($attr['value'])) ?: $value;
    return html_button(__($locale, $locale_params), $attr);
}

function twitter_html_input_text_wo_label($name, $value, $placeholder_locale, array $placeholder_locale_params = array(), array $attr = array()) {
    $attr['placeholder'] = __($placeholder_locale, $placeholder_locale_params);
    return html_input_text_wo_label($name, $value, $attr);
}

function twitter_html_input_password_wo_label($name, $value, $placeholder_locale, array $placeholder_locale_params = array(), array $attr = array()) {
    $attr['placeholder'] = __($placeholder_locale, $placeholder_locale_params);
    return html_input_password_wo_label($name, $value, $attr);
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
function twitter_html_input_text($name, $value, $label_locale, array $label_locale_params = array(), array $label_attr = array(), array $attr = array()) {
    $label_attr['class'] = 'control-label';
    $attr['placeholder'] = __($label_locale, $label_locale_params);
    return html_input_text($name, $value, $label_locale, $label_locale_params, $label_attr, $attr);
}

function twitter_html_input_password($name, $value, $label_locale, array $label_locale_params = array(), array $label_attr = array(), array $attr = array()) {
    $label_attr['class'] = 'control-label';
    $attr['placeholder'] = __($label_locale, $label_locale_params);
    return html_input_password($name, $value, $label_locale, $label_locale_params, $label_attr, $attr);
}

/**
 * @param string $name
 * @param string $value
 * @param string $locale
 * @param array $locale_params
 * @param array $attr
 * @return string
 */
function twitter_html_submit_button($name, $value, $locale, array $locale_params = array(), array $attr = array()) {
    $attr['class'] = (isset($attr['class'])) ? 'btn ' . $attr['class'] : 'btn';
    return html_submit_button($name, $value, $locale, $locale_params, $attr);
}

/**
 * @param $value
 * @param array $attr
 * @return string
 */
function html_button($value, array $attr = array()) {
    return html_tag('button', $attr, $value);
}

function security_field() {
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
function twitter_button_group(array $list, $value_locale, array $value_locale_params = array()) {
    $html = '<div class="btn-group">';
    $html .= html_button(__($value_locale, $value_locale_params), array('class' => 'btn btn-mini', 'data-toggle' => 'dropdown'));
    $html .= html_button(html_tag('span', array('class'=>'caret')), array('class' => 'btn btn-mini dropdown-toggle', 'data-toggle' => 'dropdown'));

    $list_elements = '';
    foreach($list as $li) {
        $list_elements .= html_tag('li', $li['attr'], $li['value']);
    }

    $html .= html_tag('ul', array('class' => 'dropdown-menu'), $list_elements);

    $html .= '</div>';

    return $html;
}

/**
 *
 * erzeugt ein true oder fals icon
 *
 * @param bool $value
 * @return string
 */
function boolean_icon($value) {
    if((bool)$value == true) {
        $html = html_tag('span', array('class' => 'label label-success'), html_tag('i', array('class' => 'icon-white icon-ok'), ''));
    } else {
        $html = html_tag('span', array('class' => 'label label-important'), html_tag('i', array('class' => 'icon-white icon-remove'), ''));
    }
    return $html;
}


function html_anchor($href, $value = null, $attr = array(), $secure = null) {
    if ( ! preg_match('#^(\w+://|javascript:|\#)# i', $href))
    {
        $urlparts = explode('?', $href, 2);
        $href = \Uri::create($urlparts[0], array(), isset($urlparts[1])?$urlparts[1]:array(), $secure);
    }
    elseif ( ! preg_match('#^(javascript:|\#)# i', $href) and  is_bool($secure))
    {
        $href = http_build_url($href, array('scheme' => $secure ? 'https' : 'http'));
    }

    // Create and display a URL hyperlink
    is_null($value) and $value = $href;

    $value = __($value);

    $attr['href'] = $href;

    return html_tag('a', $attr, $value);
}
