$(function () {
    var fixHelperModified = function (e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function (index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
        },
        startSort = function(e, ui) {
            $(this).attr('data-previndex', ui.item.index());
        }
        updateSort = function(e, ui) {

            var data = { sort: {} };

            $('td.sort', ui.item.parent()).each(function (i) {
                $(this).children('span.sort').html(i + 1);
                $(this).children('input[type="hidden"]').val(i + 1);
                data['sort'][/mod-(\d+)/.exec($(this).parent('tr').attr('id'))[1]] = $(this).children('input[type="hidden"]').val();
            });

            $.ajax({
                dataType: "json",
                url: '/core/settings/modules/rest/sort',
                data: $.param(data),
                traditional: true,
                success: function(result) {
                    if(result[0] == true) {
                        /**
                         *
                         */
                    }

                }
            });

        };
    $("#modules tbody").sortable({
        helper: fixHelperModified,
        stop: updateSort,
        start: startSort
    }).disableSelection();

    $('a#register_modules').click(function(){
        $.ajax({
            dataType: "json",
            url: '/core/settings/modules/rest/register_modules',
            traditional: true,
            success: function(result) {
                if(result[0] == true) {
                    location.reload();
                }

            }
        });
        return false;
    });

});