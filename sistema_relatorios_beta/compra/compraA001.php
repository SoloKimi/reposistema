<?php

$id = $_POST['id'];
$descricao = $_POST['descricao'];
$status = $_POST['status'];
$notafiscal = $_POST['notafiscal'];
$datacompra = $_POST['datacompra'];
$datavencimento = $_POST['datavencimento'];
$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];
$tabela = $_POST['tabela'];
$revenda = $_POST['revenda'];

require_once '../conexao_banco.php';

//alterar status de Produto e Revenda para Fixo
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
$cmdalte1 = "UPDATE Produto SET status = '2' WHERE id = '$produto'";
$retorno = mysqli_query($link, $cmdalte1);


//verificar e alterar status de revenda para ativo
$cmdStatusRevenda = "SELECT id FROM Compra WHERE Revenda_id = '$revendaStatusAux'";
$resultStatusRevenda = mysqli_query($link, $cmdStatusRevenda);
$row_cntp = mysqli_num_rows($resultStatusRevenda);
//se houver apenas um sendo usado esse deixa de ser fixo
if($row_cntp == 1){
    $cmdalte0 = "UPDATE Revenda SET status = '1' WHERE id = '$revendaStatusAux'";
    $retorno = mysqli_query($link, $cmdalte0);
}
$cmdalte1 = "UPDATE Revenda SET status = '2' WHERE id = '$produto'";
$retorno = mysqli_query($link, $cmdalte1);


//alteração compra
$cmdalt = "UPDATE Compra SET   
                            descricao = '$descricao', 
                            notafiscal = '$notafiscal', 
                            datacompra = '$datacompra',
                            datavencimento = '$datavencimento',
                            status = '$status',
                            quantidade = '$quantidade',
                            tabela = '$tabela', 
                            Produto_id = '$produto',
                            Revenda_id = '$revenda'
                            WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}
