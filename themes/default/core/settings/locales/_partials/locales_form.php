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
    </div>
    <div class="span7">
        <div class="control-group">
            <?php echo twitter_html_input_text('key', xss_clean($locale->key)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('group', xss_clean($locale->group), null, array(), array(), array('autocomplete' => 'off', 'data-provide' => 'typeahead', 'data-link' => \Uri::create('/core/settings/locales/rest/search'))) ?>
        </div>
        <!--<div class="tabbable">
            <ul class="nav nav-tabs" id="tab">
                <li>
                    <a href="#de">users.settings.profile.edit.profile.tab.label</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="de">
                    <div class="control-group">
                        <?php echo twitter_html_input_textarea('value_de', xss_clean($locale->value_de), null, array(), array(), array('style' => 'width: 550px; height: 200px;')) ?>
                    </div>

                </div>
            </div>
        </div>-->
        <?php echo twitter_translate_textareas('value', $locale); ?>
    </div>
    <div class="span4">
        <?php echo form_help_text('locales') ?>
    </div>
    <div class="span12">
        <?php echo twitter_submit_group() ?>
    </div>
</form>