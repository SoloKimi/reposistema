<?php

require_once './head.php';

@session_start();

$idsessioncolaborador = $_SESSION['idColaborador'];

?>
<script src="relatoriorespostas/relatoriorespostas.js"></script>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <p class="card-description">
                Tabela de<code>Relatório de Perguntas</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20%;text-align: center">ID Relatorio</th>
                            <th style="width: 60%;text-align: center">Titulo Relatorio de perguntas</th>
                            <th style="width: 5%;text-align: center">Status</th>
                            <th style="width: 15%;text-align: center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cmd = "SELECT rp.id as idrp, rr.status as status, rp.jsonperguntas, rr.id as idrelatoriorespostas, rr.Colaborador_id, rr.RelatorioPerguntas_id, rr.data as dataresposta, rp.titulo as titulopergunta
                                FROM RelatorioRespostas rr
                                LEFT JOIN RelatorioPerguntas rp
                                ON rr.RelatorioPerguntas_id = rp.id 
                                WHERE rr.Colaborador_id = '$idsessioncolaborador' AND rp.jsonreferencia is not null";
                        $result = mysqli_query($link, $cmd);
                        while ($dados = mysqli_fetch_array($result)) {
                            //tratar datas
                            //$datacriacao = transformarData($dados["datacriacao"]);
                            if (isset($dados["dataresposta"])) {
                                $datacriacaoaux = explode("-", $dados["dataresposta"]);
                                $dataresposta = $datacriacaoaux[2] . '/' . $datacriacaoaux[1] . '/' . $datacriacaoaux[0];
                            }

                        ?>
                            <tr>
                                <td style="text-align: center; cursor: pointer">
                                    <?= $dados['idrp']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer">
                                    <?= $dados['titulopergunta']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer">
                                    <?php
                                    if ($dados['status'] == 1) {
                                        echo "<span class='badge badge-success'>Respondido</span>";
                                    } else if ($dados['status'] == 0) {
                                        echo "<span class='badge badge-warning'>Não Respondido</span>";
                                    } else if ($dados['status'] == 2) {
                                        echo "<span class='badge badge-info'>Fixo</span>";
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($dados['status'] != 2) {

                                        if (isset($dados["dataresposta"])) { ?>
                                            <button type="button" onclick="excluirResposta(<?= $dados['idrelatoriorespostas']; ?>)" class="btn btn-outline-warning btn-fw">Excluir Respostas</button>
                                        <?php } else {
                                            if($dados["jsonperguntas"] != '[]' || $dados["jsonperguntas"] != null){ ?>
                                            <button type="button" onclick="$('#idrrp').val(<?= $dados['idrp']; ?>); $('#formRelatorioRespostas').submit();" class="btn btn-outline-warning btn-fw">Responder</button>
                                    <?php }}
                                    } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<form action="responderrelatorio.php" method="POST" id="formRelatorioRespostas">
    <input type="hidden" value="" id="idrrp" name="idrrp">
</form>

<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<?php require_once "footer.php"; ?>