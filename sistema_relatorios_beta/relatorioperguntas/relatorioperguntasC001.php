<?php

$id = $_POST['id'];

require_once '../conexao_banco.php';

$cmd0 = "SELECT jsonperguntas
        FROM RelatorioPerguntas
        WHERE id = '$id'";
$result0 = mysqli_query($link, $cmd0);
$dados0 = mysqli_fetch_array($result0);

$retorno = json_decode($dados0['jsonperguntas']);

echo $retorno;