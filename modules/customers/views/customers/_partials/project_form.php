<?php
/**
 * @created 05.02.13 - 13:02
 * @author stefanriedel
 */
?>
<div class="span10">
    <form method="post" accept-charset="utf-8">
        <?php echo security_field(); ?>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('name', xss_clean($project->name)) ?>
            </div>
        </div>
        <?php echo twitter_submit_group() ?>
    </form>
</div>