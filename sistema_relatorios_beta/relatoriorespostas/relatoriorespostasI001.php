<?php

$idrr = $_POST['idrr'];
$respostasaux = $_POST['respostasaux'];
$diaatual =  date('Y-m-d');

require_once '../conexao_banco.php';


//seleciona o id (Relatorio Perguntas) que corresponde ao colaborador ativo e ao relatorio de perguntas referenciado
$cmdrr = "SELECT RelatorioPerguntas_id as idrp
        FROM RelatorioRespostas
        WHERE id = '$idrr'";
$resultrr = mysqli_query($link, $cmdrr);
$dadosrr = mysqli_fetch_array($resultrr);

$idrp = $dadosrr['idrp'];



$cmd = "SELECT *
        FROM RelatorioPerguntas
        WHERE id = '$idrp'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);

$jsonBanco = json_decode($dados['jsonperguntas']);
$jsonRef = json_decode($dados['jsonreferencia']);
$jsontipoRef = json_decode($dados['jsontiporeferencia']);
$referencias = array();
$whereConditions = array();
$referentea = '';
$selectcompar = 0;
$multirevendas = array();
$multiprodutos = array();
$contarRevendas = 0;

foreach ($jsontipoRef as $tiporeferencia) {

    $tiporefaux = $tiporeferencia->tipo;
    $selectcompar = $tiporeferencia->select;
}


if ($tiporefaux == 'produto') {

    if ($selectcompar == 'prodet') {
        foreach ($jsonRef as $referencia) {
            $refcat = $referencia->referenciacategoria;
            if ($refcat != '0') {
                $whereConditions[] =  "p.Categoria_id = $refcat";
            }

            $reffam1 = $referencia->referenciafamilia1;
            if ($reffam1 != '0') {
                $whereConditions[] = "p.Familia1_id = '$reffam1'";
            }

            $reffam2 = $referencia->referenciafamilia2;
            if ($reffam2 != '0') {
                $whereConditions[] = "p.Familia2_id = '$reffam2'";
            }

            $refemb = $referencia->referenciaembalagem;
            if ($refemb != '0') {
                $whereConditions[] = "p.Embalagem_id = '$refemb'";
            }
        }

        // Monta a consulta SQL para contagem de resultados
        $selectReferencia = "SELECT p.id as id, p.titulo as produto, p.peso as peso, tp.titulo as tipopeso, p.descricao as descricao, f1.titulo as familia1, f2.titulo as familia2, e.titulo as embalagem, c.titulo as categoria
                                 FROM Produto p
                                 LEFT JOIN Familia1 f1 ON p.Familia1_id = f1.id
                                 LEFT JOIN Familia2 f2 ON p.Familia2_id = f2.id
                                 LEFT JOIN Embalagem e ON p.Embalagem_id = e.id
                                 LEFT JOIN Categoria c ON p.Categoria_id = c.id
                                 LEFT JOIN TipoPeso tp ON p.TipoPeso_id = tp.id";

        // Adiciona a cláusula WHERE nas condições
        if (!empty($whereConditions)) {
            $whereClause = implode(' AND ', $whereConditions);
            $selectReferencia .= " WHERE $whereClause";
        }

        $selectReferencia .= " ORDER BY p.id";


        $resultreferencia = mysqli_query($link, $selectReferencia);
    } else if ($selectcompar == 'protodos' || $selectcompar == 'promult') {

        $selecionarProdutos = '';
        foreach ($jsonRef as $referencia) {
            $multiprodutos[] = $referencia->idproduto;
        }

        for ($i = 0; $i < count($multiprodutos); $i++) {
            if ($i >= 1) {
                $selecionarProdutos .= ',' . $multiprodutos[$i];
            } else {
                $selecionarProdutos .= $multiprodutos[$i];
            }
        }

        $selectReferenciaP = "SELECT p.id as id, p.titulo as produto, p.peso as peso, tp.titulo as tipopeso, c.titulo as categoria
                                 FROM Produto p 
                                 LEFT JOIN TipoPeso tp ON p.TipoPeso_id = tp.id
                                 LEFT JOIN Categoria c ON p.Categoria_id = c.id
                                 WHERE p.id in($selecionarProdutos)";
        $resultreferencia = mysqli_query($link, $selectReferenciaP);
        $row_referencia = mysqli_num_rows($resultreferencia);
    }
} else if ($tiporefaux == 'revenda') {

    foreach ($jsonRef as $referencia) {

        if ($selectcompar == 'revuni') {

            $referenciaaux = $referencia->refunica;

            $selectReferencia = "SELECT *
                                FROM Revenda
                                WHERE id = $referenciaaux";
            $resultreferencia = mysqli_query($link, $selectReferencia);
            $row_referencia = mysqli_num_rows($resultreferencia);

            $referenciasaux = $dadosReferencia['nomefantasia'];
        } else if ($selectcompar == 'revest') {

            $referenciaaux = $referencia->refestado;

            $referentea = 'Estado';

            $selectReferencia = "SELECT e.titulo as estado, r.id as id
                                FROM Revenda r
                                LEFT JOIN Estado e ON r.Estado_id = e.id
                                WHERE r.Estado_id = $referenciaaux";
            $resultreferencia = mysqli_query($link, $selectReferencia);
            $row_referencia = mysqli_num_rows($resultreferencia);

            $referenciasaux = $dadosReferencia['estado'];
        } else if ($selectcompar == 'revendas') {

            $multirevendas[] = $referencia->idrevenda;

            $contarRevendas++;
        }
    }

    if ($selectcompar == 'revendas') {
        $selecionarRevendas = '';

        for ($i = 0; $i < count($multirevendas); $i++) {
            if ($i >= 1) {
                $selecionarRevendas .= ',' . $multirevendas[$i];
            } else {
                $selecionarRevendas .= $multirevendas[$i];
            }
        }

        $selectReferencia = "SELECT * FROM Revenda WHERE id in($selecionarRevendas)";
        $resultreferencia = mysqli_query($link, $selectReferencia);
        $row_referencia = mysqli_num_rows($resultreferencia);
    }
}


