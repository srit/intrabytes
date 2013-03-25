<?php
/**
 * @created 21.03.13 - 16:33
 * @author stefanriedel
 */?>
<ul class="nav pull-right">
    <?php foreach($elements as $element): ?>
        <?php echo $theme->view('templates/_partials/navigation/top_element', array('element' => $element), false) ?>
    <?php endforeach; ?>
</ul>