<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//Comprobar de envío el formulario
if (isset($_POST['login'])) {

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$result = mysqli_query($con, "SELECT * FROM usuarios WHERE username = '" . $username. "' and password = '" . md5($password) . "'");

	if ($row = mysqli_fetch_array($result)) {
		//$_SESSION['usr_estado'] = $row['estado'];

		if($row['estado']==1){
			$_SESSION['usr_id'] = $row['id'];
			$_SESSION['usr_name'] = $row['username'];
			
			header("Location: index.php");
		}else
		$errormsg = "Esta cuenta esta desactivada";
	} else {
		$errormsg = "Revisa los datos!!!";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <!--link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- add header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" style="font-family: 'Lobster', cursive;">HIVE</a>
        </div>
        <!-- menu items -->
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php">Login</a></li>
                <li class="active"><a href="register.php">Registro</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Login</legend>
					<!--div class="form-group clearfix">
						<img src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bff8b1de.png" alt="" width="200px" class="img-responsive img-circle" style="margin:0 auto">
					</div-->

					<div class="form-group">
						<label for="name">Username</label>
						<input type="text" name="username" placeholder="Ingresar Username" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">Contraseña</label>
						<input type="password" name="password" placeholder="Ingresar Contraseña" required class="form-control" />
					</div>

					<div class="form-group">
						<input type="submit" name="login" value="Iniciar Sesion" class="btn btn-primary" />
						<input type="reset" value="Limpiar" class="btn btn-default" >
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		No tienes cuenta? <a href="register.php">Regitrate aqui</a>
		</div>
	</div>
</div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
