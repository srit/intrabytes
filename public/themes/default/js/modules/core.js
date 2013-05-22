/**
 * @created 05.03.13 - 10:02
 * @author stefanriedel
 */
$(document).ready(function () {
    $('#group[data-provide="typeahead"]').typeahead({
        source: function (query, process) {
            var link = $(this)[0].$element[0].dataset.link;
            var what = $(this)[0].$element[0].name;
            var language_id = $('#language_id').val();
            console.log(language_id);
            return $.getJSON(link, { query: query, what: what, language_id: language_id }, function (data) {
                return process(data.options);
            });
        }
    });

    $('#postalcode_text[data-provide="typeahead"]').typeahead({
        source: function (query, process) {
            var link = $(this)[0].$element[0].dataset.link;
            var country_id = $('#country_id option:selected').val();
            var what = $(this)[0].$element[0].name;
            return $.getJSON(link, { query: query, country_id: country_id, what: what }, function (data) {
                return process(data.options);
            });
        },
        updater: function (item, process) {
            var map = item.split(" - ");
            var link = '/core/customers/postalcodes/rest/fetch' + uri_suffix;
            var country_id = $('#country_id option:selected').val();
            $.getJSON(link, { postalcode: map[0], country_id: country_id }, function (data) {
                var postalcode_id_field = $('#postalcode_id');
                var postalcode_text_field = $('#postalcode_text');
                var city_text_field = $('#city_text');
                postalcode_id_field.val(data.id);
                city_text_field.val(data.city);
                postalcode_text_field.val(data.postalcode);
            });
        }
    });

    $('a#filter, a#filter_like').click(function () {
        var $this = $(this);
        var form = $this.parents('form');
        form.find('input#filter_type').val($this.attr('id'));
        form.submit();
    });
});