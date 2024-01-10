<?php

require_once './head.php';

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Criar Novo Tipo Peso</h4>
            <p class="card-description">
                Detalhes do Tipo Peso
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título*</label>
                    <input value="" type="text" id="titulo" class="form-control" placeholder="Título do Tipo Peso" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input id="status" type="checkbox">
                        Tipo Peso Ativo
                    </label>
                </div>
                </div>
                <button type="button" id="buttoninserirtipopeso" onclick="salvarTipoPeso()" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionartipopeso()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="tipopeso/tipopeso.js"></script>
<?php include './footer.php'; ?>