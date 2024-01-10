<?php

//PARA O DESENVOLVEDOR:
// aqui entramos na criação de json do site, duvidas sobre a estrutura do json? 
// há um arquivo na pasta jsondescri dentro no fvp para compreensão da estrutura
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$tipopergunta = $_POST['tipopergunta'];
$zero = $_POST['zero'];
$ordem = $_POST['ordem'];
$status = '0';

require_once '../conexao_banco.php';

$criarjsonaux = 'não entrou nd';

$cmd0 = "SELECT jsonperguntas
        FROM RelatorioPerguntas
        WHERE id = '$id'";
$result0 = mysqli_query($link, $cmd0);
$dados0 = mysqli_fetch_array($result0);

// $aux = json_decode($dados0['jsonperguntas']);
$jsonBanco = json_decode($dados0['jsonperguntas']);
foreach ($jsonBanco as $pergunta) {
    $ordemaux = $pergunta->ordem;
    if($ordemaux == $ordem){
        $pergunta->questaopergunta = $titulo;
        $pergunta->tipopergunta = $tipopergunta;
        $pergunta->zero = $zero;
    }
    
}

$criarjson = json_encode($jsonBanco, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


$cmdalt = "UPDATE RelatorioPerguntas SET jsonperguntas = '$criarjson' WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

echo $retorno;