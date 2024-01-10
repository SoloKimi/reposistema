<?php

@session_start();
@session_destroy();

setcookie("idCookie", '', -1);
unset($_COOKIE['idCookie']);
// setcookie("idPessoaCookie", "", time() - 3600);
// unset($_COOKIE['idPessoaCookie']);

$_SESSION['idColaborador'] = '';
$_SESSION['tipoColaborador'] = '';
?>

