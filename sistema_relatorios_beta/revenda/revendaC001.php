<?php

require_once '../conexao_banco.php';

?>


<script src="revenda/revenda.js"></script>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title" style="font-size:30px;">Revenda</h2>
                <div class="add-items d-flex mb-0">
                    <a href="./revendanovo.php">
                        <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                        <button type="button" class="btn btn-primary">Nova Revenda</button>
                    </a>
                </div>
            </div>
            <p class="card-description">
                Tabela de<code>Revendas/Distribuidoras</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 40%;text-align: center">Nome Fantasia</th>
                            <th style="width: 10%;text-align: center">Base</th>
                            <th style="width: 15%;text-align: center">CNPJ</th>
                            <th style="width: 10%;text-align: center">Cidade</th>
                            <th style="width: 5%;text-align: center">Estado</th>
                            <th style="width: 10%;text-align: center">Status</th>
                            <th style="width: 10%;text-align: center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $pesquisa = $mysqli->real_escape_string($_POST['pesquisatitulo']);
                        $pesquisa = $_POST['pesquisanome'];
                        $selectPesquisa = "SELECT * FROM Revenda WHERE nomefantasia LIKE '%$pesquisa%' ORDER BY nomefantasia";
                        $selectExportar = "SELECT nomefantasia, cnpj, base, adesao, cidade FROM Revenda WHERE nomefantasia LIKE '%$pesquisa%' ORDER BY nomefantasia ";

                        $resultpesquisa = mysqli_query($link, $selectPesquisa);
                        $row_pesquisa = mysqli_num_rows($resultpesquisa);
                        if ($row_pesquisa > 0) {
                            while ($dadospesquisa = mysqli_fetch_array($resultpesquisa)) {

                                $idEstado = $dadospesquisa["Estado_id"];

                                //verificar estado
                                $cmdEstado = "SELECT * FROM Estado WHERE id = '$idEstado'";
                                $resultEstado = mysqli_query($link, $cmdEstado);
                                $dadosEstado = mysqli_fetch_array($resultEstado);
                        ?>
                                <tr>
                                    <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dadospesquisa['id']; ?>);
                                          $('#formRevenda').submit();">
                                        <?= $dadospesquisa['nomefantasia']; ?>
                                    </td>
                                    <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dadospesquisa['id']; ?>);
                                          $('#formRevenda').submit();">
                                        <?= $dadospesquisa['base']; ?>
                                    </td>
                                    <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dadospesquisa['id']; ?>);
                                          $('#formRevenda').submit();">
                                        <?= $dadospesquisa['cnpj']; ?>
                                    </td>
                                    <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dadospesquisa['id']; ?>);
                                          $('#formRevenda').submit();">
                                        <?= $dadospesquisa['cidade']; ?>
                                    </td>
                                    <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dadospesquisa['id']; ?>);
                                          $('#formRevenda').submit();">
                                        <?= $dadosEstado['titulo']; ?>
                                    </td>
                                    <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dados['id']; ?>);
                                          $('#formRevenda').submit();">
                                    <?php
                                    if ($dadospesquisa['status'] == 1) {
                                        echo "<span class='badge badge-success'>Ativado</span>";
                                    } else if ($dadospesquisa['status'] == 0) {
                                        echo "<span class='badge badge-warning'>Inativo</span>";
                                    } else if ($dadospesquisa['status'] == 2) {
                                        echo "<span class='badge badge-info'>Fixo</span>";
                                    }else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                    <td>
                                        <button type="button" onclick="$('#idr').val(<?= $dadospesquisa['id']; ?>); $('#formRevenda').submit();" class="btn btn-outline-warning btn-fw">Alterar</button>
                                        <?php
                                        if ($dadospesquisa['status'] != 2) {
                                        ?>
                                            <button type="button" onclick="excluirRevenda(<?= $dadospesquisa['id']; ?>)" class="btn btn-outline-danger btn-fw">Excluir</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td coldspan="5">
                                    Revenda não encontrada...
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
            <?php if ($row_pesquisa > 0) { ?>
                <div class="add-items d-flex mb-0">
                    <button type="button" onclick="exportarRevendaPesquisa()" class="btn btn-success">Exportar</button>
                </div>
            <?php } ?>
        </div>
    </div>
</div>