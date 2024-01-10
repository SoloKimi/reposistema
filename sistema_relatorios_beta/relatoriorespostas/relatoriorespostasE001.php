<?php

require_once '../conexao_banco.php';

$id = $_POST['id'];


//exclusão
$cmdalt = "UPDATE RelatorioRespostas SET jsonrespostas = null, data = null, status = '0'
            WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}

