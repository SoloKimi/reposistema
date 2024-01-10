<?php

require_once './head.php';

$pesquisa = '';

?>
<script src="compra/compra.js"></script>
<!-- <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title" style="font-size:30px;">Pesquisar compras</h2>
            </div>

        </div>
    </div>
</div> -->
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title" style="font-size:30px;">Compras</h2>
                <div class="add-items d-flex mb-0">
                    <a href="./compranovo.php">
                        <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                        <button type="button" class="btn btn-primary">Nova compra</button>
                    </a>
                </div>
            </div>
            <p class="card-description">
                Tabela de<code>Compras</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10%;text-align: center">Data Efetuada</th>
                            <th style="width: 50%;text-align: center">Descrição</th>
                            <th style="width: 10%;text-align: center">Nota Fiscal</th>
                            <th style="width: 15%;text-align: center">Status</th>
                            <th style="width: 15%;text-align: center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cmd = "SELECT id, date_format(datacompra, '%d/%m/%Y') as datacompra, descricao, notafiscal, status FROM Compra ORDER BY datacompra ";
                        $result = mysqli_query($link, $cmd);
                        while ($dados = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idcm').val(<?= $dados['id']; ?>);
                                          $('#formCompra').submit();">
                                    <?= $dados['datacompra']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idcm').val(<?= $dados['id']; ?>);
                                          $('#formCompra').submit();">
                                    <?= $dados['descricao']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idcm').val(<?= $dados['id']; ?>);
                                          $('#formCompra').submit();">
                                    <?= $dados['notafiscal']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idcm').val(<?= $dados['id']; ?>);
                                          $('#formCompra').submit();">
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
                                    <?php
                                    if ($dados['status'] != 2) {
                                    ?>
                                        <button type="button" onclick="$('#idcm').val(<?= $dados['id']; ?>); $('#formCompra').submit();" class="btn btn-outline-warning btn-fw">Alterar</button>
                                        <button type="button" onclick="excluirCompra(<?= $dados['id']; ?>)" class="btn btn-outline-danger btn-fw">Excluir</button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="add-items d-flex mb-0">
                <button type="button" onclick="exportarCompra()" class="btn btn-success">Exportar</button>
            </div>
        </div>
    </div>
</div>
<form action="compraeditar.php" method="POST" id="formCompra">
    <input type="hidden" value="" id="idcm" name="idcm">
</form>
<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<?php require_once "footer.php"; ?>