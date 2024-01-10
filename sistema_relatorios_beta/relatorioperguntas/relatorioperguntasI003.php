<?php

$colaboradores = $_POST['colaux'];
$relatorioperguntas = $_POST['id'];

require_once '../conexao_banco.php';

if ($colaboradores == '0') {

    $cmd = "SELECT * FROM Colaborador WHERE id != '1'";
    $result = mysqli_query($link, $cmd);
    while ($dados = mysqli_fetch_array($result)) {
        $idCol = $dados['id'];
        $cmdins = "INSERT INTO RelatorioRespostas(RelatorioPerguntas_id, Colaborador_id) VALUES ('$relatorioperguntas','$idCol')";
        $retorno = mysqli_query($link, $cmdins);
        $idRelatorioRespostas = mysqli_insert_id($link);
    }
} else {
    for ($i = 0; $i < sizeof($colaboradores); $i++) {
        $auxcol = $colaboradores[$i];
        $cmdins = "INSERT INTO RelatorioRespostas(RelatorioPerguntas_id, Colaborador_id) VALUES ('$relatorioperguntas','$auxcol')";
        $retorno = mysqli_query($link, $cmdins);
        $idRelatorioRespostas = mysqli_insert_id($link);
    }
}


if (isset($idRelatorioPerguntas)) {
    echo $idRelatorioPerguntas;
} else {
    echo 0;
}
