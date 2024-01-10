<?php

require_once './head.php';

$idrp = $_POST['idrp'];
$dataatual = date('Y-m-d');

//"SELECT * FROM Colaborador WHERE id != '1' AND id NOT IN(SELECT Colaborador_id FROM RelatorioRespostas WHERE RelatorioPerguntas_id = '$idrp') ORDER BY id ";

if (!$idrp) {
    header('Location: relatorioperguntas.php');
}

$cmdVerCol = "SELECT * FROM Colaborador 
WHERE id != '1' AND id NOT IN(SELECT Colaborador_id FROM RelatorioRespostas WHERE RelatorioPerguntas_id = '$idrp') ORDER BY id ";
$resultVerCol = mysqli_query($link, $cmdVerCol);
$dadosVerCol = mysqli_fetch_array($resultVerCol);

$row_colaboradores = mysqli_num_rows($resultVerCol);
$offnewcol = 0;
if ($row_colaboradores == 0) {
    $offnewcol = 1;
}

$cmd = "SELECT *
        FROM RelatorioPerguntas
        WHERE id = '$idrp'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);

$datalimite = $dados['datalimite'];
$jsonperguntas = $dados['jsonperguntas'];
$titulo = $dados['titulo'];
$limitedata = 0;

// Comparando as Datas
if (strtotime($dataatual) > strtotime($datalimite)) {
    //A data at é maior que a data lim
    $limitedata = 1;
} elseif (strtotime($dataatual) == strtotime($datalimite)) {
    // A data atu é igual a data lim
    $limitedata = 0;
} else {
    //A data atual é menor a data limite
    $limitedata = 0;
}



$offbuttondata = 0;
$cmdRR = "SELECT *
        FROM RelatorioRespostas
        WHERE RelatorioPerguntas_id = '$idrp'";
$resultRR = mysqli_query($link, $cmdRR);
while ($dadosRR = mysqli_fetch_array($resultRR)) {
    if ($dadosRR['data'] != null) {
        $offbuttondata = 1;
    }
}

?>
<!-- card alterar titulo do relatorio -->
<script src="relatorioperguntas/relatorioperguntas.js"></script>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Editar Relatório de Perguntas</h4>
            <p class="card-description">
                Detalhes da relatório perguntas
            </p>
            <form class="forms-sample">
                <div class="form-group">

                    <label for="titulo">Título*</label>
                    <input value="<?= $dados['titulo']; ?>" type="text" id="titulo" class="form-control" placeholder="Título da Relatorio Perguntas" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input <?php if ($dados['status'] == 1) { ?> checked="checked" <?php } elseif ($dados['status'] == 2) { ?> checked="checked" disabled <?php } ?> id="status" type="checkbox">
                            Relatório Ativo
                        </label>
                    </div>
                    <div class="d-flex row row-cols-6 form-group">
                        <label for="datacriacao">Data criação*</label>
                        <input value="<?= $dados['datacriacao']; ?>" readonly type="date" id="datacriacao" class="form-control" obrigatorio="1">
                    </div>

                    <div class="d-flex row row-cols-6 form-group">
                        <label for="datalimite">Data Vencimento*</label>
                        <input value="<?= $dados['datalimite']; ?>" type="date" id="datalimite" class="form-control" obrigatorio="1">
                    </div>
                </div>
                <button type="button" id="buttoninserirrelatorioperguntas" onclick="alterarRelatorioPerguntas(<?= $idrp ?>)" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarRelatorioPerguntas()">Cancelar</button>
                <?php
                if ($offbuttondata == 1) { ?>

                    <button type="button" onclick="modalTodasRespostas(<?= $idrp ?>)" class="btn btn-info">Visualizar Todas</button>

                <?php }
                ?>
            </form>
        </div>
    </div>
