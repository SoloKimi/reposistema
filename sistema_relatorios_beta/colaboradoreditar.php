<?php

require_once './head.php';

$idcol = $_POST['idcol'];

if (!$idcol) {
    header('Location: colaborador.php');
}

$cmd = "SELECT *
        FROM Colaborador
        WHERE id = '$idcol'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);

$idRevenda = $dados['Revenda_id'];

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Editar Colaborador</h4>
            <p class="card-description">
                Detalhes do colaborador
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Nome*</label>
                    <input value="<?= $dados['titulo']; ?>" type="text" id="titulo" class="form-control" placeholder="Nomeie o colaborador" obrigatorio="1">
                    <label for="email">Email*</label>
                    <input value="<?= $dados['email']; ?>" type="text" id="email" class="form-control" placeholder="colaborador@exemplo.com" obrigatorio="1">
                    <label for="telefone">Telefone/Celular*</label>
                    <input value="<?= $dados['telefone']; ?>" type="number" id="telefone" class="form-control" placeholder="00000000000000" obrigatorio="1">
                    <label for="cpf">CPF*</label>
                    <input value="<?= $dados['cpf']; ?>" type="number" id="cpf" class="form-control" placeholder="000000000" obrigatorio="1">
                    <label for="tipo">Colaborador adiministrador?*</label>
                    <select class="form-control show-tick selectpicker" id="tipo">
                        <option value="10" <?php if ($dados['tipo'] == 10) { ?> selected="selected" <?php } ?>>[Selecione]</option>
                        <option value="0" <?php if ($dados['tipo'] == 0) { ?> selected="selected" <?php } ?>>Colaborador</option>
                        <option value="1" <?php if ($dados['tipo'] == 1) { ?> selected="selected" <?php } ?>>Adiministrador</option>
                    </select>
                    <label for="usuario">Usuário</label>
                    <input value="<?= $dados['usuario']; ?>" type="text" id="usuario" class="form-control" placeholder="ExemploUser">
                    <label for="senha">Senha</label>
                    <input value="<?= $dados['senha']; ?>" type="password" id="senha" class="form-control" placeholder="">
                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input <?php if ($dados['status'] == 1) { ?> checked="checked" <?php } elseif ($dados['status'] == 2) { ?> checked="checked" disabled <?php } ?> id="status" type="checkbox">
                            Colaborador Ativo
                        </label>
                    </div>
                    <label for="revenda">Revenda*</label>
                    <select class="form-control show-tick selectpicker" id="revenda">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmd1 = "SELECT id, nomefantasia FROM Revenda ORDER BY id";
                        $result1 = mysqli_query($link, $cmd1);
                        while ($dados1 = mysqli_fetch_array($result1)) {
                            $idRevendaAux = $dados1['id'];
                        ?>
                            <option <?php if ($idRevendaAux == $idRevenda) { ?> selected="selected" <?php } ?> value="<?= $dados1['id']; ?>"><?= $dados1['nomefantasia']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="button" id="buttoninserircolaborador" onclick="alterarColaborador(<?= $idcol; ?>)" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarColaborador()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="colaborador/colaborador.js"></script>
<?php include './footer.php'; ?>