<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 1/06/2018
 * Time: 11:57 PM
 */

//variable recogida con nombre de invocador, se realiza un encode para usar el nombre en la url
$summoner = $_POST['summoner'];
$encode = rawurlencode($summoner);
//variable recogida con servidor especifico
$server = $_POST['server'];
//key de la api para realizar las consultas
$key = "RGAPI-8b19d281-7ad6-4a9f-bbba-3966c1cd5d20";

//url de consulta
$url = "https://".$server.".api.riotgames.com/lol/summoner/v3/summoners/by-name/".$encode."?api_key=".$key."";
var_dump($url);
//generación de variables estaticas de la api
$static_data = "https://".$server.".api.riotgames.com/lol/static-data/v3/realms?api_key=".$key."";
$account_json  = file_get_contents($url);
$array_content = json_decode($account_json);
//obtener icono de invocador
$summoner_icon = $array_content->profileIconId;
//obtener id de invocador
$summoner_id = $array_content->id;
//se genera imagen con el icono de invocador
$url_icon = "http://ddragon.leagueoflegends.com/cdn/8.9.1/img/profileicon/".$summoner_icon.".png";
print_r("<img src=".$url_icon.">");

function masteryChamps($summoner_id,$key,$server){
    $url_mastery = "https://".$server.".api.riotgames.com/lol/champion-mastery/v3/champion-masteries/by-summoner/".$summoner_id."?api_key=".$key."";
    $mastery_json = file_get_contents($url_mastery);
    $array_mastery = json_decode($mastery_json);
    $i = 0;
    $champ_array = array();
    foreach ($array_mastery as $clave => $champ) {
        if ($i < 3) {
            $champ_array[$clave]['championId'] = $champ->championId;
            $champ_array[$clave]['championLevel'] = $champ->championLevel;
            $champ_array[$clave]['championPointsSinceLastLevel'] = $champ->championPointsSinceLastLevel;
            $champid = $champ_array[$clave]['championId'];
            $url_champ = "https://".$server.".api.riotgames.com/lol/static-data/v3/champions/".$champid."?locale=en_US&champData=all&api_key=".$key."";
            $champ_json = file_get_contents($url_champ);
            $array_champ = json_decode($champ_json);
            $champ_icon = $array_champ->image->full;
            $champ_image = "http://ddragon.leagueoflegends.com/cdn/8.9.1/img/champion/".$champ_icon."";
            print_r("<img src=".$champ_image.">");
            $i++;
        }
    }

    var_dump($array_champ->image->full);
}

masteryChamps($summoner_id, $key, $server);




?>