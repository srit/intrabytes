<?php
/**
 * @created 29.01.13 - 14:02
 * @author stefanriedel
 */
?>

<div class="span6">
    <form method="post" accept-charset="utf-8" class="pull-left">
        <?php echo \Form::hidden(\Config::get('security.csrf_token_key'), \Security::fetch_token());?>

        <legend><?php echo __('core.settings.language.edit.legend', array(':sprache' => xss_clean($language->plain))) ?></legend>
        <label class="control-label"
               for="locale"><?php echo __('core.settings.language.edit.locale.label') ?></label>

        <input value="<?php echo xss_clean($language->locale) ?>" type="text" id="locale"
               placeholder="<?php echo __('core.settings.language.edit.locale.label') ?>" name="locale">
        <label class="control-label"
               for="language"><?php echo __('core.settings.language.edit.language.label') ?></label>
        <input value="<?php echo xss_clean($language->language) ?>" type="text" id="language"
               placeholder="<?php echo __('core.settings.language.edit.language.label') ?>" name="language">
        <label class="control-label"
               for="plain"><?php echo __('core.settings.language.edit.plain.label') ?></label>

        <input value="<?php echo xss_clean($language->plain) ?>" type="text" id="plain"
               placeholder="<?php echo __('core.settings.language.edit.plain.label') ?>" name="plain">

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