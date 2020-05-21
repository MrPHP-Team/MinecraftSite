<?php
	use xPaw\MinecraftQuery;
	use xPaw\MinecraftQueryException;

	// Edit this ->
	define( 'MQ_SERVER_ADDR', '192.162.246.31' );
	define( 'MQ_SERVER_PORT', 16626 );
	define( 'MQ_TIMEOUT', 1 );
	// Edit this <-

	// Display everything in browser, because some people can't look in logs for errors
	Error_Reporting( E_ALL | E_STRICT );
	Ini_Set( 'display_errors', true );

	require __DIR__ . '/src/MinecraftQuery.php';
	require __DIR__ . '/src/MinecraftQueryException.php';

	$Timer = MicroTime( true );

	$Query = new MinecraftQuery( );

	try {
		$Query->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );
	}
	catch( MinecraftQueryException $e ) {
		$Exception = $e;
	}

	$Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
?>
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

<?php if( isset( $Exception ) ): ?>
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo htmlspecialchars( $Exception->getMessage( ) ); ?></div>
			<div class="panel-body"><?php echo nl2br( $e->getTraceAsString(), false ); ?></div>
		</div>
<?php else: ?>
		<div class="row">
			<div class="col-sm-6">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th colspan="2">Информация: <em>(queried in <?php echo $Timer; ?>s)</em></th>
						</tr>
					</thead>
					<tbody>
<?php if( ( $Info = $Query->GetInfo( ) ) !== false ): ?>
<?php foreach( $Info as $InfoKey => $InfoValue ): ?>
						<tr>
							<td><?php echo htmlspecialchars( $InfoKey ); ?></td>
							<td><?php
	if( Is_Array( $InfoValue ) )
	{
		echo "<pre>";
		print_r( $InfoValue );
		echo "</pre>";
	}
	else
	{
		echo htmlspecialchars( $InfoValue );
	}
?></td>
						</tr>
<?php endforeach; ?>
<?php else: ?>
						<tr>
                            <td>Игроков нет!</td>
                        </tr>
<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="col-sm-6">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Players</th>
						</tr>
					</thead>
					<tbody>
<?php if( ( $Players = $Query->GetPlayers( ) ) !== false ): ?>
<?php foreach( $Players as $Player ): ?>
						<tr>
							<td><?php echo htmlspecialchars( $Player ); ?></td>
						</tr>
<?php endforeach; ?>
<?php else: ?>
						<tr>
                            <td>Игроков нет!</td>
                        </tr>
<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
<?php endif; ?>
	</div>
</body>
</html>
