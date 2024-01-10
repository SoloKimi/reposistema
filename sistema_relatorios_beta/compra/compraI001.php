<?php

$descricao = $_POST['descricao'];
$status = $_POST['status'];
$notafiscal = $_POST['notafiscal'];
$datacompra = $_POST['datacompra'];
$datavencimento = $_POST['datavencimento'];
$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];
$tabela = $_POST['tabela'];
$revenda = $_POST['revenda'];


//$data = date_format($dataaux, 'YYYY-mm-dd');

@session_start();

$colaborador = $_SESSION['idColaborador'];

require_once '../conexao_banco.php';

//alterar status da revenda para fixo
$cmd0 = "UPDATE Revenda SET status = '2' WHERE id = '$revenda'";
$result0 = mysqli_query($link, $cmd0);

//alterar status do produto para fixo
$cmd1 = "UPDATE Produto SET status = '2' WHERE id = '$produto'";
$result1 = mysqli_query($link, $cmd1);


$cmdins = "INSERT INTO Compra(descricao, notafiscal, datacompra, datavencimento, status, quantidade, tabela, Produto_id, Colaborador_id, Revenda_id) 
                VALUES ('$descricao', '$notafiscal', '$datacompra', '$datavencimento', '$status', '$quantidade', '$tabela', '$produto', '$colaborador', '$revenda')";
$retorno = mysqli_query($link, $cmdins);
$id = mysqli_insert_id($link);


if (isset($id)) {
    echo 1;
} else {
    echo 0;
}
