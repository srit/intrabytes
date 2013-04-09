uri_prefix = '';
uri_suffix = '.html5';
$(document).ready(function () {

    $(function () {
        $('.topbar').dropdown();
    });

    $(this).ajaxStart(function()
    {
        $('.indicator').show();
    });


    $(this).ajaxStop(function()
    {
        $('.indicator').hide();
    });

    $('[data-spy="affix"]').affix();

    $('input[type="checkbox"][name="chckall"]').change(function() {
        var $this_chckall = $(this);
        $this_chckall.parents('div').find('input[type="checkbox"][name^="checked"]').each(function(){
            $(this).attr('checked', $this_chckall.is(':checked'));
        });
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

});
