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
    <title><?php echo \Fuel\Core\Config::get('project.name') . ' --- ' . $title ?></title>
    <?php echo $theme->asset->css(array('bootstrap.min.css', 'main.css')) ?>
    <?php echo $theme->asset->js(array(
        'http://code.jquery.com/jquery-latest.js',
        'bootstrap.min.js',
        'main.js')) ?>
</head>
