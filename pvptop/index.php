<?php
  include ("anti_ddos/start.php");
?>

<html>
<link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/mtablet.css">
<link rel="stylesheet" type="text/css" href="css/searchplayer.css">
<link rel="stylesheet" type="text/css" href="css/buttons.css">
<link rel="icon" href="img/favicon.jpg"> <!-- you can select your by replacing the favicon.jpg file in the img folder -->
<link rel="stylesheet" type="text/css" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />



<head>
      <link rel="stylesheet" href="css/mtablet.css" />
      <link
        rel="stylesheet"
        href="lightcss/lighttables.css"
        media="(prefers-color-scheme: light)"
      />
      <link
        rel="stylesheet"
        href="css/mtables.css"
        media="(prefers-color-scheme: dark), (prefers-color-scheme: no-preference)"
      />
      <script
        type="module"
        src="https://googlechromelabs.github.io/dark-mode-toggle/src/dark-mode-toggle.mjs"
      ></script>

      <meta charset="UTF-8" />

    </head>
















<meta name="viewport" content="width=device-width, initial-scale=0.2" />
<?
require "SETTINGS_93747/settings.php";
echo "
<title>$servername Duels</title>
<h1>$servername</h1>
<h2>Duels Stats</h2>
<h3 align=center>Top Ten Players Per $first_showed_leaderboard</h3>";
?>
<body>
<aside>
  <dark-mode-toggle
    id="dark-mode-toggle"
    legend="Theme Switch"
    light="Light"
    dark="Dark"
    appearance="switch"
    permanent="false"
  ></dark-mode-toggle>
</aside>
   <form style = "position:relative; right:50px; top:-50px;" class="pure-form search-form" align="right" top="20px" method=post action=player.php>
  <label for="search" class="screen-reader-text">Поиск</label>
  <td align="right"> <input id="search" type="text" class="pure-input-rounded right search-input" placeholder="Player Name" name="search" /></td>
    <button type="submit" class="pure-button button-green search-button">Поиск</button>
   </form>
</body>
   <table class="container">
	<thead>
		<tr>
			<th><h1>Имя</h1></th>
			<th><h1>Киллы</h1></th>
			<th><h1>Смерти</h1></th>
			<th><h1>Победы</h1></th>
            <th><h1>Loses</h1></th>
            <th><h1>Elo</h1></th>
		</tr>
	</thead>
    <tbody>

<?
$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($parametro == null){
$quer = "SELECT * FROM McDuelsPlayerData ORDER BY $first_showed_leaderboard DESC LIMIT 10";
$text = "";
}
if($parametro == "Kills"){
$quer = "SELECT * FROM McDuelsPlayerData ORDER BY Kills DESC LIMIT 10";
$text = "Sorted by most";
}
if($parametro == "Elo"){
$quer = "SELECT * FROM McDuelsPlayerData ORDER BY Elo DESC LIMIT 10";
$text = "Sorted by most";
}
if($parametro == "Won"){
$quer = "SELECT * FROM McDuelsPlayerData ORDER BY Won DESC LIMIT 10";
$text = "Sorted by most";
}
if($parametro == "Deaths"){
$quer = "SELECT * FROM McDuelsPlayerData ORDER BY Deaths DESC LIMIT 10";
$text = "Sorted by most";
}
if($parametro == "Lost"){
$quer = "SELECT * FROM McDuelsPlayerData ORDER BY Lost DESC LIMIT 10";
$text = "Sorted by most";
}

  if ($dblink->connect_errno) {
     printf("Failed to connect to database");
     exit();
  }

if($search == null){
  $result = $dblink->query($quer);


  $dbdata = array();


  while ( $row = $result->fetch_assoc())  {
	$dbdata[]=$row;
  }
$rosta = json_encode($dbdata);
foreach($dbdata as $info){
$icon = "https://crafatar.com/avatars/$info[UUID]?overlay&size=25";
$imgthing = '"' .$icon .'"';
echo "

		<tr>
			<td><img src=$imgthing><a href='player.php?player=$info[Name]'>\n$info[Name]</a></img></td>
			<td>$info[Kills]</td>
			<td>$info[Deaths]</td>
			<td>$info[Won]</td>
            <td>$info[Lost]</td>
            <td>$info[Elo]</td>
		</tr>
";
}
}
?>
	</tbody>
</table>
Сделано с <i class="icon ion-heart"></i> by CarryLove
</html>
