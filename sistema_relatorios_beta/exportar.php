<?php

require_once './conexao_banco.php';
$tipo = $_POST['tipo'];
// $where = $_POST['where'];
if($tipo == 'compra'){
    $select = "SELECT c.quantidade as quantidade, c.descricao, date_format(c.datacompra, '%d/%m/%Y') as datacompra, date_format(c.datavencimento, '%d/%m/%Y') as vencimento, c.notafiscal, r.nomefantasia as Revenda, p.titulo as Produto FROM Compra c LEFT JOIN Revenda r ON c.Revenda_id = r.id LEFT JOIN Produto p ON c.Produto_id = p.id ";
}elseif($tipo == ''){
    $select = "SELECT p.titulo as Produto, p.peso, p.TipoPeso_id, tp.titulo as TipoPeso, p.valorunitario, p.paletizacao, p.lastro, p.codigo, p.codigofabricante, p.descricao, p.Familia1_id, f1.titulo as Familia1, p.Familia2_id, f2.titulo as Familia2, p.Embalagem_id, e.titulo as Embalagem, p.Categoria_id, c.titulo as Categoria, p.Colaborador_id, col.titulo as Colaborador
    FROM Produto p
    LEFT JOIN TipoPeso tp ON p.TipoPeso_id = tp.id
    LEFT JOIN Familia1 f1 ON p.Familia1_id = f1.id
    LEFT JOIN Familia2 f2 ON p.Familia2_id = f2.id
    LEFT JOIN Embalagem e ON p.Embalagem_id = e.id
    LEFT JOIN Categoria c ON p.Categoria_id = c.id
    LEFT JOIN Colaborador col ON p.Colaborador_id = col.id";
}else{
    $select = $_POST['select'];
}

$data = date('Ymdhis');

// CSV file name => importar.csv 
$filename = 'export/'.$tipo.'_'.$data.'.csv'; 
$namefilereturn = $tipo.'_'.$data.'.csv';
   
// File pointer in writable mode 
$file_pointer = fopen($filename, 'w'); 

// Adicione isso antes de escrever no arquivo
fwrite($file_pointer, "\xEF\xBB\xBF");

$result = mysqli_query($link, $select);

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
