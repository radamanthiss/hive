<?php
//variable recogida con nombre de invocador, se realiza un encode para usar el nombre en la url
$summoner = $_POST['username'];
$encode = rawurlencode($summoner);
//variable recogida con servidor especifico
$server = $_POST['server'];
//key de la api para realizar las consultas
$key = "RGAPI-e315a02d-4359-4b19-980c-994a7c806376";

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

<html>
<head>
</head>
<body>
  <form name="versus_1.0"  action="<?PHP echo $_SERVER['PHP_SELF']; ?>"  method="post" accept-charset="utf-8" enctype="multipart/form-data" onsubmit="ReadValue(this);">
    <input id="username" name="username" placeholder="Summoner Name" type="text">
    <input class="btn-buscar" type="submit" name="enviar" id="enviar" data-bs-hover-animate="pulse" value="Buscar">
    <select class="server-select" name="server" id="server" required title="Selecciona tu servidor">
      <option value="" selected="" required hidden="">servidor *</option>
      <option value="ru">RU</option>
      <option value="kr">KR</option>
      <option value="br1">BR1</option>
      <option value="oc1">OC1</option>
      <option value="jp1">JP1</option>
      <option value="na1">NA1</option>
      <option value="euw1">EUW1</option>
      <option value="tr1">TR1</option>
      <option value="la1">LA1</option>
      <option value="la2">LA2</option>
    </select>
  </form>
</body>
</httml>
