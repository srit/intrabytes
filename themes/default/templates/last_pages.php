<?php
/**
 * @created 28.03.13 - 16:04
 * @author stefanriedel
 */

//$last_pages = \Fuel\Core\Arr::assoc_to_keyval($last_pages, 'uri', 'title');

$action_links = array();
if(!empty($last_pages)) {
    foreach($last_pages as $last_page) {
        $action_links[] = array('attr' => array(), 'value' => html_anchor($last_page['uri'], $last_page['title']));
    }
}

?>
<div class="breadcrumb">
   <?php echo twitter_button_group($action_links, 'last_pages.actions.label'); ?>
</div>