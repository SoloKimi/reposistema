<?php

require_once './head.php';

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Criar Relatório de Perguntas</h4>
            <p class="card-description">
                Detalhes da relatório perguntas
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título*</label>
                    <input value="" type="text" id="titulo" class="form-control" placeholder="Título da Relatorio Perguntas" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input id="status" type="checkbox">
                            Relatório Perguntas Ativo
                        </label>
                    </div>

                    <div class="d-flex row row-cols-6 form-group">
                        <label for="datalimite">Data Limite*</label>
                        <input value="<?= date('Y-m-d'); ?>" type="date" id="datalimite" class="form-control" obrigatorio="1">
                    </div>

                </div>
                <button type="button" id="buttoninserirrelatorioperguntas" onclick="salvarRelatorioPerguntas()" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarRelatorioPerguntas()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="relatorioperguntas/relatorioperguntas.js"></script>

<form action="relatorioperguntaseditar.php" method="POST" id="formRelatorioPerguntas">
    <input type="hidden" value="" id="idrp" name="idrp">
</form>
<?php include './footer.php'; ?>