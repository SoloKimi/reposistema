<?php

require_once './head.php';

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Adicionar Nova Revenda/Distribuidora</h4>
            <p class="card-description">
                Detalhes da revenda
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="nomefantasia">Nome Fantasia*</label>
                    <input value="" type="text" id="nomefantasia" class="form-control" placeholder="Nomeie a revenda" obrigatorio="1">

                    <label for="cnpj">CNPJ*</label>
                    <input value="" type="number" id="cnpj" class="form-control" placeholder="000000000" obrigatorio="1">

                    <label for="razaosocial">Razão Social*</label>
                    <input value="" type="text" id="razaosocial" class="form-control" placeholder="Razão social da revenda" obrigatorio="1">
                    
                    <label for="base">Base</label>
                    <input value="" type="number" id="base" class="form-control" placeholder="000000000">

                    <label for="baseteste">Base Teste</label>
                    <input value="" type="number" id="baseteste" class="form-control" placeholder="000000000">

                    <label for="adesao">Adesão</label>
                    <input value="" type="text" id="adesao" class="form-control" placeholder="000000000">

                    <label for="inscricaoestadual">Inscrição Estadual*</label>
                    <input value="" type="number" id="inscricaoestadual" class="form-control" placeholder="000000000" obrigatorio="1">

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input id="status" type="checkbox">
                            Revenda Ativa
                        </label>
                    </div>
                    <label for="cidade">Cidade*</label>
                    <input value="" type="text" id="cidade" class="form-control" placeholder="Cidade da revenda" obrigatorio="1">

                    <label for="estado">Estado*</label>
                    <select class="form-control show-tick selectpicker" id="estado" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmd1 = "SELECT id, titulo FROM Estado ORDER BY id";
                        $result1 = mysqli_query($link, $cmd1);
                        while ($dados1 = mysqli_fetch_array($result1)) {
                        ?>
                            <option value="<?= $dados1['id']; ?>"><?= $dados1['titulo']; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <label for="responsavel">Responsavel da revenda*</label>
                    <select class="form-control show-tick selectpicker" id="responsavel" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmd2 = "SELECT id, titulo FROM Colaborador WHERE id != '1' ORDER BY id";
                        $result2 = mysqli_query($link, $cmd2);
                        while ($dados2 = mysqli_fetch_array($result2)) {
                        ?>
                            <option value="<?= $dados2['id']; ?>"><?= $dados2['titulo']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="button" id="buttoninserirrevenda" onclick="salvarRevenda()" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarRevenda()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="revenda/revenda.js"></script>
<?php include './footer.php'; ?>