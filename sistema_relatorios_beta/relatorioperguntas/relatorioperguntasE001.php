<?php

require_once '../conexao_banco.php';

$id = $_POST['id'];

$cmdex = "DELETE FROM RelatorioRespostas WHERE RelatorioPerguntas_id = '$id'";
$retorno = mysqli_query($link, $cmdex);

$cmdex = "DELETE FROM RelatorioPerguntas WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdex);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}

?>