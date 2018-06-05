<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2/06/2018
 * Time: 4:33 PM
 */
#include_once 'dbconnect.php';
# se setea una variable para quitar el limite de tiempo de ejecución del script
ini_set('max_execution_time', 0);
# se crea una variable para la conexion a la base de datos de datos, se coloca el host, el usuario, la clave y el nombre de la base de datos
$link = mysqli_connect("localhost", "root", "123456", "esports");
#se lee el fichero json
$content = file_get_contents("recomended.json");
#variable para hacer un decode del json para poder leerlo
$item_data = json_decode($content,true);
$data = array();


/*
 * metodo para recorrer el json y extraer los datos necesarios
 */
foreach ($item_data['data'] as $key => $item){
    $data[$key]['id'] = $item['id'];
    $data[$key]['name'] = $item['name'];
    unset($objects);

    foreach ($item['recommended'] as $recomended){

        if($recomended['map']=="SR" && $recomended['mode']=="CLASSIC"){
            foreach ($recomended['blocks'] as $block){
                $fase = $block['type'];
                #definicion de los id para la fase segun el tipo
                if ($fase=="starting"){
                   $fase=1;
                }
                else if ($fase=="startingjungle"){
                    $fase=2;
                }
                else if ($fase=="early"){
                    $fase=3;
                }
                else if ($fase=="earlyjungle"){
                    $fase=4;
                }
                else if ($fase=="essential"){
                    $fase=5;
                }
                else if ($fase=="essentialjungle"){
                    $fase=6;
                }
                else if ($fase=="offensive"){
                    $fase=7;
                }
                else if ($fase=="defensive"){
                    $fase=8;
                }
                else if ($fase=="consumables"){
                    $fase=9;
                }
                else if ($fase=="ability_scaling"){
                    $fase=10;
                }
                else if ($fase=="situational"){
                    $fase=11;
                }
                else if ($fase=="aggressive"){
                    $fase=12;
                }
                else if ($fase=="standard"){
                    $fase=13;
                }
                else if ($fase=="protective"){
                    $fase=14;
                }
                else if ($fase=="selective"){
                    $fase=15;
                }
                else if ($fase=="support"){
                    $fase=16;
                }

                #ciclo para poder iterar cada resultado de los id de cada item
                foreach($block['items'] as $items){
                    $objects[$fase]["item"][] = $items['id'];
                    $data[$key]['items'] = $objects;

                    #se hace el insert en la tabla de sql recomendacion de los datos obtenidos
                    $sql = "INSERT INTO recomendacion (champ_id, item_id, type_id) VALUES ('".$item['id']."','".$items['id']."','".$fase."')";
                    #validacion de la conexion
                    if(mysqli_query($link, $sql)){
                        echo "Records inserted successfully.";
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                }

            }
        }

    }
}
#se cierra la conexion a la base de datos
mysqli_close($link);
