<?php

$titulo = $_POST['titulo'];
$status = $_POST['status'];
$datalimite = $_POST['datalimite'];
$diaatual =  date('Y-m-d');

session_start();

$colaborador = $_SESSION['idColaborador'];

require_once '../conexao_banco.php';

$cmdins = "INSERT INTO RelatorioPerguntas(titulo, status, datacriacao, datalimite, Colaborador_id)
                     VALUES ('$titulo','$status', '$diaatual', '$datalimite', '$colaborador')";
$retorno = mysqli_query($link, $cmdins);
$idRelatorioPerguntas = mysqli_insert_id($link);


if (isset($idRelatorioPerguntas)) {
    echo $idRelatorioPerguntas;
} else {
    echo 0;
}
