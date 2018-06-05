<?php
#variable de configuracion para inicializar session
session_start();
#se validad el campo usr_id de la session y se destruye la session
#luego se redirige al index.php
if(isset($_SESSION['usr_id'])) {
	session_destroy();
	unset($_SESSION['usr_id']);
	unset($_SESSION['usr_name']);
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>