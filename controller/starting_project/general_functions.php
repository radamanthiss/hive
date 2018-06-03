<?php

/* codigo usado para almacenaje de los datos de los items
$content = file_get_contents("static_data/items.json");
$item_data = json_decode($content,true);
$data = array();


 foreach ($item_data['data'] as $key => $item){
        $data[$key]['id'] = $item['id'];
        $data[$key]['name'] = $item['name'];
        $data[$key]['description'] = strip_tags($item['description']);
        $data[$key]['plaintext'] = $item['plaintext'];
 }


function generateCsv($data, $delimiter = ',', $enclosure = '"') {
    $handle = fopen('php://temp', 'r+');
    foreach ($data as $line) {
        fputcsv($handle, $line, $delimiter, $enclosure);
    }
    rewind($handle);
    while (!feof($handle)) {
        $contents .= fread($handle, 8192);
    }
    fclose($handle);
    return $contents;
}

//echo generateCsv($data);
file_put_contents('items.csv',generateCsv($data));*/

?>