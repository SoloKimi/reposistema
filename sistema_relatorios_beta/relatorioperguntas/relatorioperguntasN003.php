<?php

require_once '../conexao_banco.php';

$idrp = $_POST['id'];

?>
<script src="relatorioperguntas/relatorioperguntas.js"></script>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="title" id="defaultModalLabel">Ligar colaborador a Formulário</h4>
        </div>
        <div class="modal-body">

            <form class="forms-sample">
                <div class="form-group">
                    <?php
                    $cmdCRR = "SELECT * FROM RelatorioRespostas WHERE RelatorioPerguntas_id = '$idrp'";
                    $resultCRR = mysqli_query($link, $cmdCRR);
                    $row_colrr = mysqli_num_rows($resultCRR);

                    if ($row_colrr == 0) { ?>

                        <label for="conectcol">Conectar todos?*</label>
                        <select class="form-control show-tick selectpicker" name="conectcol" id="conectcol">
                            <option selected value="">[Selecione]</option>
                            <option value="1">Listar</option>
                            <option value="0">Todos</option>
                        </select>

                        <div id="divprincipal" style="display: none">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%;text-align: center">Nome</th>
                                            <th style="width: 10%;text-align: center">Distribuidora</th>
                                            <th style="width: 10%;text-align: center">Status</th>
                                            <th style="width: 10%;text-align: center">Conectar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $aux = '';
                                        $montaraux = 0;

                                        $cmd = "SELECT * FROM Colaborador WHERE id != '1' AND id NOT IN(SELECT Colaborador_id FROM RelatorioRespostas WHERE RelatorioPerguntas_id = '$idrp') ORDER BY id ";
                                        $result = mysqli_query($link, $cmd);
                                        while ($dados = mysqli_fetch_array($result)) {

                                            $checkid = $dados['id']
                                        ?>
                                            <tr>
                                                <td style="text-align: center; cursor: pointer">
                                                    <?= $dados['titulo']; ?>
                                                </td>
                                                <td style="text-align: center; cursor: pointer">
                                                    <?php $idrevenda = $dados['Revenda_id'];
                                                    $cmdrevenda = "SELECT * FROM Revenda 
                                                        WHERE id = '$idrevenda'";
                                                    $resultrevenda = mysqli_query($link, $cmdrevenda);
                                                    $dadosrevenda = mysqli_fetch_array($resultrevenda);
                                                    ?>
                                                    <?=
                                                    $dadosrevenda['nomefantasia'];
                                                    ?>
                                                </td>
                                                <td style="text-align: center; cursor: pointer">
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
                                                        <input id="<?= $checkid; ?>" value="<?= $dados['id']; ?>" type="checkbox">
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
                    <?php } else { ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;text-align: center">Nome</th>
                                        <th style="width: 10%;text-align: center">Distribuidora</th>
                                        <th style="width: 10%;text-align: center">Status</th>
                                        <th style="width: 10%;text-align: center">Conectar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $aux = '';
                                    $montaraux = 0;

                                    $cmd = "SELECT * FROM Colaborador WHERE id != '1' AND id NOT IN(SELECT Colaborador_id FROM RelatorioRespostas WHERE RelatorioPerguntas_id = '$idrp') ORDER BY id ";
                                    $result = mysqli_query($link, $cmd);
                                    while ($dados = mysqli_fetch_array($result)) {

                                        $checkid = $dados['id']
                                    ?>
                                        <tr>
                                            <td style="text-align: center; cursor: pointer">
                                                <?= $dados['titulo']; ?>
                                            </td>
                                            <td style="text-align: center; cursor: pointer">
                                                <?php $idrevenda = $dados['Revenda_id'];
                                                $cmdrevenda = "SELECT * FROM Revenda 
                                                        WHERE id = '$idrevenda'";
                                                $resultrevenda = mysqli_query($link, $cmdrevenda);
                                                $dadosrevenda = mysqli_fetch_array($resultrevenda);
                                                ?>
                                                <?=
                                                $dadosrevenda['nomefantasia'];
                                                ?>
                                            </td>
                                            <td style="text-align: center; cursor: pointer">
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
                                                    <input id="<?= $checkid; ?>" value="<?= $dados['id']; ?>" type="checkbox">
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
                    <?php
                    }
                    ?>

                </div>

                <div class="add-items d-flex mb-0">
                    <button type="button" id="buttoninserirrelatorioperguntas" onclick="salvarColaboradorP('<?= $idrp ?>', '<?= $aux ?>')" class="btn btn-primary me-2">Confirmar</button>
                    <button type="button" class="btn btn-light" onclick="fecharmodalPerguntas()">Cancelar</button>
                </div>
            </form>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

        $('#conectcol').on('change', function() {
            var selectValor = $(this).val();
            if (selectValor === '1') {
                $('#divprincipal').show();
            } else {
                $('#divprincipal').hide();
            }

            // $('#divprincipal').children('div').hide();
            // $('#divprincipal').children(selectValor).show();
        });
    });
</script>

<form action="relatorioperguntaseditar.php" method="POST" id="formRelatorioPerguntas">
    <input type="hidden" value="" id="idrp" name="idrp">
</form>