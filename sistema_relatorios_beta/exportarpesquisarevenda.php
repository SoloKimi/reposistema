<?php

require_once './conexao_banco.php';
$tipo = $_POST['tipo'];
$pesquisa = $_POST['pesquisanome'];
$selectExportar = "SELECT nomefantasia, cnpj, base, adesao, cidade FROM Revenda WHERE nomefantasia LIKE '%$pesquisa%' ORDER BY nomefantasia ";


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
