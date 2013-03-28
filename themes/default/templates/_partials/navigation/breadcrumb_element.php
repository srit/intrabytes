<?php
/**
 * @created 28.03.13 - 11:08
 * @author stefanriedel
 */
$anchor_attributes = array();
$li_class = '';
if($last == true) {
    $li_class .= ' active';
}

$li_class = trim($li_class);
?>
<li<?php echo ($li_class != '') ? ' class="' . $li_class . '"' : '' ?>>
    <?php if($last == false): echo html_anchor($element->route, __('breadcrumb.' . $element->name . '.anchor.label'), $anchor_attributes) ?> <?php echo html_tag('span', array('class' => 'divider'), '/') ?>
    <?php else: echo __('breadcrumb.' . $element->name . '.anchor.label'); endif;?>
</li>