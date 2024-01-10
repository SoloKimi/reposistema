<?php

require_once '../conexao_banco.php';

?>

<div class="col-lg-12 grid-margin stretch-card">
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
                        // $pesquisa = $mysqli->real_escape_string($_POST['pesquisatitulo']);
                        $pesquisatitulo = $_POST['pesquisatitulo'];
                        $pesquisacategoria = $_POST['pesquisacategoria'];
                        $pesquisaembalagem = $_POST['pesquisaembalagem'];

                        // Inicializa a condição da consulta SQL
                        $whereConditions = array();
                        $whereConditionsExport = array();

                        // Adiciona condição para o título
                        if ($pesquisatitulo != '') {
                            $whereConditions[] = "titulo LIKE '%$pesquisatitulo%'";
                            $whereConditionsExport[] = "p.titulo LIKE '/%$pesquisatitulo/%'";
                        }

                        // Adiciona condição para a categoria
                        if ($pesquisacategoria != '0') {
                            $whereConditions[] = "Categoria_id = '$pesquisacategoria'";
                            $whereConditionsExport[] = "p.Categoria_id = '$pesquisacategoria'";
                        }

                        // Adiciona condição para a embalagem
                        if ($pesquisaembalagem != '0') {
                            $whereConditions[] = "Embalagem_id = '$pesquisaembalagem'";
                            $whereConditionsExport[] = "p.Embalagem_id = '$pesquisaembalagem'";
                        }

                        // Monta a consulta SQL completa
                        $selectPesquisa = "SELECT * FROM Produto";
                        $selectExportar = "SELECT p.titulo as Produto, p.peso, p.TipoPeso_id, tp.titulo as TipoPeso, p.valorunitario, p.paletizacao, p.lastro, p.codigo, p.codigofabricante, p.descricao, p.Familia1_id, f1.titulo as Familia1, p.Familia2_id, f2.titulo as Familia2, p.Embalagem_id, e.titulo as Embalagem, p.Categoria_id, c.titulo as Categoria, p.Colaborador_id, col.titulo as Colaborador
                                                FROM Produto p
                                                LEFT JOIN TipoPeso tp ON p.TipoPeso_id = tp.id
                                                LEFT JOIN Familia1 f1 ON p.Familia1_id = f1.id
                                                LEFT JOIN Familia2 f2 ON p.Familia2_id = f2.id
                                                LEFT JOIN Embalagem e ON p.Embalagem_id = e.id
                                                LEFT JOIN Categoria c ON p.Categoria_id = c.id
                                                LEFT JOIN Colaborador col ON p.Colaborador_id = col.id";

                        // Adiciona a cláusula WHERE se houver condições
                        if (!empty($whereConditions)) {
                            $whereClause = implode(' AND ', $whereConditions);
                            $selectPesquisa .= " WHERE $whereClause";

                            $whereClauseExport = implode(' AND ', $whereConditionsExport);
                            $selectExportar .= " WHERE $whereClauseExport";
                            $exportar = " WHERE $whereClauseExport";
                        }

                        $selectPesquisa .= " ORDER BY id";
                        $selectExportar .= " ORDER BY p.id";


                        $resultpesquisa = mysqli_query($link, $selectPesquisa);
                        $row_pesquisa = mysqli_num_rows($resultpesquisa);
                        if ($row_pesquisa > 0) {
                            while ($dadospesquisa = mysqli_fetch_array($resultpesquisa)) {

                                $idtipoPeso = $dadospesquisa["TipoPeso_id"];
                                $idcategoria = $dadospesquisa["Categoria_id"];

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
                                    <td style="text-align: center; cursor: pointer" onclick="$('#idpro').val(<?= $dadospesquisa['id']; ?>);
                                          $('#formProduto').submit();">
                                        <?= $dadospesquisa['titulo']; ?>
                                    </td>
                                    <td style="text-align: center; cursor: pointer" onclick="$('#idpro').val(<?= $dadospesquisa['id']; ?>);
                                          $('#formProduto').submit();">
                                        <?= $dadospesquisa['peso']; ?> - <?= $dadostipopeso['titulo']; ?>
                                    </td>
                                    <td style="text-align: center; cursor: pointer" onclick="$('#idpro').val(<?= $dadospesquisa['id']; ?>);
                                          $('#formProduto').submit();">
                                        <?= $dadospesquisa['codigo']; ?>
                                    </td>
                                    <td style="text-align: center; cursor: pointer" onclick="$('#idpro').val(<?= $dadospesquisa['id']; ?>);
                                          $('#formProduto').submit();">
                                        <?= $dadoscategoria['titulo']; ?>
                                    </td>
                                    <td>
                                        <button type="button" onclick="$('#idpro').val(<?= $dadospesquisa['id']; ?>); $('#formProduto').submit();" class="btn btn-outline-warning btn-fw">Alterar</button>
                                        <?php
                                        if ($dadospesquisa['status'] != 2) {
                                        ?>
                                            <button type="button" onclick="excluirProduto(<?= $dadospesquisa['id']; ?>)" class="btn btn-outline-danger btn-fw">Excluir</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td coldspan="5" style="text-align: center;">
                                    Produto não encontrado...
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
                <div class="add-items d-flex mb-0">
                <button type="button" onclick="exportarProdutoPesquisa()" class="btn btn-success">Exportar</button>
                </div>
            </div>
        </div>
    </div>
</div>