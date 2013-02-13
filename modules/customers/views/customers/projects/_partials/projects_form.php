<?php
/**
 * @created 13.02.2013
 * @author stefanriedel
 */
?>
<form method="post" accept-charset="utf-8" id="customer">
    <div class="span12">
        <?php echo security_field(); ?>
        <?php echo html_legend(extend_locale('legend')); ?>
    </div>
    <div class="span3">
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('name', xss_clean($project->name), null, array(), array(), array('tabindex' => 1)) ?>
            </div>
        </div>
    </div>
    <div class="span12">
        <?php echo twitter_submit_group() ?>
    </div>
</form>