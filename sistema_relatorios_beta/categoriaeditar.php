<?php

require_once './head.php';

$idc = $_POST['idc'];

if (!$idc) {
    header('Location: categoria.php');
}

$cmd = "SELECT *
        FROM Categoria
        WHERE id = '$idc'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);
?>
<script src="categoria/categoria.js"></script>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Alterar Categoria</h4>
            <p class="card-description">
                Detalhes da categoria
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título*</label>
                    <input value="<?= $dados['titulo']; ?>" type="text" id="titulo" class="form-control" placeholder="Título da Categoria" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                    <input <?php if ($dados['status'] == 1) { ?> checked="checked" <?php } elseif ($dados['status'] == 2) { ?> checked="checked" disabled <?php } ?> id="status" type="checkbox">
                        Categoria Ativa
                    </label>
                </div>
                </div>
                <button type="button" id="buttonalterarcategoria" onclick="alterarCategoria(<?= $idc; ?>)" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarcategoria()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<?php include './footer.php'; ?>