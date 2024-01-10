<?php

require_once './head.php';

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Novo Colaborador</h4>
            <p class="card-description">
                Detalhes do colaborador
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <div class="col-md-6">
                    <label for="titulo">Nome*</label>
                    <input value="" type="text" id="titulo" class="form-control" placeholder="Nomeie o colaborador" obrigatorio="1">
                    </div>
                    <div class="col-md-6">
                    <label for="email">Email*</label>
                    <input value="" type="text" id="email" class="form-control" placeholder="colaborador@exemplo.com" obrigatorio="1">
                    </div>
                    <label for="telefone">Telefone/Celular*</label>
                    <input value="" type="number" id="telefone" class="form-control" placeholder="00000000000000" obrigatorio="1">
                    <label for="cpf">CPF*</label>
                    <input value="" type="number" id="cpf" class="form-control" placeholder="000000000" obrigatorio="1">
                    <label for="tipo">Colaborador adiministrador?*</label>
                    <select class="form-control show-tick selectpicker" id="tipo">
                        <option value="10">[Selecione]</option>
                        <option selected value="0">Colaborador</option>
                        <option value="1">Adiministrador</option>
                    </select>
                    <label for="usuario">Usuário*</label>
                    <input value="" type="text" id="usuario" class="form-control" placeholder="ExemploUser" obrigatorio="1">
                    <label for="senha">Senha*</label>
                    <input value="" type="password" id="senha" class="form-control" placeholder="" obrigatorio="1">
                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input id="status" type="checkbox">
                            Colaborador Ativo
                        </label>
                    </div>
                    <label for="revenda">Revenda*</label>
                    <select class="form-control show-tick selectpicker" id="revenda">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmdrevenda = "SELECT id, nomefantasia FROM Revenda ORDER BY id";
                        $resultrevenda = mysqli_query($link, $cmdrevenda);
                        while ($dadorevenda = mysqli_fetch_array($resultrevenda)) {
                        ?>
                            <option value="<?= $dadorevenda['id']; ?>"><?= $dadorevenda['nomefantasia']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="button" id="buttoninserircolaborador" onclick="salvarColaborador()" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarColaborador()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="colaborador/colaborador.js"></script>
<script type="text/javascript">                                                            
    $(document).ready(function () {
        $("#telefone").inputmask("mask", {mask: ['(99)99999-9999', '(99)9999-9999']});
    });
</script>
<?php include './footer.php'; ?>