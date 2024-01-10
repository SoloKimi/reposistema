<?php

$id = $_POST['id'];
$nomefantasia = $_POST['nomefantasia'];
$cnpj = $_POST['cnpj'];
$razaosocial = $_POST['razaosocial'];
$base = $_POST['base'];
$status = $_POST['status'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$baseteste = $_POST['baseteste'];
$adesao = $_POST['adesao'];
$inscricaoestadual = $_POST['inscricaoestadual'];
$responsavel = $_POST['responsavel'];

require_once '../conexao_banco.php';

$cmd0 = "SELECT status
        FROM Revenda
        WHERE id = '$id'";
$result0 = mysqli_query($link, $cmd0);
$dados0 = mysqli_fetch_array($result0);

$statusAux = $dados0["status"];
if ($statusAux == "2") {
    $status = "2";
}

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
$cmdalte1 = "UPDATE Colaborador SET status = '2' WHERE id = '$responsavel'";
$retorno1 = mysqli_query($link, $cmdalte1);



//alteração Revenda
$cmdalt = "UPDATE Revenda SET   nomefantasia = '$nomefantasia', 
                                cnpj = '$cnpj', 
                                razaosocial = '$razaosocial', 
                                base = '$base', 
                                baseteste = '$baseteste',
                                adesao = '$adesao',
                                inscricaoestadual = '$inscricaoestadual',
                                status = '$status', 
                                cidade = '$cidade', 
                                Estado_id = '$estado',
                                Colaborador_id = '$responsavel'
                                 WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}
