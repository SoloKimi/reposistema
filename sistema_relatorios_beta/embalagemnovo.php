<?php

require_once './head.php';

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Criar Nova Embalagem</h4>
            <p class="card-description">
                Detalhes da Embalagem
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título*</label>
                    <input value="" type="text" id="titulo" class="form-control" placeholder="Título da embalagem" obrigatorio="1">
                    <label for="titulo">Tipo*</label>
                    <input value="" type="text" id="tipo" class="form-control" placeholder="Tipo da embalagem" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input id="status" type="checkbox">
                        Embalagem Ativa
                    </label>
                </div>
                </div>
                <button type="button" id="buttoninserirembalagem" onclick="salvarEmbalagem()" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarembalagem()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="embalagem/embalagem.js"></script>
<?php include './footer.php'; ?>