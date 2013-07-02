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
            <?php echo twitter_html_input_text('locale', xss_clean($language->get_locale())) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('language', xss_clean($language->get_language())) ?>
        </div>

        <div class="control-group">
            <?php echo twitter_html_input_text('plain', xss_clean($language->get_plain())) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_select('currency', array('EUR' => '€', 'USD' => '$') , xss_clean($language->get_currency())) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_select('thousand_separator', array(',' => ',', '.' => '.') , xss_clean($language->get_thousand_separator())) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_select('dec_point', array(',' => ',', '.' => '.') , xss_clean($language->get_dec_point())) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('date_format', xss_clean($language->get_date_format())) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('date_time_format', xss_clean($language->get_date_time_format())) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_checkbox('active', 1, null, array(), xss_clean($language->get_active())) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_checkbox('default', 1, null, array(), xss_clean($language->get_default())) ?>
        </div>
        <?php echo twitter_submit_group() ?>
    </div>
    <div class="span5">
        <?php echo form_help_text('languages') ?>
    </div>
</form>
