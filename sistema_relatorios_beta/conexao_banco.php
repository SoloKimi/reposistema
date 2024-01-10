<?php

$dbhost = 'localhost';
$dbuser = 'u620795951_FVP_ADM';
$dbpass = '@FVP9685#distribuidora2023';

$link = mysqli_connect($dbhost, $dbuser, $dbpass);
$link->set_charset("utf8");
if (!$link) {
    die('Não foi possível conectar');
}

$dbname = 'u620795951_SistemaFVP';

mysqli_select_db($link, $dbname);

//mysqli_query($link, "SET NAMES 'iso-8859-1'");
//mysqli_query($link, 'SET character_set_connection=iso-8859-1');
//mysqli_query($link, 'SET character_set_client=iso-8859-1');
//mysqli_query($link, 'SET character_set_results=iso-8859-1');
?>