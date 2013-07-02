<?php
/**
 * @created 09.04.13 - 21:35
 * @author stefanriedel
 */
?>
<form method="post" accept-charset="utf-8" id="customer">
    <?php echo security_field(); ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="span5">
                <div class="control-group">
                    <?php echo twitter_html_input_text('user_profile[firstname]', xss_clean($profile->get_firstname())) ?>
                </div>
                <div class="control-group">
                    <?php echo twitter_html_input_text('user_profile[lastname]', xss_clean($profile->get_lastname())) ?>
                </div>
                <div class="control-group">
                    <?php echo twitter_html_input_text('user_profile[birthday]', xss_clean($profile->get_birthday())) ?>
                </div>
                <div class="control-group">
                    <?php echo twitter_html_select('user_profile[language_id]', $languages, xss_clean($profile->get_language_id()), extend_locale('language.label')) ?>
                </div>
                <?php echo twitter_submit_group(false, true, false) ?>
            </div>
            <div class="span6"><?php echo form_help_text('edit_my_profile') ?></div>
        </div>
    </div>
</form>