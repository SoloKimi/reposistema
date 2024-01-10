<?php

require_once '../conexao_banco.php';

$id = $_POST['id'];

$cmdex = "DELETE FROM Embalagem WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdex);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}

