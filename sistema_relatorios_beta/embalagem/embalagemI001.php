<?php

$titulo = $_POST['titulo'];
$status = $_POST['status'];
$tipo = $_POST['tipo'];

require_once '../conexao_banco.php';

$cmdins = "INSERT INTO Embalagem(titulo, tipo, status) VALUES ('$titulo', '$tipo','$status')";
$retorno = mysqli_query($link, $cmdins);
$id = mysqli_insert_id($link);


if (isset($id)) {
    echo 1;
} else {
    echo 0;
}
