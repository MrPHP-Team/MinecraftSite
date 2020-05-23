<!DOCTYPE html>
<html lang="en">
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">AnusCraft</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/banlist/bans.php">Banlist </a>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="/register/login.php">Login </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register/logout.php">Logout </a>
                </li>
                <?php
                    session_start();

                    // Check if the user is logged in, if not then redirect him to login page
                    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                        header("location: /register/login.php");
                        exit;
                    } else {

                    }
                ?>
            </ul>
        </div>
    </nav>
</header>
<head>
	<meta charset="utf-8">
	<title>Minecraft Query PHP Class</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<style type="text/css">
        body {
            background-image: url(/images/bg.jpg); /* Путь к фоновому изображению */
        }
		.jumbotron {
			margin-top: 30px;
			border-radius: 0;
		}

		.table thead th {
			background-color: #428BCA;
			border-color: #428BCA !important;
			color: #FFF;
		}
	</style>
</head>
<body>
    <div class="container">
    	<div class="jumbotron">
            <center>
                <iframe src="/monitoring/view.php" height="85">
                </iframe>
            </center>
		</div>
	</div>
</body>
</html>
