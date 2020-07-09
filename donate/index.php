<?php
include_once('core/config.php');
include ("anti_ddos/start.php");
?>

<html>

	<head>

		<!-- МЕТА ТЕГИ -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- /МЕТА ТЕГИ -->

		<title><?=$settings['site']['title'] ?> - Покупка привилегий</title>

		<!-- СТИЛИ -->
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<!-- /СТИЛИ -->
	</head>

	<body>
		<table width="100%" height="100%">
			<tr>
				<td>
					<div class="main">
						<h1><?=$settings['site']['title'] ?> <small><?=$settings['site']['description'] ?></small></h1>
						<div class="well">
							<form method="POST" id="form" onchange="checkprice()" onsubmit="sendform();return false">
								<div class="form-group">
									<input type="text" class="form-control" name="nickname" placeholder="Введите ник" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="promo" placeholder="Введите промокод (если есть)">
								</div>
								<div class="form-group">
									<select class="form-control" name="buy">
										<?php
											foreach($getitems->response->items as $groups) {
												echo '<option value="'.$groups->id.'">'.$groups->name.' | Цена: '.$groups->cost.'Р</option>';
											}
										?>
									</select>
								</div>
								<div id="sendf"></div>
								<div id="result"><button type="submit" class="btn btn-default btn-block disabled">Заполните форму</button></div>
							</form>
						</div>
					</div>
				</td>
			</tr>
		</table>

		<!-- JS -->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/main.js"></script>
		<!-- /JS -->

	</body>

</html>
