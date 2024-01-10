<?php

$id = $_POST['id'];
$tiporeferencia = $_POST['tiporeferencia'];

require_once '../conexao_banco.php';

if ($tiporeferencia == 'produto') {
    $arrayaux = $_POST['arrayaux'];
    $selectprod = $arrayaux[0];

    switch ((string)$selectprod) {
        case 'prodet':

            $arrayaux = $_POST['arrayaux'];
            $referenciacategoria = $arrayaux[1];
            $referenciafamilia1 = $arrayaux[2];
            $referenciafamilia2 = $arrayaux[3];
            $referenciaembalagem = $arrayaux[4];
        
            if ($referenciacategoria == '') {
                $referenciacategoria = '0';
            }
        
            if ($referenciafamilia1 == '') {
                $referenciafamilia1 = '0';
            }
        
            if ($referenciafamilia2 == '') {
                $referenciafamilia2 = '0';
            }
        
            if ($referenciaembalagem == '') {
                $referenciaembalagem = '0';
            }
        
        
            $criarjsonauxtipo = array(array('tipo' => $tiporeferencia, 'select' => $selectprod));
            $criarjsontipo = json_encode($criarjsonauxtipo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        
            $criarjsonauxr = array(array('referenciacategoria' => $referenciacategoria, 'referenciafamilia1' => $referenciafamilia1, 'referenciafamilia2' => $referenciafamilia2, 'referenciaembalagem' => $referenciaembalagem));
            $criarjsonr = json_encode($criarjsonauxr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        
        
            $cmdalt = "UPDATE RelatorioPerguntas SET jsonreferencia = '$criarjsonr', jsontiporeferencia = '$criarjsontipo' WHERE id = '$id'";
            $retorno = mysqli_query($link, $cmdalt);

            break;

        case 'protodos':

            $criarjsonauxtipo = array(array('tipo' => $tiporeferencia, 'select' => $selectprod));
            $criarjsontipo = json_encode($criarjsonauxtipo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $criarjsonauxr = array();

            $cmdprodr = "SELECT id FROM Produto ORDER BY id";
            $resultprodr = mysqli_query($link, $cmdprodr);
            while ($dadosprodr = mysqli_fetch_array($resultprodr)) {
                $criarjsonauxr[] = array('idproduto' => $dadosprodr['id']);
            }

            $criarjsonr = json_encode($criarjsonauxr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $cmdalt = "UPDATE RelatorioPerguntas SET jsonreferencia = '$criarjsonr', jsontiporeferencia = '$criarjsontipo' WHERE id = '$id'";
            $retorno = mysqli_query($link, $cmdalt);

            break;

        case 'promult':

            $proaux = $_POST['proaux'];

            $criarjsonauxtipo = array(array('tipo' => $tiporeferencia, 'select' => $selectprod));
            $criarjsontipo = json_encode($criarjsonauxtipo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $criarjsonauxr = array();

            for ($i = 0; $i < sizeof($proaux); $i++) {
                $criarjsonauxr[] = array('idproduto' => $proaux[$i]);
            }
            $criarjsonr = json_encode($criarjsonauxr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $cmdalt = "UPDATE RelatorioPerguntas SET jsonreferencia = '$criarjsonr', jsontiporeferencia = '$criarjsontipo' WHERE id = '$id'";
            $retorno = mysqli_query($link, $cmdalt);

            break;
    }

} else if ($tiporeferencia == 'revenda') {

    $arrayaux = $_POST['arrayaux'];
    $selectrev = $arrayaux[0];

    switch ((string)$selectrev) {
        case 'revuni':

            $refunirev = $arrayaux[1];

            $criarjsonauxtipo = array(array('tipo' => $tiporeferencia, 'select' => $selectrev));
            $criarjsontipo = json_encode($criarjsonauxtipo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $criarjsonauxr = array(array('refunica' => $refunirev));
            $criarjsonr = json_encode($criarjsonauxr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


            $cmdalt = "UPDATE RelatorioPerguntas SET jsonreferencia = '$criarjsonr', jsontiporeferencia = '$criarjsontipo' WHERE id = '$id'";
            $retorno = mysqli_query($link, $cmdalt);

            break;

        case 'revest':

            $refestrev = $arrayaux[1];

            $criarjsonauxtipo = array(array('tipo' => $tiporeferencia, 'select' => $selectrev));
            $criarjsontipo = json_encode($criarjsonauxtipo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $criarjsonauxr = array(array('refestado' => $refestrev));
            $criarjsonr = json_encode($criarjsonauxr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


            $cmdalt = "UPDATE RelatorioPerguntas SET jsonreferencia = '$criarjsonr', jsontiporeferencia = '$criarjsontipo' WHERE id = '$id'";
            $retorno = mysqli_query($link, $cmdalt);

            break;

        case 'revendas':

            $revaux = $_POST['revaux'];

            $criarjsonauxtipo = array(array('tipo' => $tiporeferencia, 'select' => $selectrev));
            $criarjsontipo = json_encode($criarjsonauxtipo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $criarjsonauxr = array();

            for ($i = 0; $i < sizeof($revaux); $i++) {
                $criarjsonauxr[] = array('idrevenda' => $revaux[$i]);
            }
            $criarjsonr = json_encode($criarjsonauxr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $cmdalt = "UPDATE RelatorioPerguntas SET jsonreferencia = '$criarjsonr', jsontiporeferencia = '$criarjsontipo' WHERE id = '$id'";
            $retorno = mysqli_query($link, $cmdalt);

            break;

        case 'revtodas':

            $criarjsonauxtipo = array(array('tipo' => $tiporeferencia, 'select' => $selectrev));
            $criarjsontipo = json_encode($criarjsonauxtipo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $criarjsonauxr = array();

            $cmdrevendar = "SELECT id FROM Revenda ORDER BY id";
            $resultrevendar = mysqli_query($link, $cmdrevendar);
            while ($dadosrevendar = mysqli_fetch_array($resultrevendar)) {
                $criarjsonauxr[] = array('idrevenda' => $dadosrevendar['id']);
            }

            $criarjsonr = json_encode($criarjsonauxr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $cmdalt = "UPDATE RelatorioPerguntas SET jsonreferencia = '$criarjsonr', jsontiporeferencia = '$criarjsontipo' WHERE id = '$id'";
            $retorno = mysqli_query($link, $cmdalt);

            break;
    }
}





echo $retorno;
