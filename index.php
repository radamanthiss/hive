<?php
session_start();
include_once 'dbconnect.php';
//variable recogida con nombre de invocador, se realiza un encode para usar el nombre en la url
$summoner = $_POST['summoner_name'];
$encode = rawurlencode($summoner);
//variable recogida con servidor especifico
$server = $_POST['server'];
//key de la api para realizar las consultas
$key = "RGAPI-d8312946-f69e-4842-85ee-4e48aef40975";

//url de consulta
$url = "https://".$server.".api.riotgames.com/lol/summoner/v3/summoners/by-name/".$encode."?api_key=".$key."";
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
        if ($i < 2) {
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
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />

	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php" style="font-family: 'Lobster', cursive;">HIVE</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				<li><p class="navbar-text">Logeado como <i class="btn btn-danger btn-xs" ><b><?php echo $_SESSION['usr_name']; ?></b></i></p></li>
				<li><a href="logout.php">Log Out</a></li>
				<?php } else { ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Registro</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

<div class="container">

      <!--Componente principal de un mensaje de primario o llamado a la acción -->
      <div class="jumbotron">

          <form name="versus_1.0"  action="<?PHP echo $_SERVER['PHP_SELF']; ?>"  method="post" accept-charset="utf-8" enctype="multipart/form-data" onsubmit="ReadValue(this);">
              <input id="summoner_name" name="summoner_name" placeholder="Summoner Name" type="text">
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
      </div>


    </div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>