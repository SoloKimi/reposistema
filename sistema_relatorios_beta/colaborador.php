<?php

require_once './head.php';

?>
<script src="colaborador/colaborador.js"></script>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title" style="font-size:30px;">Colaborador</h2>
                <div class="add-items d-flex mb-0">
                    <a href="./colaboradornovo.php">
                        <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                        <button type="button" class="btn btn-primary">Novo colaborador</button>
                    </a>
                </div>
            </div>
            <p class="card-description">
                Tabela de<code>Colaboradores</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 40%;text-align: center">Nome</th>
                            <th style="width: 15%;text-align: center">CPF</th>
                            <th style="width: 15%;text-align: center">Tipo</th>
                            <th style="width: 10%;text-align: center">Distribuidora</th>
                            <th style="width: 10%;text-align: center">Status</th>
                            <th style="width: 10%;text-align: center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cmd = "SELECT * FROM Colaborador WHERE id != '1' ORDER BY titulo ";
                        $result = mysqli_query($link, $cmd);
                        while ($dados = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idcol').val(<?= $dados['id']; ?>);
                                          $('#formColaborador').submit();">
                                    <?= $dados['titulo']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idcol').val(<?= $dados['id']; ?>);
                                          $('#formColaborador').submit();">
                                     <?= $dados['cpf']; ?> 
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idcol').val(<?= $dados['id']; ?>);
                                          $('#formColaborador').submit();">
                                    <?php
                                    if ($dados['tipo'] == 1) {
                                        echo "<span class='badge badge-success'>Administrador</span>";
                                    } else if ($dados['tipo'] == 0) {
                                        echo "<span class='badge badge-warning'>Usuário</span>";
                                    }else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idcol').val(<?= $dados['id']; ?>);
                                          $('#formColaborador').submit();">
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
                                <td style="text-align: center; cursor: pointer" onclick="$('#idcol').val(<?= $dados['id']; ?>);
                                          $('#formColaborador').submit();">
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
                                    <button type="button" onclick="$('#idcol').val(<?= $dados['id']; ?>); $('#formColaborador').submit();" class="btn btn-outline-warning btn-fw">Alterar</button>
                                    <?php 
                                    if($dados['status'] != 2){
                                    ?>
                                    <button type="button" onclick="excluirColaborador(<?= $dados['id']; ?>)" class="btn btn-outline-danger btn-fw">Excluir</button>
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
<form action="colaboradoreditar.php" method="POST" id="formColaborador">
    <input type="hidden" value="" id="idcol" name="idcol">
</form>
<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<?php require_once "footer.php"; ?>