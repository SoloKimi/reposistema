<?php

require_once './head.php';

?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="card-title" style="font-size:30px;">Pesquisar revendas</h2>
                </div>
                <input value="" type="text" id="pesquisanome" class="form-control" placeholder="Nome Fantasia Revenda" obrigatorio="1">
            </div>
            <div class="card-footer">
                <button type="button" onclick="buscarRevenda()" class="btn btn-primary">Pesquisar</button>
            </div>
    </div>
</div>
<div id="divrevendapadrao" class="col-lg-12 grid-margin stretch-card">
<script src="revenda/revenda.js"></script>
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
                        $cmd = "SELECT * FROM Revenda ORDER BY nomefantasia ";
                        $selectExportar = "SELECT nomefantasia, cnpj, base, adesao, cidade FROM Revenda ORDER BY nomefantasia ";
                        $result = mysqli_query($link, $cmd);
                        while ($dados = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dados['id']; ?>);
                                          $('#formRevenda').submit();">
                                    <?= $dados['nomefantasia']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dados['id']; ?>);
                                          $('#formRevenda').submit();">
                                     <?php if($dados['base'] == '0'){?> - <?php }else{?> <?= $dados['base']; ?> <?php } ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dados['id']; ?>);
                                          $('#formRevenda').submit();">
                                    <?= $dados['cnpj']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dados['id']; ?>);
                                          $('#formRevenda').submit();">
                                    <?= $dados['cidade']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dados['id']; ?>);
                                          $('#formRevenda').submit();">
                                    <?php $idestado = $dados['Estado_id'];
                                                $cmdestado = "SELECT * FROM Estado 
                                                        WHERE id = '$idestado'";
                                            $resultestado = mysqli_query($link, $cmdestado);
                                            $dadosestado = mysqli_fetch_array($resultestado);
                                            ?>
                                            <?=
                                            $dadosestado['titulo'];
                                            ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idr').val(<?= $dados['id']; ?>);
                                          $('#formRevenda').submit();">
                                    <?php
                                    if ($dados['status'] == 1) {
                                        echo "<span class='badge badge-success'>Ativado</span>";
                                    } else if ($dados['status'] == 0) {
                                        echo "<span class='badge badge-warning'>Inativo</span>";
                                    } else if ($dados['status'] == 2) {
                                        echo "<span class='badge badge-info'>Fixo</span>";
                                    }else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button type="button" onclick="$('#idr').val(<?= $dados['id']; ?>); $('#formRevenda').submit();" class="btn btn-outline-warning btn-fw">Alterar</button>
                                    <?php 
                                    if($dados['status'] != 2){
                                    ?>
                                    <button type="button" onclick="excluirRevenda(<?= $dados['id']; ?>)" class="btn btn-outline-danger btn-fw">Excluir</button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="add-items d-flex mb-0">
                <button type="button" onclick="exportarRevenda('<?= $selectExportar; ?>')" class="btn btn-success">Exportar</button>
            </div>
        </div>
    </div>
</div>


<div id="divresultadorevenda">
    
</div>


<form action="revendaeditar.php" method="POST" id="formRevenda">
    <input type="hidden" value="" id="idr" name="idr">
</form>
<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<?php require_once "footer.php"; ?>