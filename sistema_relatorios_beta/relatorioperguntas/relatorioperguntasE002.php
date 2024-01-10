<?php

require_once '../conexao_banco.php';

$id = $_POST['id'];
$ordem = $_POST['ordem'];

$cmd0 = "SELECT jsonperguntas
        FROM RelatorioPerguntas
        WHERE id = '$id'";
$result0 = mysqli_query($link, $cmd0);
$dados0 = mysqli_fetch_array($result0);

$jsonBanco = json_decode($dados0['jsonperguntas']);
foreach ($jsonBanco as $pergunta) {
    $ordemaux = $pergunta->ordem;
    if ($ordemaux == $ordem) {
        unset($jsonBanco[strval($ordem)]);
        $jsonBanco = array_values($jsonBanco);
    } elseif ($ordemaux > $ordem) {

        $ordemaux--;
        $pergunta->ordem = $ordemaux;
    }
}
print_r($jsonBanco);
$criarjson = json_encode($jsonBanco);


$cmdalt = "UPDATE RelatorioPerguntas SET jsonperguntas = '$criarjson' WHERE id = '$id'";
$retorno = mysqli_query($link, $cmdalt);

echo $retorno;
