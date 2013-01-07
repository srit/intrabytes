<?php
/**
 * @created 07.01.13 - 20:53
 * @author stefanriedel
 */
Autoloader::add_core_namespace('Auth');
Autoloader::add_classes(array(
    'Infoportal\\Oracle_Connection' => __DIR__ . '/classes/oracle/connection.php',
    'Infoportal\\Oracle_ConnectionException' => __DIR__ . '/classes/oracle/connection.php',
));

$data = \Infoportal\Oracle_Connection::forge()->fetch('SELECT AUGKUN_ABT_NR, AUGKUN_TELEFON, AUGKUN_ABT_NAME1, AUGKUN_ABT_NAME2, AUGKUN_ABT_MEISTER1, AUGKUN_ABT_MEISTER2, AUGKUN_ABT_ANSPRECHPARTNER, AUGKUN_ABT_NAME_AUSWAHL,
AUGKUN_ABT_VORG, AUGKUN_ABT_TELEFON1, AUGKUN_ABT_TELEFON2, AUGKUN_ABT_MOBIL1, AUGKUN_ABT_MOBIL2, AUGKUN_ABT_ZENTRALE, AUGKUN_NAME1, AUGKUN_NAME2, AUGKUN_NAME3, AUGKUN_STRASSE, AUGKUN_PLZ, AUGKUN_ORT, AUGKUN_BTR
FROM AUGKUN_ABT INNER JOIN AUGKUN ON AUGKUN_NR=AUGKUN_ABT_KNR WHERE AUGKUN_BTR=1');

var_dump($data);