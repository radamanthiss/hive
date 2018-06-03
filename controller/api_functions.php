<?php
/**
 * Created by PhpStorm.
 * User: alejoslifer@gmail.com
 * Date: 02/05/2018
 * Time: 11:46 AM
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
    //url de consulta
        $url = "https://" . $server . ".api.riotgames.com/lol/summoner/v3/summoners/by-name/" . $encode . "?api_key=" . $key . "";
    //generación de variables estaticas de la api
        $static_data = "https://" . $server . ".api.riotgames.com/lol/static-data/v3/realms?api_key=" . $key . "";
        $account_json = file_get_contents($url);
        $array_content = json_decode($account_json);

    //variables para llamar icono,nombre,id, id de cuenta y nivel de invocador.
        $summoner_icon = $array_content->profileIconId;
        $summoner_name = $array_content->name;
        $summoner_account = $array_content->accountId;
        $summoner_lvl = $array_content->summonerLevel;
        $summoner_id = $array_content->id;
    //Se realiza el llamado a la información relacionadas con las partidas jugadas por el usuario.
        $match_data = "https://" . $server . ".api.riotgames.com/lol/match/v3/matchlists/by-account/" . $summoner_account . "?api_key=" . $key . "";
    //Se construye el llamado a los datos relacionados con las colas clasificatorias
        $rank_info = "https://" . $server . ".api.riotgames.com/lol/league/v3/positions/by-summoner/" . $summoner_id . "?api_key=" . $key . "";
        $rank_json = file_get_contents($rank_info);
        $array_league = json_decode($rank_json);
    //variables para llamar nombre,victorias, derrotas, rango, tier y puntos de la liga actual del jugador
    //NOTA: Se esta tomando información relacionada unicamente con la liga obtenida en SOLO/Q
        $rank_name = $array_league[1]->leagueName;
        $rank_tier = $array_league[1]->tier;
        $rank_range = $array_league[1]->rank;
        $rank_points = $array_league[1]->leaguePoints;
        $rank_wins = $array_league[1]->wins;
        $rank_losses = $array_league[1]->losses;
    //se genera imagen con el icono de invocador
        $url_icon = "http://ddragon.leagueoflegends.com/cdn/8.9.1/img/profileicon/" . $summoner_icon . ".png";

}
//print_r("<img src=".$url_icon.">");

$file_items = "/static_data/items.json";
$item_data = json_decode($file_items,true);


foreach ($item_data as $clave => $item){
        var_dump($item);
}



function masteryChamps($summoner_id,$key,$server){
  $url_mastery = "https://".$server.".api.riotgames.com/lol/champion-mastery/v3/champion-masteries/by-summoner/".$summoner_id."?api_key=".$key."";
  $mastery_json = file_get_contents($url_mastery);
  $file_mastery = "mastery_champs_".$summoner_id.".json";
  file_put_contents($file_mastery,$mastery_json);
  $local_mastery = file_get_contents($file_mastery);
  $array_mastery = json_decode($local_mastery, true);
  $i = 0;
  $champ_array = array();
  foreach ($array_mastery as $clave => $champ) {
    if ($i < 3) {
      $champ_array[$clave]['championId'] = $champ['championId'];
      $champ_array[$clave]['championLevel'] = $champ['championLevel'];
      $champ_array[$clave]['championPointsSinceLastLevel'] = $champ['championPointsSinceLastLevel'];
      $champid = $champ_array[$clave]['championId'];
      $url_champ = "https://".$server.".api.riotgames.com/lol/static-data/v3/champions/".$champid."?locale=en_US&champData=all&api_key=".$key."";
      $champ_json[$clave] = file_get_contents($url_champ);
      //$array_champ = json_decode($champ_json);
      //var_dump($array_champ);
      //$champ_icon = $array_champ->image->full;
      //$champ_image = "http://ddragon.leagueoflegends.com/cdn/8.9.1/img/champion/".$champ_icon."";
      //print_r("<img src=".$champ_image.">");
      $i++;
    }
    $file_champ = "champions_mastery_".$summoner_id.".json";
    file_put_contents($file_champ,$champ_json);
  }

  //var_dump($url_champ);
}

function spectatorInfo($summoner_id,$key,$server){
  $url_spectator = "https://".$server.".api.riotgames.com/lol/spectator/v3/active-games/by-summoner/$summoner_id?api_key=".$key."";
  $spectator_json = file_get_contents($url_spectator);
  $array_spectator = json_decode($spectator_json);
  $i = 0;
  $spectator_array = array();
  var_dump($array_spectator->participants[0]);


}
//spectatorInfo($summoner_id,$key,$server);
//
//masteryChamps($summoner_id, $key, $server);



