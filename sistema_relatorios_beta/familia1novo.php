<?php

require_once './head.php';

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Criar Família 1</h4>
            <p class="card-description">
                Detalhes da familia 1
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título*</label>
                    <input value="" type="text" id="titulo" class="form-control" placeholder="Título da Familía 1" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input id="status" type="checkbox">
                        Familía Ativa
                    </label>
                </div>
                </div>
                <button type="button" id="buttoninserirfamilia1" onclick="salvarFamilia1()" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarFamilia1()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="familia1/familia1.js"></script>
<?php include './footer.php'; ?>