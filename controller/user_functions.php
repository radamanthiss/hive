<?php
/**
 * Created by PhpStorm.
 * User: alejo
 * Date: 03/06/2018
 * Time: 03:30 PM
 */


//DECLARACIÓN DE VARIABLES GENERALES:
//variable recogida con nombre de invocador, se realiza un encode para usar el nombre en la url
$summoner = $_POST['summoner_name'];
$encode = rawurlencode($summoner);
//variable recogida con servidor especifico
$server = $_POST['server'];
//key de la api para realizar las consultas
$key = "RGAPI-39babeb7-ece7-4b6d-9901-855dfa1834b8";




/**
 *Función para consulta de datos de usuario
 */
function getUserInfo($server,$key,$encode)
{
    //ARCHIVO JSON CON DATOS DEL USUARIO
    $file_user_info = "model/user_info/user_" . $encode . ".json";
    if (!file_exists($file_user_info)) {
        //url de consulta
        $url = "https://" . $server . ".api.riotgames.com/lol/summoner/v3/summoners/by-name/" . $encode . "?api_key=" . $key . "";
        //generación de variables estaticas de la api
        $static_data = "https://" . $server . ".api.riotgames.com/lol/static-data/v3/realms?api_key=" . $key . "";
        $account_json = file_get_contents($url);
        //se genera archivo json con la información del usuario
        file_put_contents($file_user_info, $account_json);
    }
}
function loadUserInfo($encode,$server,$key ){
    //se lee el archivo para obtener la información
    $account_data = file_get_contents("model/user_info/user_".$encode.".json");
    $array_content = json_decode($account_data);
    $summoner_id = $array_content->id;
    //variables para llamar icono,nombre,id, id de cuenta y nivel de invocador.
    $summoner_icon = $array_content->profileIconId;
    //se genera imagen con el icono de invocador
    $url_icon = "http://ddragon.leagueoflegends.com/cdn/8.9.1/img/profileicon/" . $summoner_icon . ".png";
    //Se construye el llamado a los datos relacionados con las colas clasificatorias
    $rank_info = "https://" . $server . ".api.riotgames.com/lol/league/v3/positions/by-summoner/" . $summoner_id . "?api_key=" . $key . "";
    $rank_json = file_get_contents($rank_info);
    $array_league = json_decode($rank_json);
    //NOTA: Se construye array con la información relevante del usuario y se genera un archivo JSON.
    $user_info_data = array();
    $user_info_data['summoner_accountId'] = $array_content->accountId;
    $user_info_data['summoner_name'] = $array_content->name;
    $user_info_data['summoner_lvl'] = $array_content->summonerLevel;
    $user_info_data['rank_name'] = $array_league[0]->leagueName;
    $user_info_data['rank'] = $array_league[0]->rank;
    $user_info_data['rank_tier'] = $array_league[0]->tier;
    $user_info_data['rank_points'] = $array_league[0]->leaguePoints;
    $user_info_data['rank_wins'] = $array_league[0]->wins;
    $user_info_data['rank_losses'] = $array_league[0]->losses;
    $user_info_data['url_icon'] = $url_icon;
    $user_data_json = json_encode($user_info_data);
    $file_account_data = "model/user_info/user_".$encode."_data.json";
    file_put_contents($file_account_data,$user_data_json);

}

//Se realiza el llamado a la información relacionadas con las partidas jugadas por el usuario.
//$match_data = "https://" . $server . ".api.riotgames.com/lol/match/v3/matchlists/by-account/" . $summoner_account . "?api_key=" . $key . "";

//getUserInfo($server,$key,$encode);
//loadUserInfo($encode,$server,$key);