<?php

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

//definir status de Colaborador como Fixo (apenas o responsavel tem status fixo)

//Colaborador
$cmdalt1 = "UPDATE Colaborador SET status = '2' WHERE id = '$responsavel'";
$retorno = mysqli_query($link, $cmdalt1);

//inserção
$cmdins = "INSERT INTO Revenda(nomefantasia, cnpj, razaosocial, base, baseteste, adesao, inscricaoestadual, status, cidade, Estado_id, Colaborador_id) 
                        VALUES ('$nomefantasia', '$cnpj', '$razaosocial', '$base', '$baseteste', '$adesao', '$inscricaoestadual','$status', '$cidade', '$estado', '$responsavel')";
$retorno = mysqli_query($link, $cmdins);
$id = mysqli_insert_id($link);


if (isset($id)) {
    echo 1;
} else {
    echo 0;
}
