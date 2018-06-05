<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2/06/2018
 * Time: 1:54 PM
 */
/**
 * ruta al archivo de funciones
 */
include '../../../controller/user_functions.php';
//TO DO se debe cambiar como constante y que quede en un unicoarchivo
$key = "RGAPI-f2716034-12e3-4bdf-bc19-db1063928ec0";

if (!empty($_POST['name']) && !empty($_POST['server'])) {
	echo "hola ".$_POST['name'];
	getUserInfo($_POST['server'],$key,rawurlencode($_POST['name']));
}else{
	echo "adios";
}

$spectator_data = file_get_contents("../../../model/user_info/user_32998717_spectator.json");
$array_spectator = json_decode($spectator_data);
/*
 * sentencia foreach para acceder a la informacion del usuario
 */
$array_match_info = array();
foreach ($array_spectator->participants as $key => $participants){

    $array_match_info[$key]['summonerName'] = $participants->summonerName;
    $array_match_info[$key]['championId'] = $participants->championId;
    $array_match_info[$key]['teamId'] = $participants->teamId;
    $mysqli = mysqli_connect("localhost", "root", "123456", "esports") or die("Error " . mysqli_error($con));
    #se comprueba la conexion
    if ($mysqli->connect_errno) {
        printf("Falló la conexión: %s\n", $mysqli->connect_error);
        exit();
    }
    $query = $mysqli->query("SELECT champ_name FROM campeones WHERE champ_id = '$participants->championId'");


}

?>

<html>
<head>
	<title>Vs</title>
	<link rel="stylesheet" type="text/css" href="../../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../../css/common.css">
	<link rel="stylesheet" type="text/css" href="../../css/vs.css">
</head>
<body>
	<div class="container-marketing">
		<div class="column left first">
			<div class="user left name">test</div>
			<div class="user left champ darius"></div>
			<div class="user left champName">Darius</div>
		</div>
		<div class="column left second ">
			<div class="mod logo">

            </div>
			<div class="lol logo"></div>
		</div>
		<div class="column right third">
			<div class="rival right name">Tester</div>
			<div class="rival right champ darius"></div>
			<div class="rival right champ name">tejon</div>
		</div>
		<div class="items clear">
			<span class="item 3065.png"></span>
			<span class="item 3065.png"></span>
			<span class="item 3065.png"></span>
			<span class="item 3065.png"></span>
			<span class="item 3065.png"></span>
			<span class="item 3065.png"></span>
		</div>
		<div class="clear"></div>

	</div>
</body>
</html>