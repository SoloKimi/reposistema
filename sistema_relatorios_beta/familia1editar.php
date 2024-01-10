<?php

require_once './head.php';

$idf1 = $_POST['idf1'];

if (!$idf1) {
    header('Location: familia1.php');
}

$cmd = "SELECT *
        FROM Familia1
        WHERE id = '$idf1'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);
?>
<script src="familia1/familia1.js"></script>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Alterar Família 1</h4>
            <p class="card-description">
                Detalhes da família 1
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título*</label>
                    <input value="<?= $dados['titulo']; ?>" type="text" id="titulo" class="form-control" placeholder="Título da Familia" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                    <input <?php if($dados['status'] == 1){ ?> checked="checked" <?php } elseif($dados['status'] == 2){ ?> checked="checked" disabled <?php } ?> id="status" type="checkbox">
                        Familia 1 Ativa
                    </label>
                </div>
                </div>
                <button type="button" id="buttonalterarfamilia1" onclick="alterarFamilia1(<?= $idf1; ?>)" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarFamilia1()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<?php include './footer.php'; ?>