<?php
/**
 * @created 01.10.12 - 10:56
 * @author stefanriedel
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo $title ?></title>
    <?php echo $theme->asset->css(array('bootstrap-wysihtml5.css', 'bootstrap.min.css', 'main.css')) ?>
    <?php echo $theme->asset->js(array('wysihtml5-0.3.0.js', 'http://code.jquery.com/jquery-latest.js', 'bootstrap.js', 'bootstrap-wysihtml5.js', 'main.js')) ?>
</head>