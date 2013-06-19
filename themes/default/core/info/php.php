<?php
/**
 * @created 23.04.13 - 21:29
 * @author stefanriedel
 */
ob_start();
phpinfo();
$pinfo = ob_get_contents();
ob_end_clean();

$pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
echo $pinfo;