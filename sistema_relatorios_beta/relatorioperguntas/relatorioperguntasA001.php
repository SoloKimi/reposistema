<?php

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$status = $_POST['status'];
$datalimite = $_POST['datalimite'];

require_once '../conexao_banco.php';

$cmd0 = "SELECT status
        FROM RelatorioPerguntas
        WHERE id = '$id'";
$result0 = mysqli_query($link, $cmd0);
$dados0 = mysqli_fetch_array($result0);

$statusAux = $dados0["status"];
if ($statusAux == "2") {
    $status = "2";
}

$cmdalt = "UPDATE RelatorioPerguntas SET titulo = '$titulo', status = '$status', datalimite = '$datalimite'
            WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}
