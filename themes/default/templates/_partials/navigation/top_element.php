<?php
/**
 * @created 25.03.13 - 11:28
 * @author stefanriedel
 */

if ($element->show == true && $element->allowed == true):
    $class = ((bool)$element->active) ? 'active' : '';

    $anchor_attributes = array();
    $child_elements = '';
    if ((bool)$element->hasChildren() == true) {

        foreach ($element->getChildren() as $child_element):
            $child_elements .= trim($theme->view('templates/_partials/navigation/top_element', array('element' => $child_element), false));
        endforeach;

        if (!empty($child_elements)):
            $class .= ' dropdown';
            $anchor_attributes = array_merge($anchor_attributes, array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
        endif;
    }

    $class = trim($class);

    ?>
    <li<?php echo ($class != '') ? ' class="' . $class . '"' : '' ?>>
        <?php echo html_anchor($element->get_route(), __('navigation.' . $element->name . '.anchor.label'), $anchor_attributes) ?>
        <?php if ((bool)$element->hasChildren() == true):


            if (!empty($child_elements)): ?>
                <ul class="dropdown-menu">
                    <?php echo $child_elements ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
    </li>

<?php endif; ?>