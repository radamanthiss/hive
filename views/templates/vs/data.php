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
$key = "RGAPI-a6448508-ed5e-405a-ab38-533a39c7ae2b";

if (!empty($_POST['name']) && !empty($_POST['server'])) {
	echo "hola ".$_POST['name'];
	getUserInfo($_POST['server'],$key,rawurlencode($_POST['name']));
    spectatorInfo($_POST['server'],$key,rawurlencode($_POST['name']));
}else{
	echo "adios";
}

?>

<html>
<head>
	<title>Vs</title>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../../css/common.css">
	<link rel="stylesheet" type="text/css" href="../../css/vs.css">
</head>
<body>
<div class="container-marketing">
<?php
    $encode = rawurlencode($_POST['name']);
    $data_spectator = file_get_contents("../../../model/spectator_info/spectator_".$encode."_info.json");
    $spectator_array = json_decode($data_spectator);
?>

<?php
    foreach($spectator_array as $data){
    $img = '<img src="/views/img/champion/loading/'.trim($data->championName).'_0.jpg" class="rounded float-left" alt="...">';
        if($data->teamId == '100'){
?>
    <div class="column left first">
        <div class="user left name"><?php print $data->summonerName;?></div>
        <div class="user left champ darius"><?php print $img;?></div>
        <div class="user left champName"><?php print $data->championName;?></div>
    </div>

    <div class="column left second ">
        <div class="mod logo">

        </div>

    </div>
<?php
        }elseif($data->teamId == '200'){
?>
     <div class="column right third">
     <div class="rival right name"><?php print $data->summonerName;?></div>
     <div class="rival right champ darius"><?php print $img;?></div>
     <div class="rival right champ name"><?php print $data->championName;?></div>
     </div>
<?php
        }
       }
?>

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
<script src="../../js/jquery.js"></script>
<script src="../../js/bootstrap.min.js"></script>
</body>
</html>