$auxordem = array();
$auxtipo = array();
if ($tiporefaux == 'produto') {
    while ($dadosReferencia = mysqli_fetch_array($resultreferencia)) {
        $idProd = $dadosReferencia['id'];

        foreach ($jsonBanco as $pergunta) {
            $ordemaux = $pergunta->ordem;
            $questaopergunta = $pergunta->questaopergunta;
            $tipopergunta = $pergunta->tipopergunta;
            $zero = $pergunta->zero;

            $auxordem[] = $idProd . '-' . $ordemaux;
            $auxtipo[] = $tipopergunta;
        }
    }
}else{
    while ($dadosReferencia = mysqli_fetch_array($resultreferencia)) {
        $idRev = $dadosReferencia['id'];

        foreach ($jsonBanco as $pergunta) {
            $ordemaux = $pergunta->ordem;
            $questaopergunta = $pergunta->questaopergunta;
            $tipopergunta = $pergunta->tipopergunta;
            $zero = $pergunta->zero;

            $auxordem[] = $idRev . '-' . $ordemaux;
            $auxtipo[] = $tipopergunta;
        }
    }
}
print_r($respostasaux);
$criarjsonaux = array();

for ($i = 0; $i < sizeof($respostasaux); $i++) {
    $criarjsonaux[] = array('ordem' => $auxordem[$i], 'tiporesposta' => $auxtipo[$i], 'respostapergunta' => $respostasaux[$i], 'status' => '0');
}
$criarjson = json_encode($criarjsonaux, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

//inserção
$cmdalt = "UPDATE RelatorioRespostas SET jsonrespostas = '$criarjson', data = '$diaatual', status = '1' WHERE id = '$idrr'";
$retorno = mysqli_query($link, $cmdalt);

// print_r($criarjsonaux);
echo $cmdalt;
