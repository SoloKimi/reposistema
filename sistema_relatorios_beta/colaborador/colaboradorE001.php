<?php

require_once '../conexao_banco.php';

$id = $_POST['id'];

//alterar status de Revenda para Fixo
//consulta
$cmd0 = "SELECT Revenda_id FROM Colaborador WHERE id = '$id'";
$result0 = mysqli_query($link, $cmd0);
$dados0 = mysqli_fetch_array($result0);

$revendaStatusAux = $dados0['Revenda_id'];

//Alterações

//Revenda
if($revendaStatusAux != '0'){
        $cmdStatusRevenda = "SELECT id FROM Colaborador WHERE Revenda_id = '$revendaStatusAux'";
        $resultStatusRevenda = mysqli_query($link, $cmdStatusRevenda);
        $row_cntr = mysqli_num_rows($resultStatusRevenda);
        //se houver apenas um sendo usado esse deixa de ser fixo
        if($row_cntr == 1){
        $cmdalte0 = "UPDATE Revenda SET status = '1' WHERE id = '$revendaStatusAux'";
        $retorno = mysqli_query($link, $cmdalte0);
        }
}



$cmdex = "DELETE FROM Colaborador WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdex);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}

