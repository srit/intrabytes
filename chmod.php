<?php
/**
 * @created 19.06.13 - 11:50
 * @author stefanriedel
 */

$it = new RecursiveDirectoryIterator(__DIR__, FilesystemIterator::SKIP_DOTS);
foreach(new RecursiveIteratorIterator($it) as $file) {

    /**
if($file->isDir()) {
        var_dump('1');
        exec('chmod 0755 ' . (string)$file);
    } else {
        exec('chmod 0644 ' . (string)$file);
    }
var_dump($file);
     * */

    exec("chmod 0755 {$file->getPath()}");
    exec("chmod 0644 {$file->__toString()}");
}