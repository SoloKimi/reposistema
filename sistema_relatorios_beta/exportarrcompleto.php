<?php

require_once './conexao_banco.php';

$data = date('Ymdhis');

$idrp = $_POST['idrp'];

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

        $selectReferenciaP = "SELECT p.titulo as produto, p.peso as peso, tp.titulo as tipopeso, c.titulo as categoria, p.id as id
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
        } else if ($selectcompar == 'revest') {

            $referenciaaux = $referencia->refestado;

            $selectReferencia = "SELECT e.titulo as estado, r.id as id, r.nomefantasia as nomefantasia, r.adesao as adesao, r.base as base, r.cnpj as cnpj, r.cidade as cidade
                                    FROM Revenda r
                                    LEFT JOIN Estado e ON r.Estado_id = e.id
                                    WHERE r.Estado_id = $referenciaaux";
            $resultreferencia = mysqli_query($link, $selectReferencia);
            $row_referencia = mysqli_num_rows($resultreferencia);
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

$referenciaArray = array();
while ($dadosReferencia = mysqli_fetch_array($resultreferencia)) {
    $referenciaArray[] = $dadosReferencia;
}

$cmdR = "SELECT rr.jsonrespostas as jsonrespostas, col.titulo as colaborador, r.nomefantasia as revenda
        FROM RelatorioRespostas rr
        LEFT JOIN Colaborador col ON rr.Colaborador_id = col.id
        LEFT JOIN Revenda r ON col.Revenda_id = r.id
        WHERE rr.RelatorioPerguntas_id = '$idrp'";
$resultR = mysqli_query($link, $cmdR);

// CSV file name => importar.csv 
$filename = 'export/relatorio_' . $data . '.csv';
$namefilereturn = 'relatorio_' . $data . '.csv';

// File pointer in writable mode 
$file_pointer = fopen($filename, 'w');

// Adicione isso antes de escrever no arquivo
fwrite($file_pointer, "\xEF\xBB\xBF");

$head = array();

$head[] = 'Colaborador/Revenda';
if ($tiporefaux == 'produto') {
    $head[] = 'Produto';
    $head[] = 'Peso';
    $head[] = 'Categoria';
} else {
    $head[] = 'Revenda referência';
    $head[] = 'Base';
    $head[] = 'Cidade';
}
$jsonBancoP = json_decode($dados['jsonperguntas'], true);
$harray = 2;
$ligardata = 0;
foreach ($jsonBancoP as $pergunta) {
    $harray++;
    $head[] = $pergunta['questaopergunta'];
    $tipopergunta = $pergunta['tipopergunta'];
    if ($tipopergunta == 'data') {
        $ligardata = 1;
    }
}


$body = array();
$bodyaux = array();
$barray = 0;
$criararraybody = '';
if ($tiporefaux == 'produto') {
    while ($dadosR = mysqli_fetch_array($resultR)) {
        $jsonBancoR = json_decode($dadosR['jsonrespostas']);
        foreach ($referenciaArray as $dadosReferencia) {

            $idProd = $dadosReferencia['id'];

            $body = $dadosR['colaborador'] . '/' . $dadosR['revenda'] . '**' . $dadosReferencia['produto'] . '**' . $dadosReferencia['peso'] . ' - ' . $dadosReferencia['tipopeso'] . '**' . $dadosReferencia['categoria'];
            if ($jsonBancoR != null) {
                foreach ($jsonBancoR as $resposta) {
                    $respostapergunta = $resposta->respostapergunta;
                    $tiporesposta = $resposta->tiporesposta;
                    $ordemresposta  = $resposta->ordem;
                    $ordemrespostaaux = explode("-", $ordemresposta);
                    if ($ordemrespostaaux[0] == $idProd) {
                        if ($ligardata == 1 && $tiporesposta == 'data') {
                            $dataraux = explode("-", $respostapergunta);
                            $respostapergunta = $dataraux[2] . '/' . $dataraux[1] . '/' . $dataraux[0];
                        }
                        $body .= '**' . $respostapergunta;
                    }
                }
            } else {
                foreach ($jsonBancoP as $pergunta) {
                    $body .= '**' . 'sem resposta';
                }
            }
            $barray++;
            $bodyarray = explode("**", $body);
            $bodyaux[] = $bodyarray;
        }
    }
} else {
    while ($dadosR = mysqli_fetch_array($resultR)) {
        $jsonBancoR = json_decode($dadosR['jsonrespostas']);
        foreach ($referenciaArray as $dadosReferencia) {

            $idRev = $dadosReferencia['id'];

            $body = $dadosR['colaborador'] . '/' . $dadosR['revenda'] . '**' . $dadosReferencia['nomefantasia'] . '**' . $dadosReferencia['base'] . '**' . $dadosReferencia['cidade'];

            if ($jsonBancoR != null) {
                foreach ($jsonBancoR as $resposta) {
                    $respostapergunta = $resposta->respostapergunta;
                    $tiporesposta = $resposta->tiporesposta;
                    $ordemresposta  = $resposta->ordem;
                    $ordemrespostaaux = explode("-", $ordemresposta);
                    if ($ordemrespostaaux[0] == $idRev) {
                        if ($ligardata == 1 && $tiporesposta == 'data') {
                            $dataraux = explode("-", $respostapergunta);
                            $respostapergunta = $dataraux[2] . '/' . $dataraux[1] . '/' . $dataraux[0];
                        }
                        $body .= '**' . $respostapergunta;
                    }
                }
            } else {
                foreach ($jsonBancoP as $pergunta) {
                    $body .= '**' . 'sem resposta';
                }
            }
            $barray++;
            $bodyarray = explode("**", $body);
            $bodyaux[] = $bodyarray;
        }
    }
}
$criararraybody .= "**";
$bodyarray = explode("**", $criararraybody);

if ($file_pointer && $result) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($file_pointer, array_values($head));

    for ($i = 0; $i < $barray; $i++) {
        fputcsv($file_pointer, $bodyaux[$i]);
    }

    // Close the file pointer. 
    fclose($file_pointer);
}

echo $namefilereturn;
// print_r($criararraybody);