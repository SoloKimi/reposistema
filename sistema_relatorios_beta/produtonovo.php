<?php

require_once './head.php';

?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Adicionar Novo Produto</h4>
            <p class="card-description">
                Detalhes da produto
            </p>
            <form class="forms-sample">
                <div class="form-group">
                    <label for="titulo">Título*</label>
                    <input value="" type="text" id="titulo" class="form-control" placeholder="Titulo do produto" obrigatorio="1">
                    <label for="peso">Peso*</label>
                    <input value="" type="number" id="peso" class="form-control" placeholder="" obrigatorio="1">
                    <label for="tipopeso">Tipo do peso*</label>
                    <select class="form-control show-tick selectpicker" id="tipopeso" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmdtipopeso0 = "SELECT id, titulo FROM TipoPeso WHERE status != '0' ORDER BY id";
                        $resulttipopeso0 = mysqli_query($link, $cmdtipopeso0);
                        while ($dadotipopeso0 = mysqli_fetch_array($resulttipopeso0)) {
                        ?>
                            <option value="<?= $dadotipopeso0['id']; ?>"><?= $dadotipopeso0['titulo']; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <label for="valorunitario">Valor Unitário</label>
                    <input value="" type="number" id="valorunitario" class="form-control">

                    <label for="paletizacao">Paletização</label>
                    <input value="" type="text" id="paletizacao" class="form-control">

                    <label for="lastro">Lastro</label>
                    <input value="" type="text" id="lastro" class="form-control">

                    <label for="codigo">Código*</label>
                    <input value="" type="text" id="codigo" class="form-control" obrigatorio="1">

                    <label for="codigofabricante">Código do Fabricante*</label>
                    <input value="" type="text" id="codigofabricante" class="form-control" obrigatorio="1">

                    <label for="descricao">Descrição</label>
                    <input value="" type="textarea" id="descricao" class="form-control">

                    <label for="embalagem">Embalagem*</label>
                    <select class="form-control show-tick selectpicker" id="embalagem" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmdembalagem = "SELECT id, titulo FROM Embalagem WHERE status != '0' ORDER BY id";
                        $resultembalagem = mysqli_query($link, $cmdembalagem);
                        while ($dadoembalagem = mysqli_fetch_array($resultembalagem)) {
                        ?>
                            <option value="<?= $dadoembalagem['id']; ?>"><?= $dadoembalagem['titulo']; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <label for="categoria">Categoria*</label>
                    <select class="form-control show-tick selectpicker" id="categoria" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmdcategoria = "SELECT id, titulo FROM Categoria WHERE status != '0' ORDER BY id";
                        $resultcategoria = mysqli_query($link, $cmdcategoria);
                        while ($dadoscategoria = mysqli_fetch_array($resultcategoria)) {
                        ?>
                            <option value="<?= $dadoscategoria['id']; ?>"><?= $dadoscategoria['titulo'];?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <label for="familia1">Família 1*</label>
                    <select class="form-control show-tick selectpicker" id="familia1" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmdfamilia1 = "SELECT id, titulo FROM Familia1 WHERE status != '0' ORDER BY id";
                        $resultfamilia1 = mysqli_query($link, $cmdfamilia1);
                        while ($dadosfamilia1 = mysqli_fetch_array($resultfamilia1)) {
                        ?>
                            <option value="<?= $dadosfamilia1['id']; ?>"><?= $dadosfamilia1['titulo'];?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <label for="familia2">Família 2*</label>
                    <select class="form-control show-tick selectpicker" id="familia2" obrigatorio="1">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmdfamilia2 = "SELECT id, titulo FROM Familia2 WHERE status != '0' ORDER BY id";
                        $resultfamilia2 = mysqli_query($link, $cmdfamilia2);
                        while ($dadosfamilia2 = mysqli_fetch_array($resultfamilia2)) {
                        ?>
                            <option value="<?= $dadosfamilia2['id']; ?>"><?= $dadosfamilia2['titulo'];?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input id="status" type="checkbox">
                            Produto Ativo
                        </label>
                    </div>
                </div>
                <button type="button" id="buttoninserirproduto" onclick="salvarProduto()" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="redirecionarProduto()">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<script src="produto/produto.js"></script>
<?php include './footer.php'; ?>