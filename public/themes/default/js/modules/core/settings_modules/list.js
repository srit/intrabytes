$(function () {
    var fixHelperModified = function (e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function (index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
        },
        changeSort = function(e, ui) {
            var start_pos = ui.item.data('start_pos');
        },
        startSort = function(e, ui) {
            var start_pos = ui.item.index();
            ui.item.data('start_pos', start_pos);
        }
        updateSort = function(e, ui) {

            var index = ui.placeholder.index();
            console.log($('#modules tbody tr:nth-child(' + index + ')'));
            //console.log(ui.item, ui.sender);

            $('td.sort', ui.item.parent()).each(function (i) {
                $(this).children('span.sort').html(i + 1);
                $(this).children('input[type="hidden"]').val(i + 1);
            });
            var modules = $(this).sortable( "toArray");
            sort_data = [];

            module_ids = [];
            module_sort = [];

            $.each(modules, function(i,v){
                var mod = /mod-(\d+)/.exec(v);
                var module_id = mod[1];
                var sort = $('#' + mod[0]).children('td.sort').children('input[type="hidden"]').val();

                module_ids = $.merge(module_ids, module_id);
                module_sort = $.merge(module_sort, sort);
            });

            data = {module_ids: module_ids, module_sort: module_sort};
            $.ajax({
                url: '/core/settings/modules/rest/sort',
                data: $.param(data),
                traditional: true,
                success: function(result) {
                    //alert(result.status);
                }
            });

        };
    $("#modules tbody").sortable({
        helper: fixHelperModified,
        stop: updateSort,
        change: changeSort,
        start: startSort
    }).disableSelection();
});