<?php

require_once '../conexao_banco.php';

$id = $_POST['id'];

//alterar status de Colaborador para Fixo (apenas o responsavel tem status fixo)
//consulta
$cmdStatusGeral = "SELECT Colaborador_id FROM Revenda WHERE id = '$id'";
$resultStatusGeral = mysqli_query($link, $cmdStatusGeral);
$dadosStatusGeral = mysqli_fetch_array($resultStatusGeral);

$colaboradorStatusAux = $dadosStatusGeral['Colaborador_id'];

//Alterações

//Colaborador
if($colaboradorStatusAux != '0'){
    $cmdStatusColaborador = "SELECT id FROM Revenda WHERE Colaborador_id = '$colaboradorStatusAux'";
    $resultStatusColaborador = mysqli_query($link, $cmdStatusColaborador);
    $row_cnte = mysqli_num_rows($resultStatusColaborador);
    //se houver apenas um sendo usado esse deixa de ser fixo
    if($row_cnte == 1){
    $cmdalte0 = "UPDATE Colaborador SET status = '1' WHERE id = '$colaboradorStatusAux'";
    $retorno = mysqli_query($link, $cmdalte0);
    }
}

//exclusão
$cmdex = "DELETE FROM Revenda WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdex);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}

