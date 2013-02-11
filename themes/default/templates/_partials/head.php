<?php
/**
 * @created 01.10.12 - 10:56
 * @author stefanriedel
 */?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title><?php echo $title ?></title>
<?php echo $theme->asset->css(array('bootstrap.min.css', 'main.css')) ?>
<?php echo $theme->asset->js(array('http://code.jquery.com/jquery-latest.js', 'bootstrap.js')) ?>
<script type="text/javascript">
    $(function () {
        $('.topbar').dropdown();
    });
</script>
<?php echo \Security::js_fetch_token() ?>
<?php echo \Security::js_set_token() ?>
</head>