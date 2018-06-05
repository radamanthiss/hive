<?php
session_start();
include_once 'dbconnect.php';


?>
<!DOCTYPE html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="views/css/carousel.css" rel="stylesheet" type="text/css">
    <link href="views/css/bootstraps.min.css" rel="stylesheet" type="text/css">


    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <!--link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body>

<header>
    <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0px;">

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
</header>



    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Bienvenido Invocador</h1>
            <p>Preparate para saber como ser mejor, nuestro sistema te permitirá conocer las estadisticas de tus partidas y basado en recomendaciones podras
            mejorar con cada juego.</p>

        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h2>Data</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-success" href="#" role="button">View details »</a></p>
            </div>
            <div class="col-md-4">
                <h2>Spectator</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-success" href="#" role="button">View details »</a></p>
            </div>
            <div class="col-md-4">
                <h2>Statistics</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-success" href="#" role="button">Learn more »</a></p>
            </div>
        </div>

        <hr>

    </div> <!-- /container -->

<footer class="container">
    <div class="bottom-right"> <p class="float-xl-right">© 2017-2018 Hive Evolution, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p></div>

</footer>

<script src="views/js/jquery-1.10.2.js"></script>
<script src="views/js/bootstrap.min.js"></script>
</body>
</html>