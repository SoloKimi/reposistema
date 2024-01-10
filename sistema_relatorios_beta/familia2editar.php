<?php

require_once './head.php';

$idf2 = $_POST['idf2'];

if (!$idf2) {
    header('Location: familia2.php');
}

$cmd = "SELECT *
        FROM Familia2
        WHERE id = '$idf2'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);
?>
<script src="familia2/familia2.js"></script>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Alterar Família 2</h4>
            <p class="card-description">
                Detalhes da família 2
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título*</label>
                    <input value="<?= $dados['titulo']; ?>" type="text" id="titulo" class="form-control" placeholder="Título da Familia 2" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                    <input <?php if($dados['status'] == 1){ ?> checked="checked" <?php } elseif($dados['status'] == 2){ ?> checked="checked" disabled <?php } ?> id="status" type="checkbox">
                        Familia 2 Ativa
                    </label>
                </div>
                </div>
                <button type="button" id="buttonalterarfamilia2" onclick="alterarFamilia2(<?= $idf2; ?>)" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarFamilia2()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<?php include './footer.php'; ?>