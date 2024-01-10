<?php

$titulo = $_POST['titulo'];
$status = $_POST['status'];

require_once '../conexao_banco.php';

$cmdins = "INSERT INTO Familia1(titulo, status) VALUES ('$titulo','$status')";
$retorno = mysqli_query($link, $cmdins);
$id = mysqli_insert_id($link);


if (isset($id)) {
    echo 1;
} else {
    echo 0;
}
