<?php

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$peso = $_POST['peso'];
$tipopeso = $_POST['tipopeso'];
$valorunitario = $_POST['valorunitario'];
$paletizacao = $_POST['paletizacao'];
$lastro = $_POST['lastro'];
$codigo = $_POST['codigo'];
$codigofabricante = $_POST['codigofabricante'];
$descricao = $_POST['descricao'];
$familia1 = $_POST['familia1'];
$familia2 = $_POST['familia2'];
$embalagem = $_POST['embalagem'];
$categoria = $_POST['categoria'];
$status = $_POST['status'];

require_once '../conexao_banco.php';

//verificar se status produto é fixo 
$cmdStatusP = "SELECT status
        FROM Produto
        WHERE id = '$id'";
$resultSP = mysqli_query($link, $cmdStatusP);
$dadosSP = mysqli_fetch_array($resultSP);

$statusAux = $dadosSP["status"];
if ($statusAux == "2") {
    $status = "2";
}

//alterar status de Embalagem, Categoria e Tipo peso e familias para Fixos 
//consulta
$cmdStatusGeral = "SELECT Embalagem_id, Categoria_id, TipoPeso_id, Familia1_id, Familia2_id
        FROM Produto
        WHERE id = '$id'";
$resultStatusGeral = mysqli_query($link, $cmdStatusGeral);
$dadosStatusGeral = mysqli_fetch_array($resultStatusGeral);

$categoriaStatusAux = $dadosStatusGeral['Categoria_id'];
$embalagemStatusAux = $dadosStatusGeral['Embalagem_id'];
$tipoPesoStatusAux = $dadosStatusGeral['TipoPeso_id'];
$familia1StatusAux = $dadosStatusGeral['Familia1_id'];
$familia2StatusAux = $dadosStatusGeral['Familia2_id'];

//Alterações

//Embalagem
if ($embalagemStatusAux != '0') {
    $cmdStatusEmbalagem = "SELECT id
                            FROM Produto
                            WHERE Embalagem_id = '$embalagemStatusAux'";
    $resultStatusEmbalagem = mysqli_query($link, $cmdStatusEmbalagem);
    $row_cnte = mysqli_num_rows($resultStatusEmbalagem);
    //se houver apenas um sendo usado esse deixa de ser fixo
    if ($row_cnte == 1) {
        $cmdalte0 = "UPDATE Embalagem SET status = '1' WHERE id = '$embalagemStatusAux'";
        $retorno = mysqli_query($link, $cmdalte0);
    }
}
$cmdalte1 = "UPDATE Embalagem SET status = '2' WHERE id = '$embalagem'";
$retorno1 = mysqli_query($link, $cmdalte1);


//Categoria
if ($categoriaStatusAux != '0') {
    $cmdStatusCategoria = "SELECT id
                                FROM Produto
                                WHERE Categoria_id = '$categoriaStatusAux'";
    $resultStatusCategoria = mysqli_query($link, $cmdStatusCategoria);
    $row_cntc = mysqli_num_rows($resultStatusCategoria);
    if ($row_cntc == 1) {
        $cmdaltc0 = "UPDATE Categoria SET status = '1' WHERE id = '$categoriaStatusAux'";
        $retorno2 = mysqli_query($link, $cmdaltc0);
    }
}
$cmdaltc1 = "UPDATE Categoria SET status = '2' WHERE id = '$categoria'";
$retorno3 = mysqli_query($link, $cmdaltc1);


//Tipo Peso
if ($tipoPesoStatusAux != '0') {
    $cmdStatusTipoPeso = "SELECT id
                                FROM Produto
                                WHERE TipoPeso_id = '$tipoPesoStatusAux'";
    $resultStatusTipoPeso = mysqli_query($link, $cmdStatusTipoPeso);
    $row_cnttp = mysqli_num_rows($resultStatusTipoPeso);
    if ($row_cnttp == 1) {
        $cmdalttp0 = "UPDATE TipoPeso SET status = '1' WHERE id = '$tipoPesoStatusAux'";
        $retorno4 = mysqli_query($link, $cmdalttp0);
    }
}
$cmdalttp1 = "UPDATE TipoPeso SET status = '2' WHERE id = '$tipopeso'";
$retorno5 = mysqli_query($link, $cmdalttp1);


//Familia 1
if ($familia1StatusAux != '0') {
    $cmdStatusFamilia1 = "SELECT id
                                FROM Produto
                                WHERE Familia1_id = '$familia1StatusAux'";
    $resultStatusFamilia1 = mysqli_query($link, $cmdStatusFamilia1);
    $row_cntf1 = mysqli_num_rows($resultStatusFamilia1);
    if ($row_cntf1 == 1) {
        $cmdaltf10 = "UPDATE Familia1 SET status = '1' WHERE id = '$familia1StatusAux'";
        $retorno6 = mysqli_query($link, $cmdaltf10);
    }
}
$cmdaltf11 = "UPDATE Familia1 SET status = '2' WHERE id = '$familia1'";
$retorno7 = mysqli_query($link, $cmdaltf11);


//Familia 2
if ($familia2StatusAux != '0') {
    $cmdStatusFamilia2 = "SELECT id
                                FROM Produto
                                WHERE Familia2_id = '$familia2StatusAux'";
    $resultStatusFamilia2 = mysqli_query($link, $cmdStatusFamilia2);
    $row_cntf2 = mysqli_num_rows($resultStatusFamilia2);
    if ($row_cntf2 == 1) {
        $cmdaltf20 = "UPDATE Familia2 SET status = '1' WHERE id = '$familia2StatusAux'";
        $retorno8 = mysqli_query($link, $cmdaltf20);
    }
}
$cmdaltf21 = "UPDATE Familia2 SET status = '2' WHERE id = '$familia2'";
$retorno9 = mysqli_query($link, $cmdaltf21);


//alteração de produto
$cmdalt = "UPDATE Produto SET   titulo = '$titulo', 
                                peso = '$peso', 
                                TipoPeso_id = '$tipopeso', 
                                valorunitario = '$valorunitario',
                                paletizacao = '$paletizacao', 
                                lastro = '$lastro', 
                                codigo = '$codigo', 
                                codigofabricante = '$codigofabricante',
                                descricao = '$descricao', 
                                status = '$status', 
                                Embalagem_id = '$embalagem',
                                Familia1_id = '$familia1',
                                Familia2_id = '$familia2', 
                                Categoria_id = '$categoria'
                                 WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

if (isset($retorno)) {
    echo 1;
} else {
    echo $cmdalt;
}
