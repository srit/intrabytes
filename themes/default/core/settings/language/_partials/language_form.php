<?php
/**
 * @created 29.01.13 - 14:02
 * @author stefanriedel
 */
?>

<div class="span5">
    <form method="post" accept-charset="utf-8">
        <?php echo security_field(); ?>

        <?php echo html_legend(extend_locale('legend'), array(':sprache' => xss_clean($language->plain))); ?>

        <?php echo twitter_html_input_text('locale', xss_clean($language->locale), extend_locale('locale.label')) ?>
        <?php echo twitter_html_input_text('language', xss_clean($language->language), extend_locale('language.label')) ?>
        <?php echo twitter_html_input_text('plain', xss_clean($language->plain), extend_locale('plain.label')) ?>

        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_submit_button('save', 'save', extend_locale('save.button.label')) ?>
                <?php echo twitter_html_submit_button('cancel', 'cancel', extend_locale('cancel.button.label')) ?>
            </div>
        </div>
    </form>
</div>