<?php

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


//alterar status de Revenda
$cmdalte1 = "UPDATE Revenda SET status = '2' WHERE id = '$revenda'";
$retorno1 = mysqli_query($link, $cmdalte1);



//inserção principal 
$cmdins = "INSERT INTO Colaborador(titulo, cpf, tipo, usuario, senha, email, telefone, status, Revenda_id) 
                        VALUES ('$titulo', '$cpf', '$tipo', '$usuario', '$senha', '$email', '$telefone', '$status', '$revenda')";
$retorno = mysqli_query($link, $cmdins);
$id = mysqli_insert_id($link);


if (isset($id)) {
    echo 1;
} else {
    echo 0;
}
