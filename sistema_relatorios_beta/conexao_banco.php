<?php

$dbhost = 'localhost';
$dbuser = '';
$dbpass = '';

$link = mysqli_connect($dbhost, $dbuser, $dbpass);
$link->set_charset("utf8");
if (!$link) {
    die('Não foi possível conectar');
}

$dbname = '';

mysqli_select_db($link, $dbname);

//mysqli_query($link, "SET NAMES 'iso-8859-1'");
//mysqli_query($link, 'SET character_set_connection=iso-8859-1');
//mysqli_query($link, 'SET character_set_client=iso-8859-1');
//mysqli_query($link, 'SET character_set_results=iso-8859-1');
?>
