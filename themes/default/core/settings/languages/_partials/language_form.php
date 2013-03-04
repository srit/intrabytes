<?php
/**
 * @created 29.01.13 - 14:02
 * @author stefanriedel
 */
?>

<form method="post" accept-charset="utf-8">
    <div class="span11">
        <?php echo security_field(); ?>
        <?php echo html_legend(extend_locale('legend')); ?>
    </div>
    <div class="span6">
        <div class="control-group">
            <?php echo twitter_html_input_text('locale', xss_clean($language->locale)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('language', xss_clean($language->language)) ?>
        </div>

        <div class="control-group">
            <?php echo twitter_html_input_text('plain', xss_clean($language->plain)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_checkbox('default', 1, null, array(), xss_clean($language->default)) ?>
        </div>
        <?php echo twitter_submit_group() ?>
    </div>
    <div class="span5">
        <?php echo form_help_text('languages') ?>
    </div>
</form>
