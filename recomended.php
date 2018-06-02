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
                $fase = $block['type'];
                //var_dump($fase);

                foreach($block['items'] as $item){
                    //var_dump("<pre>");
                    //var_dump($item);
                    $objects[$fase]["item_".$i.""] = $item[$key]['id'];
                    //$block[$fase]['item2'] = $block['bloks'][$fase]['items'][1]['id'];
                    $data[$key]['items'] = $objects;
                }
            }
            //var_dump("<pre>");
            //var_dump($prueba);

        }
    }
    //var_dump($block);


    $i++;



}
var_dump("<pre>");
var_dump($data);


