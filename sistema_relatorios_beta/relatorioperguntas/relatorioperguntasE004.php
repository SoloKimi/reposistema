<?php

require_once '../conexao_banco.php';

$id = $_POST['id'];

$cmdalt = "UPDATE RelatorioPerguntas SET jsonreferencia = null, jsontiporeferencia = null WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

echo $retorno;
