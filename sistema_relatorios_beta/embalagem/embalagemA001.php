<?php

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$tipo = $_POST['tipo'];
$status = $_POST['status'];

require_once '../conexao_banco.php';

$cmd0 = "SELECT status
        FROM Embalagem
        WHERE id = '$id'";
$result0 = mysqli_query($link, $cmd0);
$dados0 = mysqli_fetch_array($result0);

$statusAux = $dados0["status"];
if ($statusAux == "2") {
    $status = "2";
}

$cmdalt = "UPDATE Embalagem SET titulo = '$titulo', status = '$status', tipo = '$tipo' WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}
