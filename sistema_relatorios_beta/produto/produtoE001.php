<?php

require_once '../conexao_banco.php';

$id = $_POST['id'];

//definir status de Embalagem, Categoria e Tipo peso como Ativos

//consulta
$cmdStatusAlt = "SELECT Embalagem_id, Categoria_id, TipoPeso_id, Familia1_id, Familia2_id
        FROM Produto
        WHERE id = '$id'";
$resultStatusAlt = mysqli_query($link, $cmdStatusAlt);
$dadosStatusAlt = mysqli_fetch_array($resultStatusAlt);

$categoriaStatusAux = $dadosStatusAlt['Categoria_id'];
$embalagemStatusAux = $dadosStatusAlt['Embalagem_id'];
$tipoPesoStatusAux = $dadosStatusAlt['TipoPeso_id'];
$familia1StatusAux = $dadosStatusAlt['Familia1_id'];
$familia2StatusAux = $dadosStatusAlt['Familia2_id'];

//Embalagem
$cmdStatusEmbalagem = "SELECT id FROM Produto WHERE Embalagem_id = '$embalagemStatusAux'";
    $resultStatusEmbalagem = mysqli_query($link, $cmdStatusEmbalagem);
    $row_cnte = mysqli_num_rows($resultStatusEmbalagem);
    //se houver apenas um sendo usado esse deixa de ser fixo
    if($row_cnte == 1){
        $cmdalt1 = "UPDATE Embalagem SET status = '1' WHERE id = '$embalagemStatusAux'";
        $retorno1 = mysqli_query($link, $cmdalt1);
    }

//Categoria
$cmdStatusCategoria = "SELECT id FROM Produto WHERE Categoria_id = '$categoriaStatusAux'";
        $resultStatusCategoria = mysqli_query($link, $cmdStatusCategoria);
        $row_cntc = mysqli_num_rows($resultStatusCategoria);
        if($row_cntc == 1){
            $cmdalt2 = "UPDATE Categoria SET status = '1' WHERE id = '$categoriaStatusAux'";
            $retorno2 = mysqli_query($link, $cmdalt2);
        }

//Tipo Peso
$cmdStatusTipoPeso = "SELECT id FROM Produto WHERE TipoPeso_id = '$tipoPesoStatusAux'";
        $resultStatusTipoPeso = mysqli_query($link, $cmdStatusTipoPeso);
        $row_cnttp = mysqli_num_rows($resultStatusTipoPeso);
        if($row_cnttp == 1){
            $cmdalt3 = "UPDATE TipoPeso SET status = '1' WHERE id = '$tipoPesoStatusAux'";
            $retorno3 = mysqli_query($link, $cmdalt3);
        }

//Familia 1
$cmdStatusFamilia1 = "SELECT id
                                FROM Produto
                                WHERE Familia1_id = '$familia1StatusAux'";
        $resultStatusFamilia1 = mysqli_query($link, $cmdStatusFamilia1);
        $row_cntf1 = mysqli_num_rows($resultStatusFamilia1);
        if($row_cntf1 == 1){
            $cmdalt4 = "UPDATE Familia1 SET status = '1' WHERE id = '$familia1StatusAux'";
            $retorno4 = mysqli_query($link, $cmdalt4);
        }

//Familia 2
$cmdStatusFamilia2 = "SELECT id
                                FROM Produto
                                WHERE Familia2_id = '$familia2StatusAux'";
        $resultStatusFamilia2 = mysqli_query($link, $cmdStatusFamilia2);
        $row_cntf2 = mysqli_num_rows($resultStatusFamilia2);
        if($row_cntf2 == 1){
            $cmdalt5 = "UPDATE Familia2 SET status = '1' WHERE id = '$familia2StatusAux'";
            $retorno5 = mysqli_query($link, $cmdalt5);
        }

//exclusão do produto
$cmdex = "DELETE FROM Produto WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdex);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}

