<?php

require_once './head.php';

$sessionColaborador = $_SESSION['idColaborador'];

$idrp = $_POST['idrrp'];

if (!$idrp) {
    header('Location: relatoriorespostas.php');
}
//seleciona o id (Relatorio Respostas) que corresponde ao colaborador ativo e ao relatorio de perguntas referenciado
$cmdrr = "SELECT *
        FROM RelatorioRespostas
        WHERE RelatorioPerguntas_id = '$idrp' AND Colaborador_id = '$sessionColaborador'";
$resultrr = mysqli_query($link, $cmdrr);
$dadosrr = mysqli_fetch_array($resultrr);

$idrr = $dadosrr['id'];

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

            $selectReferencia = "SELECT e.titulo as estado, r.id as id, r.nomefantasia as nomefantasia, r.cidade as cidade, r.base as base
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

$aux = array();

?>

<script src="relatoriorespostas/relatoriorespostas.js"></script>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Responder Relatorio</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <?php if ($tiporefaux == 'produto') { ?>
                        <tr>
                            <th style="width: 40%;text-align: center">Produto</th>
                            <th style="width: 10%;text-align: center">Peso</th>
                            <th style="width: 15%;text-align: center">Categoria</th>
                            <?php
                            $aux = array();
                            $n = 0;
                            foreach ($jsonBanco as $pergunta) {
                                $n++;
                                $ordemaux = $pergunta->ordem;
                                $questaopergunta = $pergunta->questaopergunta;
                                $tipopergunta = $pergunta->tipopergunta;
                                $zero = $pergunta->zero;
                            ?>
                                <th style="width: 10%;text-align: center"><?= $questaopergunta; ?></th>
                            <?php } ?>

                        </tr>
                    <?php } else { ?>
                        <tr>
                            <th style="width: 40%;text-align: center">Revenda</th>
                            <th style="width: 10%;text-align: center">Base</th>
                            <th style="width: 15%;text-align: center">Cidade</th>
                            <?php
                            $aux = array();
                            $n = 0;
                            foreach ($jsonBanco as $pergunta) {
                                $n++;
                                $ordemaux = $pergunta->ordem;
                                $questaopergunta = $pergunta->questaopergunta;
                                $tipopergunta = $pergunta->tipopergunta;
                                $zero = $pergunta->zero;
                            ?>
                                <th style="width: 10%;text-align: center"><?= $questaopergunta; ?></th>
                            <?php } ?>

                        </tr>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php
                    if ($tiporefaux == 'produto') {
                        while ($dadosReferencia = mysqli_fetch_array($resultreferencia)) {
                            $idProd = $dadosReferencia['id'];
                    ?>
                            <tr>
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
                                foreach ($jsonBanco as $pergunta) {
                                    $ordemaux = $pergunta->ordem;
                                    $questaopergunta = $pergunta->questaopergunta;
                                    $tipopergunta = $pergunta->tipopergunta;
                                    $zero = $pergunta->zero;
                                ?>
                                    <td style="text-align: center;">
                                        <?php
                                        if ($tipopergunta == 'dissertativa') { ?>

                                            <input type="text" id="<?= 'resposta' . $idProd . '-' . $ordemaux ?>" class="form-control" obrigatorio="1">

                                        <?php } elseif ($tipopergunta == 'data') { ?>

                                            <input type="date" id="<?= 'resposta' . $idProd . '-' . $ordemaux ?>" class="form-control" obrigatorio="1">

                                        <?php } elseif ($tipopergunta == 'numerointeiro') { ?>

                                            <input type="number" id="<?= 'resposta' . $idProd . '-' . $ordemaux ?>" class="form-control" obrigatorio="1">

                                        <?php } elseif ($tipopergunta == 'numerodecimal') { ?>

                                            <input type="number" id="<?= 'resposta' . $idProd . '-' . $ordemaux ?>" class="form-control" obrigatorio="1">

                                        <?php } elseif ($tipopergunta == 'porcentagem') { ?>

                                            <input type="number" id="<?= 'resposta' . $idProd . '-' . $ordemaux ?>" class="form-control" obrigatorio="1">

                                        <?php } ?>
                                    </td>
                                <?php $aux[] = 'resposta' . $idProd . '-' . $ordemaux;
                                } ?>
                            </tr>
                        <?php }
                    } else {
                        while ($dadosReferencia = mysqli_fetch_array($resultreferencia)) {
                            $idRev = $dadosReferencia['id'];
                        ?>
                            <tr>
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
                                foreach ($jsonBanco as $pergunta) {
                                    $ordemaux = $pergunta->ordem;
                                    $questaopergunta = $pergunta->questaopergunta;
                                    $tipopergunta = $pergunta->tipopergunta;
                                    $zero = $pergunta->zero;
                                ?>
                                    <td style="text-align: center;">
                                        <?php
                                        if ($tipopergunta == 'dissertativa') { ?>

                                            <input type="text" id="<?= 'resposta' . $idRev . '-' . $ordemaux ?>" class="form-control" obrigatorio="1">

                                        <?php } elseif ($tipopergunta == 'data') { ?>

                                            <input type="date" id="<?= 'resposta' . $idRev . '-' . $ordemaux ?>" class="form-control" obrigatorio="1">

                                        <?php } elseif ($tipopergunta == 'numerointeiro') { ?>

                                            <input type="number" id="<?= 'resposta' . $idRev . '-' . $ordemaux ?>" class="form-control" obrigatorio="1">

                                        <?php } elseif ($tipopergunta == 'numerodecimal') { ?>

                                            <input type="number" id="<?= 'resposta' . $idRev . '-' . $ordemaux ?>" class="form-control" obrigatorio="1">

                                        <?php } elseif ($tipopergunta == 'porcentagem') { ?>

                                            <input type="number" id="<?= 'resposta' . $idRev . '-' . $ordemaux ?>" class="form-control" obrigatorio="1">

                                        <?php } ?>
                                    </td>
                                <?php $aux[] = 'resposta' . $idRev . '-' . $ordemaux;
                                } ?>
                            </tr>

                    <?php }
                    }
                    $aux0 = json_encode($aux);
                    ?>
                </tbody>
            </table>
        </div>
        <div class="add-items d-flex mb-0">

            <button type="button" id="buttonalterarcategoria" onclick='salvarResposta(<?= $aux0; ?>, <?= $idrr; ?>)' class="btn btn-primary me-2">Confirmar</button>
            <button type="button" class="btn btn-light" onclick="redirecionarRelatorioRespostas()">Cancelar</button>
        </div>
    </div>
</div>
<?php include './footer.php'; ?>