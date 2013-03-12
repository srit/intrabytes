<?php
/**
 * @created 08.03.13 - 12:15
 * @author stefanriedel
 */
?>


<form method="post" accept-charset="utf-8" id="customer">
    <div class="span12">
        <?php echo security_field(); ?>
        <?php echo html_legend(extend_locale('legend')); ?>
    </div>
    <div class="span11">
        <?php echo twitter_delete_group() ?>
    </div>
</form>