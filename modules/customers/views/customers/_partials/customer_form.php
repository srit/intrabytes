<?php
/**
 * @created 05.02.13 - 13:02
 * @author stefanriedel
 */
?>
<div class="span10">
    <form method="post" accept-charset="utf-8" id="customer">
        <?php echo security_field(); ?>
        <?php echo html_legend(extend_locale('legend')); ?>
        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('company_name', xss_clean($customer->company_name)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_select('salutation_id', $salutations, xss_clean($customer->salutation_id), extend_locale('salutation.label')) ?>
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

                <?php echo twitter_html_input_text_wo_label('postalcode_text', xss_clean($postalcode_text), null, array(), array('class' => 'span1', 'autocomplete' => 'off', 'data-provide' => 'typeahead', 'data-link' => \Fuel\Core\Uri::create('/customers/postalcodes/rest/search'))) ?>
                <?php echo twitter_html_input_text_wo_label('city_text', xss_clean($city_text), null, array(), array('class' => 'span1')) ?>
                <?php echo html_hidden('postalcode_id', '') ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_select('country_id', $countries, xss_clean($country_id), extend_locale('country.label')) ?>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-provide="typeahead"]').typeahead({
            source: function (query, process) {
                var link = $(this)[0].$element[0].dataset.link;
                var country_id = $('#country_id option:selected').val();
                return $.getJSON(link, { query: query, country_id:country_id }, function (data) {
                    return process(data.options);
                });
            },
            updater: function (item, process) {
                var map = item.split(" - ");
                var link = '<?php echo \Fuel\Core\Uri::create('/customers/postalcodes/rest/fetch') ?>';
                var country_id = $('#country_id option:selected').val();
                $.getJSON(link, { postalcode: map[0], country_id:country_id }, function (data) {
                    var postalcode_id_field = $('#postalcode_id');
                    var postalcode_text_field = $('#postalcode_text');
                    var city_text_field = $('#city_text');
                    postalcode_id_field.val(data.id);
                    city_text_field.val(data.city);
                    postalcode_text_field.val(data.postalcode);
                });
            }
        });
    });

</script>