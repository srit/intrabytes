<?php
/**
 * @created 28.03.13 - 16:04
 * @author stefanriedel
 */

//$last_pages = \Fuel\Core\Arr::assoc_to_keyval($last_pages, 'uri', 'title');

$action_links = array();
if (!empty($last_pages)) {
    foreach ($last_pages as $i => $last_page) {
        if ($i !== 0) {
            $action_links[] = array('attr' => array(), 'value' => html_anchor($last_page['uri'], $last_page['title']));
        } else {
            $action_links[] = array('attr' => array(), 'value' => html_anchor($last_page['uri'], $last_page['title']));
            $action_links[] = array('is_divider' => true);
        }
    }
}

?>
<div class="breadcrumb">
    <?php if (!empty($last_pages) && isset($last_pages[1]) && isset($last_pages[1]['uri'])): ?>
        <?php echo html_anchor($last_pages[1]['uri'], __('back.button.label'), array('class' => 'btn btn-small')) ?>
    <?php endif; ?>
    <?php echo twitter_button_group($action_links, 'last_pages.actions.label', array()); ?>
</div>