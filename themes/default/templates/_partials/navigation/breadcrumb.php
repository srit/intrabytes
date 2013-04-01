<?php
/**
 * @created 28.03.13 - 10:55
 * @author stefanriedel
 */?>
<ul class="breadcrumb">
    <li><?php echo __('breadcrumb.prefix.label');?></li>
    <?php
        $cnt_elements = count($breadcrumb_elements);
        foreach($breadcrumb_elements as $i => $element) {
            $last = ($cnt_elements-1 == $i);
            echo $theme->view('templates/_partials/navigation/breadcrumb_element', array('element' => $element, 'last' => $last), false);
        }
    ?>
</ul>