<?php

require_once '../conexao_banco.php';

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
        } else if ($selectcompar == 'revest') {

            $referenciaaux = $referencia->refestado;

            $referentea = 'Estado';

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



?>
<script src="relatorioperguntas/relatorioperguntas.js"></script>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="title" id="defaultModalLabel">Todas as respostas referente ao relatório "<?= $dados['titulo'] ?>"</h4>
        </div>
        <div class="modal-body">
            <form class="forms-sample">
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 20%;text-align: center">Colabordador / Revenda</th>
                                    <?php if ($tiporefaux == 'produto') { ?>
                                        <th style="width: 15%;text-align: center">Produto</th>
                                        <th style="width: 10%;text-align: center">Peso</th>
                                        <th style="width: 15%;text-align: center">Categoria</th>
                                    <?php } else { ?>
                                        <th style="width: 15%;text-align: center">Revenda referência</th>
                                        <th style="width: 10%;text-align: center">Base</th>
                                        <th style="width: 15%;text-align: center">Cidade</th>
                                    <?php }
                                    $ligardata = 0;
                                    $confirmarordem = 0;
                                    foreach ($jsonBanco as $pergunta) {
                                        $ordemaux0 = $pergunta->ordem;
                                        $questaopergunta = $pergunta->questaopergunta;
                                        $tipopergunta = $pergunta->tipopergunta;
                                        if ($tipopergunta == 'data') {
                                            $ligardata = 1;
                                            $confirmarordem = $ordemaux0;
                                        }
                                        $zero = $pergunta->zero;
                                    ?>
                                        <th style="width: 10%;text-align: center"><?= $questaopergunta; ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cmdR = "SELECT rr.jsonrespostas as jsonrespostas, col.titulo as colaborador, r.nomefantasia as revenda
                                FROM RelatorioRespostas rr
                                LEFT JOIN Colaborador col ON rr.Colaborador_id = col.id
                                LEFT JOIN Revenda r ON col.Revenda_id = r.id
                                WHERE rr.RelatorioPerguntas_id = '$idrp'";
                                $resultR = mysqli_query($link, $cmdR);
                                // Armazenar os resultados em um array
                                $referenciaArray = array();
                                while ($dadosReferencia = mysqli_fetch_array($resultreferencia)) {
                                    $referenciaArray[] = $dadosReferencia;
                                }

                                // Loop externo
                                if ($tiporefaux == 'produto') {
                                    while ($dadosR = mysqli_fetch_array($resultR)) {
                                        foreach ($referenciaArray as $dadosReferencia) {
                                            $idProd = $dadosReferencia['id']; ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <?= $dadosR['colaborador'] . '/' . $dadosR['revenda']; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?= $dadosReferencia['produto']; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?= $dadosReferencia['peso'] . ' - ' . $dadosReferencia['tipopeso']; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?= $dadosReferencia['categoria']; ?>
                                                </td>
                                                <?php
                                                $jsonBancoR = json_decode($dadosR['jsonrespostas']);
                                                if ($jsonBancoR != null) {
                                                    foreach ($jsonBancoR as $resposta) {
                                                        $ordemresposta  = $resposta->ordem;
                                                        $respostapergunta = $resposta->respostapergunta;
                                                        $tiporesposta = $resposta->tiporesposta;
                                                        $ordemrespostaaux = explode("-", $ordemresposta);
                                                        if ($ordemrespostaaux[0] == $idProd) {
                                                            if ($ligardata == 1 && $tiporesposta == 'data') {
                                                                $dataraux = explode("-", $respostapergunta);
                                                                $respostapergunta = $dataraux[2] . '/' . $dataraux[1] . '/' . $dataraux[0];
                                                            }
                                                ?>
                                                            <td style="text-align: center"><?= $respostapergunta; ?></td>
                                                        <?php }
                                                    }
                                                } else {
                                                    foreach ($jsonBanco as $pergunta) {
                                                        ?>
                                                        <td style="text-align: center">Não respondido</td>
                                                <?php }
                                                } ?>
                                            </tr>
                                    <?php }
                                    } ?>

                                    <?php } else {
                                    while ($dadosR = mysqli_fetch_array($resultR)) {
                                        foreach ($referenciaArray as $dadosReferencia) {
                                            $idRev = $dadosReferencia['id']; ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <?= $dadosR['colaborador'] . '/' . $dadosR['revenda']; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?= $dadosReferencia['nomefantasia']; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?= $dadosReferencia['base']; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?= $dadosReferencia['cidade']; ?>
                                                </td>
                                                <?php
                                                $jsonBancoR = json_decode($dadosR['jsonrespostas']);
                                                if ($jsonBancoR != null) {
                                                    foreach ($jsonBancoR as $resposta) {
                                                        $ordemresposta  = $resposta->ordem;
                                                        $respostapergunta = $resposta->respostapergunta;
                                                        $tiporesposta = $resposta->tiporesposta;
                                                        $ordemrespostaaux = explode("-", $ordemresposta);
                                                        if ($ordemrespostaaux[0] == $idRev) {
                                                            if ($ligardata == 1 && $tiporesposta == 'data') {
                                                                $dataraux = explode("-", $respostapergunta);
                                                                $respostapergunta = $dataraux[2] . '/' . $dataraux[1] . '/' . $dataraux[0];
                                                            }
                                                ?>
                                                            <td style="text-align: center"><?= $respostapergunta; ?></td>
                                                        <?php }
                                                    }
                                                } else {
                                                    foreach ($jsonBanco as $pergunta) {
                                                        ?>
                                                        <td style="text-align: center">Não respondido</td>
                                                <?php }
                                                }
                                                ?>
                                            </tr>
                                <?php }
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="add-items d-flex mb-0">
                        <button type="button" class="btn btn-primary me-2" onclick="fecharmodalPerguntas()">Fechar</button>
                        <button type="button" class="btn btn-dark" onclick="exportarRelatorioCompleto('<?= $idrp; ?>')">Exportar</button>
                    </div>
            </form>
        </div>
    </div>
</div>