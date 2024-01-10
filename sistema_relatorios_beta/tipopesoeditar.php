<?php

require_once './head.php';

$idtp = $_POST['idtp'];

if (!$idtp) {
    header('Location: tipopeso.php');
}

$cmd = "SELECT *
        FROM TipoPeso
        WHERE id = '$idtp'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);
?>
<script src="tipopeso/tipopeso.js"></script>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Alterar Tipo Peso</h4>
            <p class="card-description">
                Detalhes do Tipo Peso
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título*</label>
                    <input value="<?= $dados['titulo']; ?>" type="text" id="titulo" class="form-control" placeholder="Título do tipo peso" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                    <input <?php if ($dados['status'] == 1) { ?> checked="checked" <?php } elseif ($dados['status'] == 2) { ?> checked="checked" disabled <?php } ?> id="status" type="checkbox">
                        Tipo Peso Ativo
                    </label>
                </div>
                </div>
                <button type="button" id="buttonalterartipopeso" onclick="alterarTipoPeso(<?= $idtp; ?>)" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionartipopeso()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<?php include './footer.php'; ?>