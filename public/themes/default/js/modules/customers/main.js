/**
 * @created 05.03.13 - 09:29
 * @author stefanriedel
 */
$(document).ready(function () {
    $('#customer_postalcode_text[data-provide="typeahead"]').typeahead({
        source:function (query, process) {
            var link = $(this)[0].$element[0].dataset.link;
            var country_id = $('#customer_country_id option:selected').val();
            var what = $(this)[0].$element[0].name;
            return $.getJSON(link, { query:query, country_id:country_id, what:what }, function (data) {
                return process(data.options);
            });
        },
        updater:function (item, process) {
            var map = item.split(" - ");
            var link = '/customers/postalcodes/rest/fetch' + uri_suffix;
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

    $('#redmine_project_label[data-provide="typeahead"]').typeahead({
        source:function (query, process) {
            var link = $(this)[0].$element[0].dataset.link;
            var redmine_id = $('#redmine_id option:selected').val();
            var what = $(this)[0].$element[0].name;
            return $.getJSON(link, { query:query, redmine_id:redmine_id, what:what }, function (data) {
                return process(data.options);
            });
        }
    });

    $(function () {

        if (window.location.hash) {
            $('#tab a[href="' + window.location.hash + '"]').tab('show');
        } else {
            $('#tab a:first').tab('show')
        }
    })

    $('#tab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#description').wysihtml5({
        "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": true, //Button which allows you to edit the generated HTML. Default false
        "link": true, //Button to insert a link. Default true
        "image": false, //Button to insert an image. Default true,
        "color": false //Button to change color of font
    });

});
