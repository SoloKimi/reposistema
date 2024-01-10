<?php

//PARA O DESENVOLVEDOR:
// aqui entramos na criação de json do site, duvidas sobre a estrutura do json? 
// há um arquivo na pasta jsondescri dentro no fvp para compreensão da estrutura
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$tipopergunta = $_POST['tipopergunta'];
$zero = $_POST['zero'];
$status = '0';

require_once '../conexao_banco.php';

$criarjsonaux = 'não entrou nd';

$cmd0 = "SELECT jsonperguntas
        FROM RelatorioPerguntas
        WHERE id = '$id' ORDER BY id DESC";
$result0 = mysqli_query($link, $cmd0);
$dados0 = mysqli_fetch_array($result0);

// $aux = json_decode($dados0['jsonperguntas']);
$aux = $dados0['jsonperguntas'];

if ($aux == null || $aux == '') {
    $criarjsonaux = array(array('ordem' => '0', 'tipopergunta' => $tipopergunta, 'questaopergunta' => $titulo, 'status' => $status, 'zero' => $zero));
    $criarjson = json_encode($criarjsonaux, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
} else {
    $jsonatual = json_decode($dados0['jsonperguntas']);
    $ultimapergunta = end($jsonatual);
    $ordemaux = $ultimapergunta->ordem;

    $ordemaux++;
    $criarjsonaux1 = array('ordem' => $ordemaux, 'tipopergunta' => $tipopergunta, 'questaopergunta' => $titulo, 'status' => $status, 'zero' => $zero);
    $criarjsonaux = array_push($jsonatual, $criarjsonaux1);
    $criarjson = json_encode($jsonatual, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

$cmdalt = "UPDATE RelatorioPerguntas SET jsonperguntas = '$criarjson' WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

if (isset($retorno)) {
    echo 1;
} else {
    echo 0;
}
