<?php
/**
 * @created 29.01.13 - 14:02
 * @author stefanriedel
 */
?>

<div class="span5">
    <form method="post" accept-charset="utf-8">
        <div class="span11">
            <?php echo security_field(); ?>
            <?php echo html_legend(extend_locale('legend')); ?>
        </div>
        <div class="span11">
            <div class="control-group">
                <div class="controls">
                    <?php echo twitter_html_input_text('locale', xss_clean($language->locale)) ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php echo twitter_html_input_text('language', xss_clean($language->language)) ?>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <?php echo twitter_html_input_text('plain', xss_clean($language->plain)) ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php echo twitter_html_input_checkbox('default', 1, null, array(), xss_clean($language->default)) ?>
                </div>
            </div>
        </div>
        <div class="span11">
            <?php echo twitter_submit_group() ?>
        </div>
    </form>
</div>