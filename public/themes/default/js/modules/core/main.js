/**
 * @created 05.03.13 - 10:02
 * @author stefanriedel
 */
$(document).ready(function() {
    $('#group[data-provide="typeahead"]').typeahead({
        source:function (query, process) {
            var link = $(this)[0].$element[0].dataset.link;
            var what = $(this)[0].$element[0].name;
            var language_id = $('#language_id').val();
            console.log(language_id);
            return $.getJSON(link, { query:query, what: what, language_id: language_id }, function (data) {
                return process(data.options);
            });
        }
    });
});