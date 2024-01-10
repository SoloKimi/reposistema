<?php

require_once './head.php';

?>

<script src="produto/produto.js"></script>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title" style="font-size:30px;">Pesquisar produtos</h2>
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-between align-items-center row row-cols-10 form-group">
                    <label for="pesquisatitulo">Titulo</label>
                    <input value="" type="text" id="pesquisatitulo" class="form-control" placeholder="Titulo do produto">
                </div>


                <div class="d-flex justify-content-between align-items-center row row-cols-10 form-group">
                    <label for="pesquisacategoria">Categoria*</label>
                    <select class="form-control show-tick selectpicker" id="pesquisacategoria">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmdcategoriap = "SELECT id, titulo FROM Categoria ORDER BY id";
                        $resultcategoriap = mysqli_query($link, $cmdcategoriap);
                        while ($dadoscategoriap = mysqli_fetch_array($resultcategoriap)) {
                        ?>
                            <option value="<?= $dadoscategoriap['id']; ?>"><?= $dadoscategoriap['titulo']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center form-group row row-cols-10: auto !important">
                    <label for="pesquisaembalagem">Embalagem*</label>
                    <select class="form-control show-tick selectpicker" id="pesquisaembalagem">
                        <option value="0">[Selecione]</option>
                        <?php
                        $cmdembalagemp = "SELECT id, titulo FROM Embalagem ORDER BY id";
                        $resultembalagemp = mysqli_query($link, $cmdembalagemp);
                        while ($dadosembalagemp = mysqli_fetch_array($resultembalagemp)) {
                        ?>
                            <option value="<?= $dadosembalagemp['id']; ?>"><?= $dadosembalagemp['titulo']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" onclick="buscarProduto()" class="btn btn-primary">Pesquisar</button>
        </div>
    </div>
</div>
<div id="divprodutopadrao" class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title" style="font-size:30px;">Produto</h2>
                <div class="add-items d-flex mb-0">
                    <a href="./produtonovo.php">
                        <button type="button" class="btn btn-primary">Novo produto</button>
                    </a>
                </div>
            </div>
            <p class="card-description">
                Tabela de<code>Produto</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 50%;text-align: center">Título</th>
                            <th style="width: 15%;text-align: center">Peso</th>
                            <th style="width: 10%;text-align: center">Código</th>
                            <th style="width: 15%;text-align: center">Categoria/Familia</th>
                            <th style="width: 10%;text-align: center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $selectPesquisa = "SELECT * FROM Produto ORDER BY titulo";
                        $selectExportar = "SELECT p.titulo as Produto, p.peso, tp.titulo as TipoPeso, p.valorunitario, p.paletizacao, p.lastro, p.codigo, p.codigofabricante, p.descricao, f1.titulo as Familia1, f2.titulo as Familia2, e.titulo as Embalagem, c.titulo as Categoria, col.titulo as Colaborador FROM Produto p LEFT JOIN TipoPeso tp ON p.TipoPeso_id = tp.id LEFT JOIN Familia1 f1 ON p.Familia1_id = f1.id LEFT JOIN Familia2 f2 ON p.Familia2_id = f2.id LEFT JOIN Embalagem e ON p.Embalagem_id = e.id LEFT JOIN Categoria c ON p.Categoria_id = c.id LEFT JOIN Colaborador col ON p.Colaborador_id = col.id";
                        $cmd = 'asda';
                        $result = mysqli_query($link, $selectPesquisa);
                        while ($dados = mysqli_fetch_array($result)) {

                            $idtipoPeso = $dados["TipoPeso_id"];
                            $idcategoria = $dados["Categoria_id"];

                            //verificar tipo do peso
                            $cmdtipopeso = "SELECT * FROM TipoPeso WHERE id = '$idtipoPeso'";
                            $resulttipopeso = mysqli_query($link, $cmdtipopeso);
                            $dadostipopeso = mysqli_fetch_array($resulttipopeso);

                            //verificar categoria/familia
                            $cmdcategoria = "SELECT * FROM Categoria WHERE id = '$idcategoria'";
                            $resultcategoria = mysqli_query($link, $cmdcategoria);
                            $dadoscategoria = mysqli_fetch_array($resultcategoria);
                        ?>
                            <tr>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idpro').val(<?= $dados['id']; ?>);
                                          $('#formProduto').submit();">
                                    <?= $dados['titulo']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idpro').val(<?= $dados['id']; ?>);
                                          $('#formProduto').submit();">
                                    <?= $dados['peso']; ?> - <?= $dadostipopeso['titulo']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idpro').val(<?= $dados['id']; ?>);
                                          $('#formProduto').submit();">
                                    <?= $dados['codigo']; ?>
                                </td>
                                <td style="text-align: center; cursor: pointer" onclick="$('#idpro').val(<?= $dados['id']; ?>);
                                          $('#formProduto').submit();">
                                    <?= $dadoscategoria['titulo']; ?>
                                </td>
                                <td>
                                    <button type="button" onclick="$('#idpro').val(<?= $dados['id']; ?>); $('#formProduto').submit();" class="btn btn-outline-warning btn-fw">Alterar</button>
                                    <?php
                                    if ($dados['status'] != 2) {
                                    ?>
                                        <button type="button" onclick="excluirProduto(<?= $dados['id']; ?>)" class="btn btn-outline-danger btn-fw">Excluir</button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="add-items d-flex mb-0">
                <button type="button" onclick="exportarProduto()" class="btn btn-success">Exportar</button>
            </div>
        </div>
    </div>
</div>


<div id="divresultadoproduto">

</div>


<form action="produtoeditar.php" method="POST" id="formProduto">
    <input type="hidden" value="" id="idpro" name="idpro">
</form>
<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<?php require_once "footer.php"; ?>