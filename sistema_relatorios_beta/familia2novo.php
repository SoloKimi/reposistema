<?php

require_once './head.php';

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Criar família 2</h4>
            <p class="card-description">
                Detalhes da família 2
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título da Familia 2*</label>
                    <input value="" type="text" id="titulo" class="form-control" placeholder="Título da Família 2" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input id="status" type="checkbox">
                        Família Ativa
                    </label>
                </div>
                </div>
                <button type="button" id="buttoninserirfamilia2" onclick="salvarFamilia2()" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarFamilia2()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="familia2/familia2.js"></script>
<?php include './footer.php'; ?>