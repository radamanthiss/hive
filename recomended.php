<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2/06/2018
 * Time: 4:33 PM
 */

$content = file_get_contents("recomended.json");
$item_data = json_decode($content,true);
$data = array();
#var_dump($item_data);

$i=0;
foreach ($item_data['data'] as $key => $item){

    $data[$key]['id'] = $item['id'];
    $data[$key]['name'] = $item['name'];
    foreach ($item['recommended'] as $recomended){
        if($recomended['map']=="SR" && $recomended['mode']=="CLASSIC"){
            foreach ($recomended['blocks'] as $block){
                #var_dump($data[$key]['type']);
                var_dump($block['type']);

            }
        }
    }


    $i++;



}
#var_dump($data);


