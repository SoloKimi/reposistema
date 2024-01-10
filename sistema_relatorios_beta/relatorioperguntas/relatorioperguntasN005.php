<?php

require_once '../conexao_banco.php';

$idrp = $_POST['id'];
$aux = '';

?>
<script src="relatorioperguntas/relatorioperguntas.js"></script>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="title" id="defaultModalLabel">Selecionar Referências</h3>
        </div>
        <div class="modal-body">

            <form class="forms-sample">
                <div class="form-group">
                    <label for="tiporeferencia">Tipo de referencia*</label>
                    <select class="form-control show-tick selectpicker" obrigatorio="1" id="tiporeferencia">
                        <option selected value="vazia">[Selecione]</option>
                        <option value="produto">Produto</option>
                        <option value="revenda">Revenda</option>
                    </select>

                    <div id="divprincipal">
                        <div id="produto" style="display: none">
                            <br />
                            <h7 class="card-title" style="font-size:30px;">Produtos</h7>
                            <br />

                            <label for="refmultprod">Seleção de produto*</label>
                            <select class="form-control show-tick selectpicker" name="refmultprod" id="refmultprod">
                                <option selected value="">[Selecione]</option>
                                <option value="prodet">Especificado</option>
                                <option value="protodos">Todos</option>
                                <option value="promult">Multiplos</option>
                            </select>

                            <div id="prodet" style="display: none">
                                <div class="d-flex justify-content-between align-items-center row row-cols-10 form-group">
                                    <label for="referenciacategoria">Categoria</label>
                                    <select class="form-control show-tick selectpicker" id="referenciacategoria">
                                        <option value="0">[Selecione]</option>
                                        <?php
                                        $cmdcategoriap = "SELECT id, titulo FROM Categoria ORDER BY id";
                                        $resultcategoriap = mysqli_query($link, $cmdcategoriap);
                                        while ($dadoscategoriap = mysqli_fetch_array($resultcategoriap)) {
                                        ?>
                                            <option value="<?= $dadoscategoriap['id']; ?>"><?= $dadoscategoriap['titulo']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between align-items-center row row-cols-10 form-group">
                                    <label for="referenciafamilia1">Familia 1</label>
                                    <select class="form-control show-tick selectpicker" id="referenciafamilia1">
                                        <option value="0">[Selecione]</option>
                                        <?php
                                        $cmdcategoriap = "SELECT id, titulo FROM Familia1 ORDER BY id";
                                        $resultcategoriap = mysqli_query($link, $cmdcategoriap);
                                        while ($dadoscategoriap = mysqli_fetch_array($resultcategoriap)) {
                                        ?>
                                            <option value="<?= $dadoscategoriap['id']; ?>"><?= $dadoscategoriap['titulo']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between align-items-center row row-cols-10 form-group">
                                    <label for="referenciafamilia2">Familia 2</label>
                                    <select class="form-control show-tick selectpicker" id="referenciafamilia2">
                                        <option value="0">[Selecione]</option>
                                        <?php
                                        $cmdcategoriap = "SELECT id, titulo FROM Familia2 ORDER BY id";
                                        $resultcategoriap = mysqli_query($link, $cmdcategoriap);
                                        while ($dadoscategoriap = mysqli_fetch_array($resultcategoriap)) {
                                        ?>
                                            <option value="<?= $dadoscategoriap['id']; ?>"><?= $dadoscategoriap['titulo']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between align-items-center form-group row row-cols-10: auto !important">
                                    <label for="referenciaembalagem">Embalagem</label>
                                    <select class="form-control show-tick selectpicker" id="referenciaembalagem">
                                        <option value="0">[Selecione]</option>
                                        <?php
                                        $cmdembalagemp = "SELECT id, titulo FROM Embalagem ORDER BY id";
                                        $resultembalagemp = mysqli_query($link, $cmdembalagemp);
                                        while ($dadosembalagemp = mysqli_fetch_array($resultembalagemp)) {
                                        ?>
                                            <option value="<?= $dadosembalagemp['id']; ?>"><?= $dadosembalagemp['titulo']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div id="protodos" style="display: none">

                            </div>

                            <div id="promult" style="display: none">
                            <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 30%;text-align: center">Titulo</th>
                                                <th style="width: 15%;text-align: center">Peso</th>
                                                <th style="width: 15%;text-align: center">Paletização</th>
                                                <th style="width: 10%;text-align: center">Categoria</th>
                                                <th style="width: 5%;text-align: center">Status</th>
                                                <th style="width: 5%;text-align: center">Conectar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $montaraux = 0;

                                            $cmdmultipro = "SELECT p.titulo as titulo, p.status as status, p.id as id, p.peso as peso, p.paletizacao as paletizacao, tp.titulo as tipopeso, c.titulo as categoria
                                                    FROM Produto p
                                                    LEFT JOIN TipoPeso tp ON p.TipoPeso_id = tp.id
                                                    LEFT JOIN Categoria c ON p.Categoria_id = c.id
                                                    ORDER BY id ";
                                            $resultmultipro = mysqli_query($link, $cmdmultipro);
                                            while ($dadosmultipro = mysqli_fetch_array($resultmultipro)) {

                                                $checkidpro = $dadosmultipro['id']
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <?= $dadosmultipro['titulo']; ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?= $dadosmultipro['peso'] . ' - ' . $dadosmultipro['tipopeso']; ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?= $dadosmultipro['paletizacao']; ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?= $dadosmultipro['categoria']; ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php
                                                        if ($dadosmultipro['status'] == 1) {
                                                            echo "<span class='badge badge-success'>Ativo</span>";
                                                        } else if ($dadosmultipro['status'] == 0) {
                                                            echo "<span class='badge badge-warning'>Inativo</span>";
                                                        } else if ($dadosmultipro['status'] == 2) {
                                                            echo "<span class='badge badge-info'>Fixo</span>";
                                                        } else {
                                                            echo "-";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-flat form-check-primary">
                                                            <input id="<?= $checkidpro.'p'; ?>" value="<?= $dadosmultipro['id']; ?>" type="checkbox">
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                if ($montaraux == 0) {
                                                    $auxpro = $checkidpro;
                                                } else {
                                                    $auxpro .= ',' . $checkidpro;
                                                }
                                                $montaraux++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div id="revenda" style="display: none">
                            <br />
                            <h7 class="card-title" style="font-size:30px;">Revendas</h7>
                            <br />
                            <label for="refmultrev">Seleção de revenda*</label>
                            <select class="form-control show-tick selectpicker" name="refmultrev" id="refmultrev">
                                <option selected value="">[Selecione]</option>
                                <option value="revuni">Unica</option>
                                <option value="revest">Por estado</option>
                                <option value="revendas">Multiplas</option>
                                <option value="revtodas">Todas</option>
                            </select>

                            <div id="revuni" style="display: none">
                                <div class="d-flex justify-content-between align-items-center row row-cols-10 form-group">
                                    <label for="referenciarevenda">Selecionar revenda única</label>
                                    <select class="form-control show-tick selectpicker" id="referenciarevenda">
                                        <option value="0">[Selecione]</option>
                                        <?php
                                        $cmdrevendar = "SELECT id, nomefantasia FROM Revenda ORDER BY id";
                                        $resultrevendar = mysqli_query($link, $cmdrevendar);
                                        while ($dadosrevendar = mysqli_fetch_array($resultrevendar)) {
                                        ?>
                                            <option value="<?= $dadosrevendar['id']; ?>"><?= $dadosrevendar['nomefantasia']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div id="revest" style="display: none">
                                <div class="d-flex justify-content-between align-items-center row row-cols-10 form-group">
                                    <label for="referenciaestado">Selecionar revenda por estado</label>
                                    <select class="form-control show-tick selectpicker" id="referenciaestado">
                                        <option value="0">[Selecione]</option>
                                        <?php
                                        $cmdestador = "SELECT id, titulo FROM Estado ORDER BY id";
                                        $resultestador = mysqli_query($link, $cmdestador);
                                        while ($dadosestador = mysqli_fetch_array($resultestador)) {
                                        ?>
                                            <option value="<?= $dadosestador['id']; ?>"><?= $dadosestador['titulo']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div id="revendas" style="display: none">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 45%;text-align: center">Nome Fantasia</th>
                                                <th style="width: 15%;text-align: center">Cidade</th>
                                                <th style="width: 5%;text-align: center">Estado</th>
                                                <th style="width: 15%;text-align: center">Responsavel</th>
                                                <th style="width: 10%;text-align: center">Base</th>
                                                <th style="width: 5%;text-align: center">Status</th>
                                                <th style="width: 5%;text-align: center">Conectar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $montaraux = 0;

                                            $cmd = "SELECT * FROM Revenda ORDER BY id ";
                                            $result = mysqli_query($link, $cmd);
                                            while ($dados = mysqli_fetch_array($result)) {

                                                $checkid = $dados['id']
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <?= $dados['nomefantasia']; ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?= $dados['cidade']; ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php $idest = $dados['Estado_id'];

                                                        $cmdest = "SELECT * FROM Estado WHERE id = '$idest'";
                                                        $resultest = mysqli_query($link, $cmdest);
                                                        $dadosest = mysqli_fetch_array($resultest);
                                                        ?>
                                                        <?=
                                                        $dadosest['sigla'];
                                                        ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php $idcol = $dados['Colaborador_id'];
                                                        if ($idcol == '0') {
                                                            echo '-';
                                                        } else {

                                                            $cmdcol = "SELECT * FROM Colaborador WHERE id = '$idcol'";
                                                            $resultcol = mysqli_query($link, $cmdcol);
                                                            $dadoscol = mysqli_fetch_array($resultcol);

                                                            $titulocol = $dadoscol['titulo'];
                                                            echo $titulocol;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?= $dados['base']; ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php
                                                        if ($dados['status'] == 1) {
                                                            echo "<span class='badge badge-success'>Ativo</span>";
                                                        } else if ($dados['status'] == 0) {
                                                            echo "<span class='badge badge-warning'>Inativo</span>";
                                                        } else if ($dados['status'] == 2) {
                                                            echo "<span class='badge badge-info'>Fixo</span>";
                                                        } else {
                                                            echo "-";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-flat form-check-primary">
                                                            <input id="<?= $checkid.'r'; ?>" value="<?= $checkid; ?>" type="checkbox">
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                if ($montaraux == 0) {
                                                    $aux = $checkid;
                                                } else {
                                                    $aux .= ',' . $checkid;
                                                }
                                                $montaraux++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="livre">

                        </div>
                    </div>
                </div>
                <button type="button" id="buttoninserirrelatorioperguntas" onclick="salvarReferencia('<?= $idrp ?>', '<?= $aux ?>', '<?= $auxpro ?>')" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="fecharmodalPerguntas()">Cancelar</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#tiporeferencia').on('change', function() {

            var selectValor = '#' + $(this).val();

            $('#divprincipal').children('div').hide();
            $('#divprincipal').children(selectValor).show();

        });
    });

    $(document).ready(function() {

        $('#refmultrev').on('change', function() {

            var selectmultref = '#' + $(this).val();

            $('#revenda').children('div').hide();
            $('#revenda').children(selectmultref).show();

        });
    });

    $(document).ready(function() {

        $('#refmultprod').on('change', function() {

            var selectmultpro = '#' + $(this).val();

            $('#produto').children('div').hide();
            $('#produto').children(selectmultpro).show();

        });
    });
</script>

<form action="relatorioperguntaseditar.php" method="POST" id="formRelatorioPerguntas">
    <input type="hidden" value="" id="idrp" name="idrp">
</form>