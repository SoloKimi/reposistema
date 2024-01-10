<?php

require_once './head.php';

$ide = $_POST['ide'];

if (!$ide) {
    header('Location: tipopeso.php');
}

$cmd = "SELECT *
        FROM Embalagem
        WHERE id = '$ide'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);
?>
<script src="embalagem/embalagem.js"></script>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Alterar Embalagem</h4>
            <p class="card-description">
                Detalhes da Embalagem
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título*</label>
                    <input value="<?= $dados['titulo']; ?>" type="text" id="titulo" class="form-control" placeholder="Título da embalagem" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                    <label for="titulo">Tipo*</label>
                    <input value="<?= $dados['tipo']; ?>" type="text" id="tipo" class="form-control" placeholder="Tipo da embalagem" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input <?php if ($dados['status'] == 1) { ?> checked="checked" <?php }elseif($dados['status']== 2){?> checked="checked" disabled <?php } ?> id="status" type="checkbox">
                        Embalagem Ativa
                    </label>
                </div>
                </div>
                <button type="button" id="buttonalterarembalagem" onclick="alterarEmbalagem(<?= $ide; ?>)" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarembalagem()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<?php include './footer.php'; ?>