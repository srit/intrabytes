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

});
