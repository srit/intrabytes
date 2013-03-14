<?php
/**
 * @created 05.02.13 - 13:02
 * @author stefanriedel
 */
$customer = $crud_objects['customer']['data'];
?>

<form method="post" accept-charset="utf-8" id="customer">
    <div class="span11">
        <?php echo security_field(); ?>
        <?php echo html_legend(extend_locale('legend')); ?>
    </div>
    <div class="span3">
        <div class="control-group">
            <?php echo twitter_html_input_text('company_name', xss_clean($customer->company_name), null, array(), array(), array('tabindex' => 1)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_select('salutation_id', $salutations, xss_clean($customer->salutation_id), extend_locale('salutation.label'), array(), array(), false, array('tabindex' => 3)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('firstname', xss_clean($customer->firstname), null, array(), array(), array('tabindex' => 5)) ?>
        </div>
        <div class="control-group">
            <?php echo twitter_html_input_text('street', xss_clean($customer->street), null, array(), array(), array('tabindex' => 7)) ?>
        </div>

        <div class="control-group">
            <?php echo twitter_html_input_text('postalcode_text', xss_clean($customer->postalcode_text), null, array(), array(), array('tabindex' => 9, 'autocomplete' => 'off', 'data-provide' => 'typeahead', 'data-link' => \Uri::create('/customers/postalcodes/rest/search'))) ?>
            <?php echo html_hidden('postalcode_id', '') ?>
        </div>


        <div class="control-group">
            <?php echo twitter_html_select('country_id', $countries, xss_clean($customer->country_id), extend_locale('country.label'), array(), array(), false, array('tabindex' => 11)) ?>
        </div>

    </div>
    <div class="span3">

        <div class="control-group">
            <?php echo twitter_html_input_text('phone', xss_clean($customer->phone), null, array(), array(), array('tabindex' => 2)) ?>
        </div>

        <div class="control-group">
            <?php echo twitter_html_input_text('fax', xss_clean($customer->fax), null, array(), array(), array('tabindex' => 4)) ?>
        </div>


        <div class="control-group">
            <?php echo twitter_html_input_text('lastname', xss_clean($customer->lastname), null, array(), array(), array('tabindex' => 6)) ?>
        </div>

        <div class="control-group">
            <?php echo twitter_html_input_text('housenumber', xss_clean($customer->housenumber), null, array(), array(), array('class' => 'span2', 'tabindex' => 8)) ?>
        </div>

        <div class="control-group">
            <?php echo twitter_html_input_text('city_text', xss_clean($customer->city_text), null, array(), array(), array('class' => '', 'tabindex' => 10)) ?>
        </div>

        <div class="control-group">
            <?php echo twitter_html_input_text('email', xss_clean($customer->email), null, array(), array(), array('tabindex' => 12)) ?>
        </div>

    </div>
    <div class="span5">
        <?php echo form_help_text('customer') ?>
    </div>
    <div class="span11">
        <?php echo twitter_submit_group() ?>
    </div>
</form>