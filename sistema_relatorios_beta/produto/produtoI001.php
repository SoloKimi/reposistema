<?php

$titulo = $_POST['titulo'];
$peso = $_POST['peso'];
$tipopeso = $_POST['tipopeso'];
$valorunitario = $_POST['valorunitario'];
$paletizacao = $_POST['paletizacao'];
$lastro = $_POST['lastro'];
$codigo = $_POST['codigo'];
$descricao = $_POST['descricao'];
$familia1 = $_POST['familia1'];
$familia2 = $_POST['familia2'];
$embalagem = $_POST['embalagem'];
$categoria = $_POST['categoria'];
$codigofabricante = $_POST['codigofabricante'];
$status = $_POST['status'];

@session_start();

$colaborador = $_SESSION['idColaborador'];

require_once '../conexao_banco.php';

//definir status de Embalagem, Categoria e Tipo peso como Fixos

//Embalagem
$cmdalt1 = "UPDATE Embalagem SET status = '2' WHERE id = '$embalagem'";
$retorno = mysqli_query($link, $cmdalt1);

//Categoria
$cmdalt2 = "UPDATE Categoria SET status = '2' WHERE id = '$categoria'";
$retorno = mysqli_query($link, $cmdalt2);

//Tipo Peso
$cmdalt3 = "UPDATE TipoPeso SET status = '2' WHERE id = '$tipopeso'";
$retorno = mysqli_query($link, $cmdalt3);

//Familia 1
$cmdalt4 = "UPDATE Familia1 SET status = '2' WHERE id = '$familia1'";
$retorno = mysqli_query($link, $cmdalt4);

//Familia 2
$cmdalt5 = "UPDATE Familia2 SET status = '2' WHERE id = '$familia2'";
$retorno = mysqli_query($link, $cmdalt5);


$cmdins = "INSERT INTO Produto(titulo, peso, TipoPeso_id, valorunitario, paletizacao, lastro, codigo, codigofabricante, descricao, status, Familia1_id, Familia2_id, Embalagem_id, Categoria_id, Colaborador_id) 
                        VALUES ('$titulo', '$peso', '$tipopeso', '$valorunitario', '$paletizacao', '$lastro', '$codigo', '$codigofabricante', '$descricao', '$status', '$familia1', '$familia2', '$embalagem', '$categoria', '$colaborador')";
$retorno = mysqli_query($link, $cmdins);
$id = mysqli_insert_id($link);


if (isset($id)) {
    echo 1;
} else {
    echo 0;
}
