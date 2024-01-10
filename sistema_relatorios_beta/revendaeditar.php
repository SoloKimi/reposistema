<?php

require_once './head.php';

$idr = $_POST['idr'];

if (!$idr) {
    header('Location: revenda.php');
}

$cmd = "SELECT *
        FROM Revenda
        WHERE id = '$idr'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);

$idEstado = $dados['Estado_id'];
$idColaborador = $dados['Colaborador_id'];

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Editar Revenda/Distribuidora</h4>
            <p class="card-description">
                Detalhes da revenda
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="nomefantasia">Nome Fantasia*</label>
                    <input value="<?= $dados['nomefantasia']; ?>" type="text" id="nomefantasia" class="form-control" placeholder="Nomeie a revenda" obrigatorio="1">
                    
                    <label for="cnpj">CNPJ*</label>
                    <input value="<?= $dados['cnpj']; ?>" type="number" id="cnpj" class="form-control" placeholder="000000000" obrigatorio="1">
                    
                    <label for="razaosocial">Razão Social*</label>
                    <input value="<?= $dados['razaosocial']; ?>" type="text" id="razaosocial" class="form-control" placeholder="Razão social da revenda" obrigatorio="1">
                    
                    <label for="base">Base</label>
                    <input value="<?= $dados['base']; ?>" type="number" id="base" class="form-control" placeholder="000000000">
                    
                    <label for="baseteste">Base Teste</label>
                    <input value="<?= $dados['baseteste']; ?>" type="number" id="baseteste" class="form-control" placeholder="000000000">

                    <label for="adesao">Adesão</label>
                    <input value="<?= $dados['adesao']; ?>" type="text" id="adesao" class="form-control" placeholder="000000000">

                    <label for="inscricaoestadual">Inscrição Estadual*</label>
                    <input value="<?= $dados['inscricaoestadual']; ?>" type="number" id="inscricaoestadual" class="form-control" placeholder="000000000" obrigatorio="1">

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input <?php if ($dados['status'] == 1) { ?> checked="checked" <?php } elseif ($dados['status'] == 2) { ?> checked="checked" disabled <?php } ?> id="status" type="checkbox">
                            Revenda/Distribuidora Ativa
                        </label>
                    </div>
                    <label for="cidade">Cidade*</label>
                    <input value="<?= $dados['cidade']; ?>" type="text" id="cidade" class="form-control" placeholder="Cidade da revenda" obrigatorio="1">
                    <label for="estado">Estado*</label>
                    <select class="form-control show-tick selectpicker" id="estado">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmd1 = "SELECT id, titulo FROM Estado ORDER BY id";
                        $result1 = mysqli_query($link, $cmd1);
                        while ($dados1 = mysqli_fetch_array($result1)) {
                            $idEstadoAux = $dados1['id'];
                        ?>
                            <option <?php if ($idEstadoAux == $idEstado) { ?> selected="selected" <?php } ?> value="<?= $dados1['id']; ?>"><?= $dados1['titulo']; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <label for="responsavel">Responsavel da revenda*</label>
                    <select class="form-control show-tick selectpicker" id="responsavel" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmd2 = "SELECT id, titulo FROM Colaborador ORDER BY id";
                        $result2 = mysqli_query($link, $cmd2);
                        while ($dados2 = mysqli_fetch_array($result2)) {
                            $idResponsavelAux = $dados2['id'];
                        ?>
                            <option <?php if ($idResponsavelAux == $idColaborador) { ?> selected="selected" <?php } ?> value="<?= $dados2['id']; ?>"><?= $dados2['titulo']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="button" id="buttonalterarrevenda" onclick="alterarRevenda(<?= $idr; ?>)" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarRevenda()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="revenda/revenda.js"></script>
<?php include './footer.php'; ?>