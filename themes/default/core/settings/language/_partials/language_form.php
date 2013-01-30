<?php
/**
 * @created 29.01.13 - 14:02
 * @author stefanriedel
 */
?>

<div class="span6">
    <form method="post" accept-charset="utf-8" class="pull-left">
        <?php echo \Form::hidden(\Config::get('security.csrf_token_key'), \Security::fetch_token());?>

        <?php echo html_legend(extend_locale('legend'), array(':sprache' => xss_clean($language->plain))); ?>

        <?php echo twitter_html_input_text('locale', xss_clean($language->locale), extend_locale('locale.label')) ?>
        <?php echo twitter_html_input_text('language', xss_clean($language->language), extend_locale('language.label')) ?>
        <?php echo twitter_html_input_text('plain', xss_clean($language->plain), extend_locale('plain.label')) ?>

        <div class="control-group">
            <div class="controls">
                <button class="btn" name="save" value="save"
                        type="submit"><?php echo __('core.settings.language.edit.save.button.label') ?></button>
                <button class="btn" name="cancel" value="cancel"
                        type="submit"><?php echo __('core.settings.language.edit.cancel.button.label') ?></button>
            </div>
        </div>
    </form>
</div>