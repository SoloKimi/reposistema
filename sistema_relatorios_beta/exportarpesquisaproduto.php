<?php

require_once './conexao_banco.php';
$tipo = 'produto';
// $pesquisa = $mysqli->real_escape_string($_POST['pesquisatitulo']);
$pesquisatitulo = $_POST['pesquisatitulo'];
$pesquisacategoria = $_POST['pesquisacategoria'];
$pesquisaembalagem = $_POST['pesquisaembalagem'];

// Inicializa a condição da consulta SQL
$whereConditionsExport = array();

// Adiciona condição para o título
if ($pesquisatitulo != '') {
$whereConditionsExport[] = "p.titulo LIKE '%$pesquisatitulo%'";
}

// Adiciona condição para a categoria
if ($pesquisacategoria != '0') {
$whereConditionsExport[] = "p.Categoria_id = '$pesquisacategoria'";
}

// Adiciona condição para a embalagem
if ($pesquisaembalagem != '0') {
$whereConditionsExport[] = "p.Embalagem_id = '$pesquisaembalagem'";
}

// Monta a consulta SQL completa
$selectExportar = "SELECT p.titulo as Produto, p.peso, tp.titulo as TipoPeso, p.valorunitario, p.paletizacao, p.lastro, p.codigo, p.codigofabricante, p.descricao, f1.titulo as Familia1, f2.titulo as Familia2, e.titulo as Embalagem, c.titulo as Categoria, col.titulo as Colaborador
                    FROM Produto p
                    LEFT JOIN TipoPeso tp ON p.TipoPeso_id = tp.id
                    LEFT JOIN Familia1 f1 ON p.Familia1_id = f1.id
                    LEFT JOIN Familia2 f2 ON p.Familia2_id = f2.id
                    LEFT JOIN Embalagem e ON p.Embalagem_id = e.id
                    LEFT JOIN Categoria c ON p.Categoria_id = c.id
                    LEFT JOIN Colaborador col ON p.Colaborador_id = col.id";

// Adiciona a cláusula WHERE se houver condições
if (!empty($whereConditionsExport)) {

$whereClauseExport = implode(' AND ', $whereConditionsExport);
$selectExportar .= " WHERE $whereClauseExport";
$exportar = " WHERE $whereClauseExport";
}

$selectExportar .= " ORDER BY p.id";


$result = mysqli_query($link, $selectExportar);

$data = date('Ymdhis');

// CSV file name => importar.csv 
$filename = 'export/'.$tipo.'_'.$data.'.csv'; 
$namefilereturn = $tipo.'_'.$data.'.csv';
   
// File pointer in writable mode 
$file_pointer = fopen($filename, 'w'); 

// Adicione isso antes de escrever no arquivo
fwrite($file_pointer, "\xEF\xBB\xBF");

// $result = mysqli_query($link, $select);

$headers = $result->fetch_fields();
foreach($headers as $header) {
    if($header->name == null){
        $head[] = '-';
    }else{
        $head[] = $header->name;
    }
   
}

if ($file_pointer && $result) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($file_pointer, array_values($head)); 
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($file_pointer, array_values($row));
    }
    // Close the file pointer. 
    fclose($file_pointer); 
}

echo $namefilereturn;
