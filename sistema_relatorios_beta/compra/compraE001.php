<?php

require_once '../conexao_banco.php';

$id = $_POST['id'];

//alterar status de Produto e Revenda para Ativo
$cmdStatusGeral = "SELECT Produto_id, Revenda_id FROM Compra WHERE id = '$id'";
$resultStatusGeral = mysqli_query($link, $cmdStatusGeral);
$dadosStatusGeral = mysqli_fetch_array($resultStatusGeral);

$produtoStatusAux = $dadosStatusGeral['Produto_id'];
$revendaStatusAux = $dadosStatusGeral['Revenda_id'];


//verificar e alterar status de produto para ativo
$cmdStatusProduto = "SELECT id FROM Compra WHERE Produto_id = '$produtoStatusAux'";
$resultStatusProduto = mysqli_query($link, $cmdStatusProduto);
$row_cntp = mysqli_num_rows($resultStatusProduto);
//se houver apenas um sendo usado esse deixa de ser fixo
if($row_cntp == 1){
    $cmdalte0 = "UPDATE Produto SET status = '1' WHERE id = '$produtoStatusAux'";
    $retorno = mysqli_query($link, $cmdalte0);
}


//verificar e alterar status de revenda para ativo
$cmdStatusRevenda = "SELECT id FROM Compra WHERE Revenda_id = '$revendaStatusAux'";
$resultStatusRevenda = mysqli_query($link, $cmdStatusRevenda);
$row_cntp = mysqli_num_rows($resultStatusRevenda);
//se houver apenas um sendo usado esse deixa de ser fixo
if($row_cntp == 1){
    $cmdalte0 = "UPDATE Revenda SET status = '1' WHERE id = '$revendaStatusAux'";
    $retorno = mysqli_query($link, $cmdalte0);
}


$cmdex = "DELETE FROM Compra WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdex);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}

