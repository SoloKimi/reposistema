<?php

require_once './head.php';

$idcm = $_POST['idcm'];

if (!$idcm) {
    header('Location: compra.php');
}

$cmd = "SELECT *
        FROM Compra
        WHERE id = '$idcm'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);

$idRevenda = $dados['Revenda_id'];
$idProduto = $dados['Produto_id'];

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Editar Compra</h4>
            <p class="card-description">
                Detalhes da compra
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="descricao">Descrição*</label>
                    <input value="<?= $dados['descricao']; ?>" type="text" id="descricao" class="form-control" placeholder="Descreva a compra" obrigatorio="1">

                    <label for="notafiscal">Nota Fiscal*</label>
                    <input value="<?= $dados['notafiscal']; ?>" type="number" id="notafiscal" class="form-control" placeholder="" obrigatorio="1">

                    <label for="datacompra">Data da compra*</label>
                    <input value="<?= $dados['datacompra']; ?>" type="date" id="datacompra" class="form-control" obrigatorio="1">

                    <label for="datavencimento">Data Vencimento*</label>
                    <input value="<?= $dados['datavencimento']; ?>" type="date" id="datavencimento" class="form-control" obrigatorio="1">

                    <label for="produto">Produto Referente*</label>
                    <select class="form-control show-tick selectpicker" id="produto" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmdproduto = "SELECT id, titulo FROM Produto ORDER BY id";
                        $resultproduto = mysqli_query($link, $cmdproduto);
                        while ($dadosproduto = mysqli_fetch_array($resultproduto)) {
                            $idProdutoAux = $dadosproduto['id'];
                        ?>
                            <option <?php if ($idProdutoAux == $idProduto) { ?> selected="selected" <?php } ?> value="<?= $dadosproduto['id']; ?>"><?= $dadosproduto['titulo']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    
                    <label for="quantidade">Quantidade*</label>
                    <input value="<?= $dados['quantidade']; ?>" type="number" id="quantidade" class="form-control" placeholder="" obrigatorio="1">

                    <label for="tabela">Tabela*</label>
                    <select class="form-control show-tick selectpicker" id="tabela" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <option value="1" <?php if($dados['tabela'] == '1') { ?> selected="selected" <?php } ?>>A vista</option>
                        <option value="15"<?php if($dados['tabela'] == '15') { ?> selected="selected" <?php } ?>>15 Dias</option>
                        <option value="45"<?php if($dados['tabela'] == '45') { ?> selected="selected" <?php } ?>>45 Dias</option>
                    </select>

                    <label for="revenda">Revenda*</label>
                    <select class="form-control show-tick selectpicker" id="revenda">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmd1 = "SELECT id, nomefantasia FROM Revenda ORDER BY id";
                        $result1 = mysqli_query($link, $cmd1);
                        while ($dados1 = mysqli_fetch_array($result1)) {
                            $idRevendaAux = $dados1['id'];
                        ?>
                            <option <?php if ($idRevendaAux == $idRevenda) { ?> selected="selected" <?php } ?> value="<?= $dados1['id']; ?>"><?= $dados1['nomefantasia']; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input <?php if ($dados['status'] == 1) { ?> checked="checked" <?php } elseif ($dados['status'] == 2) { ?> checked="checked" disabled <?php } ?> id="status" type="checkbox">
                            Compra Ativa
                        </label>
                    </div>
                </div>
                <button type="button" id="buttoninserircompra" onclick="alterarCompra(<?= $idcm; ?>)" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarCompra()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="compra/compra.js"></script>
<?php include './footer.php'; ?>