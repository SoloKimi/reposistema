<?php

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$tipo = $_POST['tipo'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$revenda = $_POST['revenda'];
$status = $_POST['status'];

require_once '../conexao_banco.php';

//verificar status do colaborador
$cmd0 = "SELECT status
        FROM Colaborador
        WHERE id = '$id'";
$result0 = mysqli_query($link, $cmd0);
$dados0 = mysqli_fetch_array($result0);

$statusAux = $dados0["status"];
if ($statusAux == "2") {
    $status = "2";
}

//alterar status de Revenda
//consulta
$cmd0 = "SELECT Revenda_id FROM Colaborador WHERE id = '$id'";
$result0 = mysqli_query($link, $cmd0);
$dados0 = mysqli_fetch_array($result0);

$revendaStatusAux = $dados0['Revenda_id'];

//Alterações

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
$cmdalte1 = "UPDATE Revenda SET status = '2' WHERE id = '$revenda'";
$retorno1 = mysqli_query($link, $cmdalte1);


//alteração
$cmdalt = "UPDATE Colaborador SET   titulo = '$titulo', 
                                    cpf = '$cpf', 
                                    tipo = '$tipo', 
                                    usuario = '$usuario', 
                                    senha = '$senha', 
                                    email = '$email',
                                    telefone = '$telefone',
                                    status = '$status', 
                                    Revenda_id = '$revenda'
                                    WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

if (isset($retorno)) {
    echo 1;
} else {
    echo $cmdalt;
}
