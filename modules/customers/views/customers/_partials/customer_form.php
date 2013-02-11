<?php
/**
 * @created 05.02.13 - 13:02
 * @author stefanriedel
 */
?>
<div class="span10">
    <form method="post" accept-charset="utf-8">
        <?php echo security_field(); ?>
        <?php echo html_legend(extend_locale('legend')); ?>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('company_name', xss_clean($customer->company_name)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
            <?php echo twitter_html_select('salutation_id', $this->salutations, xss_clean($customer->salutation_id), extend_locale('salutation.label')) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_input_text('firstname', xss_clean($customer->firstname), null, array(), array(), array('class' => 'span2')) ?>
                <?php echo twitter_html_input_text_wo_label('lastname', xss_clean($customer->lastname), null, array(), array('class' => 'span2')) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('email', xss_clean($customer->email)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_input_text('street', xss_clean($customer->street), null, array(), array(), array('class' => 'span2')) ?>
                <?php echo twitter_html_input_text_wo_label('housenumber', xss_clean($customer->housenumber), null, array(), array('class' => 'span1')) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                
                <?php //echo twitter_html_input_text_wo_label('postalcode', xss_clean($customer->postalcode->postalcode), null, array(), array('class' => 'span1')) ?>
                <?php //echo twitter_html_input_text_wo_label('city', xss_clean($customer->postalcode->city), null, array(), array('class' => 'span1')) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
            <?php echo twitter_html_select('country_id', $this->countries, xss_clean($customer->postalcode->country_id), extend_locale('country.label')) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('phone', xss_clean($customer->phone)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('fax', xss_clean($customer->fax)) ?>
            </div>
        </div>
        <?php echo twitter_submit_group() ?>
    </form>
</div>