</div>
<!-- card para adicionar referencia a uma pergunta -->
<div class="col-md-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title card-title-dash">Referência</h4>
                <?php if (!isset($dados['jsonreferencia'])) { ?>
                    <div class="add-items d-flex mb-0">
                        <button type="button" onclick="modalReferenciaP(<?= $idrp ?>)" class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                    </div>
                <?php } ?>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 40%;text-align: center">Referênciado por</th>
                            <th style="width: 60%;text-align: center">Referências</th>
                            <th style="width: 20%;text-align: center">Quantidade de resultados</th>
                            <th style="width: 15%;text-align: center">Listagem Ref</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $visualizarRef = $dados['jsonreferencia'];
                        $tipoRef = $dados['jsontiporeferencia'];
                        $jsontipoRef = json_decode($dados['jsontiporeferencia']);
                        $jsonRef = json_decode($dados['jsonreferencia']);
                        $selectcompar = 0;
                        $multirevendas = array();
                        $multiprodutos = array();
                        $contarRevendas = 0;
                        if ($jsontipoRef != null) {
                            foreach ($jsontipoRef as $tiporeferencia) {

                                $tiporefaux = $tiporeferencia->tipo;
                                $selectcompar = $tiporeferencia->select;

                            }
                            //verifica o tipo de referencia pelo json e cria as variaveis de acordo com o retorno
                            if ($tiporefaux == 'produto') {

                                if ($selectcompar == 'prodet') {

                                    $referencias = array();
                                    $whereConditions = array();
                                    $referenteaux = array();
                                    foreach ($jsonRef as $referencia) {
                                        $refcat = $referencia->referenciacategoria;
                                        if ($refcat != '0') {
                                            $referenteaux[] = 'Categoria ';
                                            $cmdRCat = "SELECT titulo FROM Categoria WHERE id = '$refcat'";
                                            $resultRCat = mysqli_query($link, $cmdRCat);
                                            $dadosRCat = mysqli_fetch_array($resultRCat);
                                            $referencias[] = $dadosRCat['titulo'];
                                            $whereConditions[] =  "p.Categoria_id = $refcat";
                                        }

                                        $reffam1 = $referencia->referenciafamilia1;
                                        if ($reffam1 != '0') {
                                            $referenteaux[] = 'Familia 1 ';
                                            $cmdRF1 = "SELECT titulo FROM Familia1 WHERE id = '$reffam1'";
                                            $resultRF1 = mysqli_query($link, $cmdRF1);
                                            $dadosRF1 = mysqli_fetch_array($resultRF1);
                                            $referencias[] = $dadosRF1['titulo'];
                                            $whereConditions[] = "p.Familia1_id = '$reffam1'";
                                        }

                                        $reffam2 = $referencia->referenciafamilia2;
                                        if ($reffam2 != '0') {
                                            $referenteaux[] = 'Familia 2 ';
                                            $cmdRF2 = "SELECT titulo FROM Familia2 WHERE id = '$reffam2'";
                                            $resultRF2 = mysqli_query($link, $cmdRF2);
                                            $dadosRF2 = mysqli_fetch_array($resultRF2);
                                            $referencias[] = $dadosRF2['titulo'];
                                            $whereConditions[] = "p.Familia2_id = '$reffam2'";
                                        }

                                        $refemb = $referencia->referenciaembalagem;
                                        if ($refemb != '0') {
                                            $referenteaux[] = ' Embalagem ';
                                            $cmdREmb = "SELECT titulo FROM Embalagem WHERE id = '$refemb'";
                                            $resultREmb = mysqli_query($link, $cmdREmb);
                                            $dadosREmb = mysqli_fetch_array($resultREmb);
                                            $referencias[] = $dadosREmb['titulo'];
                                            $whereConditions[] = "p.Embalagem_id = '$refemb'";
                                        }
                                    }
                                    // Criar string com as referencias
                                    if (!empty($referencias)) {
                                        $referenciasaux = implode(' / ', $referencias);
                                        $referentea = implode(' , ', $referenteaux);
                                    }

                                    // Monta a consulta SQL para contagem de resultados
                                    $selectReferencia = "SELECT p.titulo as produto, p.descricao as descricao, f1.titulo as familia1, f2.titulo as familia2, e.titulo as embalagem, c.titulo as categoria
                                                            FROM Produto p
                                                            LEFT JOIN Familia1 f1 ON p.Familia1_id = f1.id
                                                            LEFT JOIN Familia2 f2 ON p.Familia2_id = f2.id
                                                            LEFT JOIN Embalagem e ON p.Embalagem_id = e.id
                                                            LEFT JOIN Categoria c ON p.Categoria_id = c.id";

                                    // Adiciona a cláusula WHERE nas condições
                                    if (!empty($whereConditions)) {
                                        $whereClause = implode(' AND ', $whereConditions);
                                        $selectReferencia .= " WHERE $whereClause";
                                    }

                                    $selectReferencia .= " ORDER BY p.id";


                                    $resultreferencia = mysqli_query($link, $selectReferencia);
                                    $row_referencia = mysqli_num_rows($resultreferencia);
                                } else if ($selectcompar == 'protodos' || $selectcompar == 'promult') {

                                    $referentea = 'Múltiplos Produtos';

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

                                    $selectReferencia = "SELECT titulo FROM Produto WHERE id in($selecionarProdutos)";
                                    $resultreferencia = mysqli_query($link, $selectReferencia);
                                    $row_referencia = mysqli_num_rows($resultreferencia);
                                    $puxarRevendas = array();
                                    if ($row_referencia > 2) {
                                        $referenciasaux = 'Muitas Referências, clique em visualizar';
                                    } else {
                                        while ($dadosReferencia = mysqli_fetch_array($resultreferencia)) {
                                            $puxarProdutos[] = $dadosReferencia['titulo'];
                                        }
                                        $referenciasaux = implode(', ', $puxarProdutos);
                                    }
                                }
                            } else if ($tiporefaux == 'revenda') {

                                foreach ($jsonRef as $referencia) {

                                    if ($selectcompar == 'revuni') {

                                        $referenciaaux = $referencia->refunica;

                                        $referentea = 'Revenda única';

                                        $selectReferencia = "SELECT nomefantasia
                                                            FROM Revenda
                                                            WHERE id = $referenciaaux";
                                        $resultreferencia = mysqli_query($link, $selectReferencia);
                                        $row_referencia = mysqli_num_rows($resultreferencia);
                                        $dadosReferencia = mysqli_fetch_array($resultreferencia);

                                        $referenciasaux = $dadosReferencia['nomefantasia'];
                                    } else if ($selectcompar == 'revest') {

                                        $referenciaaux = $referencia->refestado;

                                        $referentea = 'Revendas por estado';

                                        $selectReferencia = "SELECT e.titulo as estado, r.id as id, r.nomefantasia as nomefantasia, r.adesao as adesao, r.base as base, r.cnpj as cnpj, r.cidade as cidade
                                                                FROM Revenda r
                                                                LEFT JOIN Estado e ON r.Estado_id = e.id
                                                                WHERE r.Estado_id = $referenciaaux";
                                        $resultreferencia = mysqli_query($link, $selectReferencia);
                                        $row_referencia = mysqli_num_rows($resultreferencia);
                                        $dadosReferencia = mysqli_fetch_array($resultreferencia);

                                        $referenciasaux = $dadosReferencia['estado'];
                                    } else if ($selectcompar == 'revendas' || $selectcompar == 'revtodas') {

                                        $multirevendas[] = $referencia->idrevenda;

                                        $contarRevendas++;
                                        $referentea = 'Multiplas Revendas';
                                    }
                                }

                                if ($selectcompar == 'revendas' || $selectcompar == 'revtodas') {
                                    $selecionarRevendas = '';

                                    for ($i = 0; $i < count($multirevendas); $i++) {
                                        if ($i >= 1) {
                                            $selecionarRevendas .= ',' . $multirevendas[$i];
                                        } else {
                                            $selecionarRevendas = $multirevendas[$i];
                                        }
                                    }

                                    $selectReferencia = "SELECT nomefantasia FROM Revenda WHERE id in($selecionarRevendas)";
                                    $resultreferencia = mysqli_query($link, $selectReferencia);
                                    $row_referencia = mysqli_num_rows($resultreferencia);
                                    $puxarRevendas = array();
                                    if ($row_referencia > 2) {
                                        $referenciasaux = 'Muitas Referências, clique em visualizar';
                                    } else {
                                        while ($dadosReferencia = mysqli_fetch_array($resultreferencia)) {
                                            $puxarRevendas[] = $dadosReferencia['nomefantasia'];
                                        }
                                        $referenciasaux = implode(', ', $puxarRevendas);
                                    }
                                }
                            }
                        } else {
                            $referentea = '-';
                            $referenciasaux = '-';
                            $row_referencia = '-';
                            $selectReferencia = 0;
                        }

                        ?>
                        <tr>
                            <td style="text-align: center;">
                                <?= $referentea; ?>
                            </td>
                            <td style="text-align: center;">
                                <?= $referenciasaux; ?>
                            </td>
                            <td style="text-align: center;">
                                <?= $row_referencia; ?>
                            </td>
                            <td>
                                <?php if ($selectReferencia != 0) { ?>

                                    <button type="button" class="btn btn-outline-info btn-fw" onclick="modalVisualizarReferencia('<?= $idrp; ?>', '<?= $titulo; ?>')">Visualizar</button>

                                    <?php if ($jsonperguntas == null || $jsonperguntas == '[]') {
                                    ?>
                                        <button type="button" class="btn btn-outline-danger btn-fw" onclick="excluirReferencia('<?= $idrp; ?>')">Excluir</button>
                                <?php }
                                } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- card para adicionar colaboradores a uma pergunta -->
