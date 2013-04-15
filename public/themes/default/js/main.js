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
            $('.nav-tabs a[href="' + window.location.hash + '"]').tab('show');
        } else {
            $('.nav-tabs a:first').tab('show')
        }
    })

    $('.nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

});
