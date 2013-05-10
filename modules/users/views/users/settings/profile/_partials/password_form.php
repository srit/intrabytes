<?php
/**
 * @created 15.04.13 - 13:13
 * @author stefanriedel
 */
?>
<form method="post" accept-charset="utf-8" id="pa">
    <?php echo security_field(); ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="span5">
                <div class="control-group">
                    <?php echo twitter_html_input_password('user[password]') ?>
                </div>
                <div class="control-group">
                    <?php echo twitter_html_input_password('user[password_repeat]') ?>
                </div>
                <?php echo twitter_submit_group(false, true, false) ?>
            </div>
            <div class="span6"><?php echo form_help_text('change_password') ?></div>
        </div>
    </div>
</form>