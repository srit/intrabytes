(function($) {
    var s = {
        extends: {},
        source:function (query, process) {
            var link = $(this)[0].$element[0].dataset.link;
            var what = $(this)[0].$element[0].name;
            var data = {
                query:query,
                what:what
            };
            data = $.extend(data, $(this)[0].options.extends);
            return $.getJSON(link, data, function (data) {
                return process(data.options);
            });
        }
    };
    $.extend(true, $.fn.typeahead.defaults, s);
})(jQuery);
$(document).ready(function () {
    $('[data-provide="typeahead"]').typeahead();
    $('#indicator').modal().show();
});
