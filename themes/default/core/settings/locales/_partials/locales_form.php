<?php
/**
 * @created 01.03.13 - 20:26
 * @author stefanriedel
 */
?>

<form method="post" accept-charset="utf-8">
    <div class="span12">
        <?php echo security_field(); ?>
        <?php echo html_legend(extend_locale('legend')); ?>
        <?php echo html_hidden('language_id', $language_id) ?>
    </div>
    <div class="span7">
        <div class="control-group">
            <?php echo twitter_html_input_text('key', xss_clean($locale->key)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('group', xss_clean($locale->group), null, array(), array(), array('autocomplete' => 'off', 'data-provide' => 'typeahead', 'data-link' => \Uri::create('/core/settings/locales/rest/search'))) ?>
        </div>

        <div class="control-group">
            <?php echo twitter_html_input_textarea('value', xss_clean($locale->value), null, array(), array(), array('style' => 'width: 550px; height: 200px;')) ?>
        </div>
        <?php echo twitter_submit_group() ?>
    </div>
    <div class="span4">
        <?php echo form_help_text('locales') ?>
    </div>
</form>