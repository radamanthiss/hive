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
$key = "RGAPI-a6448508-ed5e-405a-ab38-533a39c7ae2b";




/**
 *Función para consulta de datos de usuario
 */
function getUserInfo($server,$key,$encode)
{
    //ARCHIVO JSON CON DATOS DEL USUARIO
    $file_user_info = "../../../model/user_info/user_" . $encode . ".json";
    if (!file_exists($file_user_info)) {
        //url de consulta
        $url = "https://" . $server . ".api.riotgames.com/lol/summoner/v3/summoners/by-name/" . $encode . "?api_key=" . $key . "";
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

function spectatorInfo($server,$key,$encode ){
    //se carga información del usuario
    $account_data = file_get_contents("../../../model/user_info/user_".$encode.".json");
    $array_content = json_decode($account_data);
    $summoner_id = $array_content->id;
    //se llama la función de specttor de la api
    $url_spectator = "https://".$server.".api.riotgames.com/lol/spectator/v3/active-games/by-summoner/$summoner_id?api_key=".$key."";
    //se genera el json de spectator
    $json_spectator = "../../../model/spectator_info/user_".$encode."_spectator.json";
    $spectator_json = file_get_contents($url_spectator);
    file_put_contents($json_spectator,$spectator_json);
    //se declara el array para la función
    $array_spectator = json_decode($spectator_json);
    $array_match_info = array();
    //se realiza la conexión a la base de datos
    $con = mysqli_connect("localhost", "root", "", "test") or die("Error " . mysqli_error($con));
    /* comprobar la conexión */
    if ($con->connect_errno) {
        printf("Falló la conexión: %s\n", $con->connect_error);
        exit();
    }
    foreach ($array_spectator->participants as $key => $participants){
        //se empieza a armar el array con los datos a pintar
        $array_match_info[$key]['summonerName'] = $participants->summonerName;
        $array_match_info[$key]['championId'] = $participants->championId;
        $array_match_info[$key]['teamId'] = $participants->teamId;
        $champion_id = $participants->championId;
        $query = mysqli_query($con, "SELECT champ_name FROM campeones WHERE champ_id = '" .$champion_id. "'");
        //$query2 = mysqli_query($con, "SELECT r.item_id,t.item_name,f.name from recomendacion as r INNER JOIN objetos as t on t.item_id=r.item_id INNER JOIN campeones as c on c.champ_id=r.champ_id INNER JOIN tipos as f on r.type_id=f.type_id where c.champ_id like '" .$participants->championId. "'");
        $query_array = mysqli_fetch_array($query);
        //$query_array2 = mysqli_fetch_array($query2);
        $items_array = array();
        /*foreach ($query_array2 as $llave => $items_data) {
           //var_dump($items_data);
           //$items_array[$llave]['item_id'] = $items_data[$llave];
           //$items_array[$llave]['item_name'] = $items_data[$llave];
        }*/

        $array_match_info[$key]['championName'] = $query_array['champ_name'];

    }
    mysqli_close($con);
    $spectator_views_file = "../../../model/spectator_info/spectator_" . $encode ."_info.json";
    $spectator_views_data = json_encode($array_match_info);
    file_put_contents($spectator_views_file,$spectator_views_data);


}
//spectatorInfo($summoner_id,$key,$server);
//masteryChamps($summoner_id, $key, $server);

