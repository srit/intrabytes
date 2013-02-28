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
            <div class="controls">
                <?php echo twitter_html_input_text('customer[company_name]', xss_clean($customer->company_name), null, array(), array(), array('tabindex' => 1)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_select('customer[salutation_id]', $salutations, xss_clean($customer->salutation_id), extend_locale('salutation.label'), array(), array(), false, array('tabindex' => 3)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_input_text('customer[firstname]', xss_clean($customer->firstname), null, array(), array(), array('tabindex' => 5)) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_input_text('customer[street]', xss_clean($customer->street), null, array(), array(), array('tabindex' => 7)) ?>

            </div>
        </div>

        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_input_text('customer[postalcode_text]', xss_clean($postalcode_text), null, array(), array(), array('tabindex' => 9, 'autocomplete' => 'off', 'data-provide' => 'typeahead', 'data-link' => \Uri::create('/customers/postalcodes/rest/search'))) ?>
                <?php echo html_hidden('customer[postalcode_id]', '') ?>
            </div>
        </div>



        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_select('customer[country_id]', $countries, xss_clean($country_id), extend_locale('country.label'), array(), array(), false, array('tabindex' => 11)) ?>
            </div>
        </div>

    </div>
    <div class="span3">

        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('customer[phone]', xss_clean($customer->phone), null, array(), array(), array('tabindex' => 2)) ?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('customer[fax]', xss_clean($customer->fax), null, array(), array(), array('tabindex' => 4)) ?>
            </div>
        </div>




        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_input_text('customer[lastname]', xss_clean($customer->lastname), null, array(), array(), array('tabindex' => 6)) ?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_input_text('customer[housenumber]', xss_clean($customer->housenumber), null, array(), array(), array('class' => 'span2', 'tabindex' => 8)) ?>

            </div>
        </div>

        <div class="control-group">
            <div class="controls controls-row">
                <?php echo twitter_html_input_text('customer[city_text]', xss_clean($city_text), null, array(), array(), array('class' => '', 'tabindex' => 10)) ?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <?php echo twitter_html_input_text('customer[email]', xss_clean($customer->email), null, array(), array(), array('tabindex' => 12)) ?>
            </div>
        </div>

    </div>
    <div class="span11">
        <?php echo twitter_submit_group() ?>
    </div>
</form>


<script type="text/javascript">
    $(document).ready(function () {
        $('[data-provide="typeahead"]').typeahead({
            source:function (query, process) {
                var link = $(this)[0].$element[0].dataset.link;
                var country_id = $('#customer_country_id option:selected').val();
                return $.getJSON(link, { query:query, country_id:country_id }, function (data) {
                    return process(data.options);
                });
            },
            updater:function (item, process) {
                var map = item.split(" - ");
                var link = '<?php echo \Fuel\Core\Uri::create('/customers/postalcodes/rest/fetch') ?>';
                var country_id = $('#customer_country_id option:selected').val();
                $.getJSON(link, { postalcode:map[0], country_id:country_id }, function (data) {
                    var postalcode_id_field = $('#customer_postalcode_id');
                    var postalcode_text_field = $('#customer_postalcode_text');
                    var city_text_field = $('#customer_city_text');
                    postalcode_id_field.val(data.id);
                    city_text_field.val(data.city);
                    postalcode_text_field.val(data.postalcode);
                });
            }
        });
    });

</script>