<div class="col-md-6 grid-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title card-title-dash">Ligar colaborador</h4>
                <div class="add-items d-flex mb-0">
                    <?php if ($limitedata == 0 && $dados['jsonreferencia'] != null && $offnewcol == 0) { ?>
                        <button type="button" onclick="modalNovoColaboradorP(<?= $idrp ?>)" class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                    <?php } ?>
                </div>
            </div>
            <p class="card-description">
                Tabela de<code>Colaboradores</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 60%;text-align: center">Nome</th>
                            <th style="width: 20%;text-align: center">Data da Resposta</th>
                            <th style="width: 5%;text-align: center">Respondido</th>
                            <th style="width: 15%;text-align: center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cmdrespostas = "SELECT rr.id as idrelatoriorespostas, rr.RelatorioPerguntas_id, date_format(data, '%d/%m/%Y') as data, col.id as idcolaborador, col.titulo as titulo 
                                                FROM RelatorioRespostas rr
                                                LEFT JOIN Colaborador col
                                                ON rr.Colaborador_id = col.id WHERE rr.RelatorioPerguntas_id = '$idrp'";
                        $resultrespostas = mysqli_query($link, $cmdrespostas);

                        while ($dadosrespostas = mysqli_fetch_array($resultrespostas)) {
                            $idColaborador = $dadosrespostas['idcolaborador'];
                            $idRelatorioRespostas = $dadosrespostas['idrelatoriorespostas'];
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <?= $dadosrespostas['titulo']; ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($dadosrespostas['data'] == null) {
                                    ?> - <?php
                                        } else {
                                            ?>
                                        <?= $dadosrespostas['data'] ?>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($dadosrespostas['data'] == null) {
                                        echo "<span class='badge badge-warning'>Não Respondido</span>";
                                    } else {
                                        echo "<span class='badge badge-success'>Respondida</span>";
                                    }
                                    ?>
                                </td>
                                <td>

                                    <?php
                                    if ($dadosrespostas['data'] == null) {
                                    ?>
                                        <button type="button" onclick="excluirColaboradorP(<?= $idRelatorioRespostas; ?>, <?= $idrp ?>)" class="btn btn-outline-danger btn-fw">Excluir</button>
                                    <?php } else { ?>
                                        <button type="button" onclick="modalVisualizarRespostas(<?= $idRelatorioRespostas; ?>, <?= $idrp ?>)" class="btn btn-info">Visualizar</button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- card para criar as perguntas do relatorio -->
<div class="col-md-6 grid-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title card-title-dash">Nova pergunta</h4>
                <div class="add-items d-flex mb-0">
                    <?php
                    if ($dados['jsonreferencia'] != null) {
                        if ($offbuttondata == 0 && $limitedata == 0) {
                    ?>
                            <button type="button" onclick="novaPergunta(<?= $idrp ?>)" class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                    <?php }
                    } ?>
                </div>
            </div>
            <?php
            if (isset($jsonperguntas)) {
            ?>
                <p class="card-description">
                    Tabela de<code>Perguntas</code>
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 20%;text-align: center">Tipo da pergunta</th>
                                <th style="width: 60%;text-align: center">Pergunta</th>
                                <th style="width: 5%;text-align: center">Status</th>
                                <th style="width: 15%;text-align: center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $jsonBanco = json_decode($jsonperguntas);
                            foreach ($jsonBanco as $pergunta) {
                                $ordem = $pergunta->ordem;
                                $questaopergunta = $pergunta->questaopergunta;
                                $tipoperguntaAux = $pergunta->tipopergunta;
                                $status = $pergunta->status;
                            ?>
                                <tr>
                                    <td style="text-align: center; cursor: pointer" onclick="modalAlterarPergunta(<?= $idrp ?> , <?= $ordem ?>)">
                                        <?= $tipoperguntaAux; ?>
                                    </td>
                                    <td style="text-align: center; cursor: pointer" onclick="modalAlterarPergunta(<?= $idrp ?> , <?= $ordem ?>)">
                                        <?= $questaopergunta; ?>
                                    </td>
                                    <td style="text-align: center; cursor: pointer" onclick="modalAlterarPergunta(<?= $idrp ?> , <?= $ordem ?>)">
                                        <?php
                                        if ($status == 0) {
                                            echo "<span class='badge badge-success'>Ativo</span>";
                                        } else if ($status == 1) {
                                            echo "<span class='badge badge-warning'>Fixo</span>";
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($offbuttondata == 0 && $limitedata == 0) {
                                        ?>
                                            <button type="button" onclick="modalAlterarPergunta(<?= $idrp ?> , <?= $ordem ?>)" class="btn btn-outline-warning btn-fw">Alterar</button>
                                            <?php
                                            ?>
                                            <button type="button" onclick="excluirPergunta(<?= $idrp ?> , <?= $ordem ?>)" class="btn btn-outline-danger btn-fw">Excluir</button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else {
                echo 'Nenhuma Pergunta criada';
            } ?>
        </div>
    </div>
</div>

<form action="relatorioperguntaseditar.php" method="POST" id="formRelatorioPerguntas">
    <input type="hidden" value="" id="idrp" name="idrp">
</form>
<?php include './footer.php'; 

//,{"ordem":6,"tipopergunta":"numerointeiro","questaopergunta":"Numero inteiro sem zero","status":"0","zero":"0"}

?>