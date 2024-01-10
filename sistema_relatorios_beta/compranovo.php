<?php

require_once './head.php';

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Adicionar Nova Compra</h4>
            <p class="card-description">
                Detalhes da compra
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="descricao">Descrição*</label>
                    <input value="" type="text" id="descricao" class="form-control" placeholder="Descreva a compra" obrigatorio="1">

                    <label for="notafiscal">Nota Fiscal*</label>
                    <input value="" type="number" id="notafiscal" class="form-control" placeholder="" obrigatorio="1">

                    <label for="datacompra">Data da compra*</label>
                    <input value="<?= date('Y-m-d'); ?>" type="date" id="datacompra" class="form-control" obrigatorio="1">

                    <label for="datavencimento">Data Vencimento*</label>
                    <input value="<?= date('Y-m-d'); ?>" type="date" id="datavencimento" class="form-control" obrigatorio="1">

                    <label for="produto">Produto Referente*</label>
                    <select class="form-control show-tick selectpicker" id="produto" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmdproduto = "SELECT id, titulo FROM Produto ORDER BY id";
                        $resultproduto = mysqli_query($link, $cmdproduto);
                        while ($dadosproduto = mysqli_fetch_array($resultproduto)) {
                        ?>
                            <option value="<?= $dadosproduto['id']; ?>"><?= $dadosproduto['titulo']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    
                    <label for="quantidade">Quantidade*</label>
                    <input value="" type="number" id="quantidade" class="form-control" placeholder="" obrigatorio="1">

                    <label for="tabela">Tabela*</label>
                    <select class="form-control show-tick selectpicker" id="tabela" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <option value="1">A vista</option>
                        <option value="15">15 Dias</option>
                        <option value="45">45 Dias</option>
                    </select>

                    <label for="revenda">Revenda*</label>
                    <select class="form-control show-tick selectpicker" id="revenda" obrigatorio="1">
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

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input id="status" type="checkbox">
                            Compra Ativa
                        </label>
                    </div>
                </div>
                <button type="button" id="buttoninserircompra" onclick="salvarCompra()" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarCompra()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="compra/compra.js"></script>
<?php include './footer.php'; ?>