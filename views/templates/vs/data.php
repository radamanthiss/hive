<?php
include '../../../controller/user_functions.php';
//TO DO se debe cambiar como constante y que qede en un unicoarchivo
$key = "RGAPI-f2716034-12e3-4bdf-bc19-db1063928ec0";

if (!empty($_POST['name']) && !empty($_POST['server'])) {
	echo "hola ".$_POST['name'];
	getUserInfo($_POST['server'],$key,rawurlencode($_POST['name']));
}else{
	echo "adios";
}