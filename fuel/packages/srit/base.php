<?php
/**
 * @created 29.01.13 - 14:55
 * @author stefanriedel
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

function getMonthArray($current = null)
{

    $months = array();
    for ($m = 1; $m <= 12; ++$m) {
        $months[] = array('month' => ($m >= 10) ? $m : '0' . $m, 'current' => (null == $current || $m != $current) ? false : true);
    }

    return $months;

}

function getYearArray($current = null, $before = 5, $after = 5)
{

    $year = (int)date('Y');
    $years = array();
    for ($y = $year - $before; $y <= $year + $after; ++$y) {
        $years[] = array('year' => $y, 'current' => (null == $current || $y != $current) ? false : true);
    }

    return $years;

}

function extend_locale ($locale) {
    return \Srit\Locale::instance()->getLocalePrefix() . '.' . $locale;
}

function html_legend($locale, array $locale_params = array(), array $attr = array()) {
    return html_tag('legend', $attr, __($locale, $locale_params));
}

function html_input_text($name, $value, $label_locale, array $label_locale_params = array(), array $label_attr = array(), array $attr = array()) {
    $label_attr['for'] = (!empty($label_attr['for'])) ?: $name;
    $html = html_tag('label', $label_attr, __($label_locale, $label_attr));
    $attr['id'] = (!empty($attr['id'])) ?: $name;
    $attr['name'] = (!empty($attr['name'])) ?: $name;
    $attr['value'] = (!empty($attr['value'])) ?: $value;
    $attr['type'] = 'text';
    $html .= html_tag('input', $attr);
    return $html;
}

function twitter_html_input_text($name, $value, $label_locale, array $label_locale_params = array(), array $label_attr = array(), array $attr = array()) {
    $label_attr['class'] = 'control-label';
    $attr['placeholder'] = __($label_locale, $label_attr);
    return html_input_text($name, $value, $label_locale, $label_locale_params, $label_attr, $attr);
}
