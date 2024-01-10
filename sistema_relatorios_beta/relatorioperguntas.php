<?php

require_once './head.php';

?>
<script src="relatorioperguntas/relatorioperguntas.js"></script>
<script src="script.js"></script>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title" style="font-size:30px;">Relatório de Perguntas</h2>
                <div class="add-items d-flex mb-0">
                    <a href="./relatorioperguntasnovo.php">
                        <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                        <button type="button" class="btn btn-primary">Novo Relatório de Perguntas</button>
                    </a>
                </div>
            </div>
            <p class="card-description">
                Tabela de<code>Relatório de Perguntas</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20%;text-align: center">Data Criação e vencimento</th>
                            <th style="width: 60%;text-align: center">Titulo</th>
                            <th style="width: 5%;text-align: center">Status</th>
                            <th style="width: 15%;text-align: center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cmd = "SELECT * FROM RelatorioPerguntas ORDER BY titulo ";
                        $result = mysqli_query($link, $cmd);
                        while ($dados = mysqli_fetch_array($result)) {
                            //tratar datas
                            // $datacriacao = transformarData($dados["datacriacao"]);
                            $datacriacaoaux = explode("-", $dados["datacriacao"]);
                            $datacriacao = $datacriacaoaux[2].'/'.$datacriacaoaux[1].'/'.$datacriacaoaux[0];

                            $datalimiteaux = explode("-", $dados["datalimite"]);
                            $datalimite = $datalimiteaux[2].'/'.$datalimiteaux[1].'/'.$datalimiteaux[0];
                        ?>
                            <tr>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idrp').val(<?= $dados['id']; ?>);
                                          $('#formRelatorioPerguntas').submit();">
                                    De <?= $datacriacao; ?> a <?= $datalimite; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idrp').val(<?= $dados['id']; ?>);
                                          $('#formRelatorioPerguntas').submit();">
                                    <?= $dados['titulo']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idrp').val(<?= $dados['id']; ?>);
                                          $('#formRelatorioPerguntas').submit();">
                                    <?php
                                    if ($dados['status'] == 1) {
                                        echo "<span class='badge badge-success'>Ativado</span>";
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
                                    <button type="button" onclick="$('#idrp').val(<?= $dados['id']; ?>); $('#formRelatorioPerguntas').submit();" class="btn btn-outline-warning btn-fw">Alterar</button>
                                    <?php
                                    if ($dados['status'] != 2) {
                                    ?>
                                        <button type="button" onclick="excluirRelatorioPerguntas(<?= $dados['id']; ?>)" class="btn btn-outline-danger btn-fw">Excluir</button>
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
<form action="relatorioperguntaseditar.php" method="POST" id="formRelatorioPerguntas">
    <input type="hidden" value="" id="idrp" name="idrp">
</form>

<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<?php require_once "footer.php"; ?>