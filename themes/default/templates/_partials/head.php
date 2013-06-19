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
    <title><?php echo \Config::get('project.name') . ' --- ' . $title ?></title>
    <?php echo $theme->asset->css(array('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css', 'bootstrap.min.css', 'main.css')) ?>
    <?php echo $theme->asset->js(array(
        'jquery-2.0.0.min.js',
        'http://code.jquery.com/ui/1.10.3/jquery-ui.js',
        'bootstrap.min.js',
        'main.js')) ?>
    <?php echo $theme->asset->js($additional_js) ?>
</head>
