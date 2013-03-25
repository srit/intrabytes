<?php
/**
 * @created 25.03.13 - 11:28
 * @author stefanriedel
 */
$class = ((bool)$element->active) ? 'active' : '';
$class .= ((bool)$element->hasChildren()) ? ' dropdown' : '';
$class = trim($class);

$anchor_attributes = array();
if ($element->hasChildren()) {
    $anchor_attributes = array_merge($anchor_attributes, array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
}

?>
<li<?php echo ($class != '') ? ' class="' . $class . '"' : '' ?>>
    <?php echo html_anchor($element->route, __('navigation.' . $element->name . '.anchor.label'), $anchor_attributes) ?>
    <?php if ((bool)$element->hasChildren() == true): ?>
        <ul class="dropdown-menu">
            <?php foreach ($element->getChildren() as $child_element): ?>
                <?php echo $theme->view('templates/_partials/navigation/top_element', array('element' => $child_element), false) ?>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</li>