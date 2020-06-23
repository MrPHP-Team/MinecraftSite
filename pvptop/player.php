<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Player stats</title>
<link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/mtablet.css">
<link rel="stylesheet" type="text/css" href="css/searchplayer.css">
<link rel="stylesheet" type="text/css" href="css/buttons.css">
<link rel="stylesheet" type="text/css" href="css/playercard.css">
<link rel="stylesheet" type="text/css" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />

<link rel="icon" href="img/favicon.jpg"> <!-- you can select your by replacing the favicon.jpg file in the img folder -->
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <head>
      <link rel="stylesheet" href="css/mtablet.css" />
      <link
        rel="stylesheet"
        href="lightcss/lighttables.css"
        media="(prefers-color-scheme: light)"
      />
      <link
        rel="stylesheet"
        href="lightcss/lightplayercards.css"
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
</head>
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
  <label for="search" class="screen-reader-text"></label>
  <td align="right"> <input id="search" type="text" class="pure-input-rounded right search-input" placeholder="Player Name" name="search" /></td>
    <button type="submit" class="pure-button button-green search-button">Search</button>
   </form>

<?php
require 'SETTINGS_93747/settings.php';


if($search != null and $onclick == null){
$dblinko = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = ("SELECT * FROM McDuelsPlayerData WHERE Name='$search'");
$info = $dblinko->query($sql);
$searched = mysqli_fetch_assoc($info);
if($searched[Name] != null){
if($searched[Party] == null){
$party = "Not in a Party";
}
if($searched[Party] != null){
$party = "$searched[Party]";
}
if($searched[Party_Rank] == null){
$partyrank = " ";
}
if($searched[Party] != null){
$partyrank = "$searched[Party_Rank]";
}
$kdratios = $searched[Kills] / $searched[Deaths];
$wlratios = $searched[Won] / $searched[Lost];
$kdratio = substr($kdratios, 0, 3);
$wlratio = substr($wlratios, 0, 3);
$icon = "https://crafatar.com/avatars/$searched[UUID]?overlay&size=90";
$imgthing = '"' .$icon .'"';
echo '

<div class="wrapper">
    <div class="left">
        <img src=' .$icon .'
        alt="user" width="100">
        <h4>' .$searched[Name] .'</h4>
         <p>' .$party .'</p>
         <p>' .$partyrank .'</p>
    </div>
    <div class="right">
        <div class="info">
            <h3>Stats</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Kills</h4>
                    <p>' .$searched[Kills] .'</p>
                      <h4>Deaths</h4>
                    <p>' .$searched[Deaths] .'</p>
                    <h4>Wins</h4>
                    <p>' .$searched[Won] .'</p>
                      <h4>Loses</h4>
                    <p>' .$searched[Lost] .'</p>
                 </div>
                 <div class="data">
                 <br>
                   <h4>K/D Ratio</h4>
                    <p>' .$kdratio .'</p>
                   <br><br><br>
                   <h4>W/L Ratio</h4>
                    <p>' .$wlratio .'</p>
              </div>
            </div>
        </div>
      
      <div class="projects">
            <h3> Elo     ' .$searched[Elo] .'</h3>
            <div class="projects_data">
                 <div class="data">
                    <h4>Battle 1vs1</h4>
                    <p>' .$searched[Battle1v1Elo] .'</p>
                    <h4>Battle 2vs2</h4>
                    <p>' .$searched[Battle2v2Elo] .'</p>
                    <h4>Battle 3vs3</h4>
                    <p>' .$searched[Battle3v3Elo] .'</p>
                 </div>
                 <div class="data">
                 <br><br><br>
                   <h4>Duel 1vs1</h4>
                    <p>' .$searched[Duel1v1Elo] .'</p>
              </div>
            </div>
        </div>
      
      
    </div>
</div>';
}
}
?>
<?
if($search == null and $onclick != null){
$dblinko = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = ("SELECT * FROM McDuelsPlayerData WHERE Name='$onclick'");
$info = $dblinko->query($sql);
$searched = mysqli_fetch_assoc($info);
if($searched[Name] != null){
if($searched[Party] == null){
$party = "No in a Party";
}
if($searched[Party] != null){
$party = "$searched[Party]";
}
if($searched[Party_Rank] == null){
$partyrank = " ";
}
if($searched[Party] != null){
$partyrank = "$searched[Party_Rank]";
}
$kdratios = $searched[Kills] / $searched[Deaths];
$wlratios = $searched[Won] / $searched[Lost];
$kdratio = substr($kdratios, 0, 3);
$wlratio = substr($wlratios, 0, 3);
$icon = "https://crafatar.com/avatars/$searched[UUID]?overlay&size=90";
$imgthing = '"' .$icon .'"';
echo '

<div class="wrapper">
    <div class="left">
        <img src=' .$icon .'
        alt="user" width="100">
        <h4>' .$searched[Name] .'</h4>
         <p>' .$party .'</p>
         <p>' .$partyrank .'</p>
    </div>
    <div class="right">
        <div class="info">
            <h3>Stats</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Kills</h4>
                    <p>' .$searched[Kills] .'</p>
                      <h4>Deaths</h4>
                    <p>' .$searched[Deaths] .'</p>
                    <h4>Wins</h4>
                    <p>' .$searched[Won] .'</p>
                      <h4>Loses</h4>
                    <p>' .$searched[Lost] .'</p>
                 </div>
                 <div class="data">
                 <br>
                   <h4>K/D Ratio</h4>
                    <p>' .$kdratio .'</p>
                   <br><br><br>
                   <h4>W/L Ratio</h4>
                    <p>' .$wlratio .'</p>
              </div>
            </div>
        </div>
      
      <div class="projects">
            <h3> Elo' .$searched[Elo] .'</h3>
            <div class="projects_data">
                 <div class="data">
                    <h4>Battle 1vs1</h4>
                    <p>' .$searched[Battle1v1Elo] .'</p>
                    <h4>Battle 2vs2</h4>
                    <p>' .$searched[Battle2v2Elo] .'</p>
                    <h4>Battle 3vs3</h4>
                    <p>' .$searched[Battle3v3Elo] .'</p>
                 </div>
                 <div class="data">
                 <br><br><br>
                   <h4>Duel 1vs1</h4>
                    <p>' .$searched[Duel1v1Elo] .'</p>
              </div>
            </div>
        </div>
      
      
    </div>
</div>';
}
}
?>

<?
if($search != null and $onclick == null){
$dblinko = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = ("SELECT * FROM McDuelsPlayerData WHERE Name='$search'");
$info = $dblinko->query($sql);
$searched = mysqli_fetch_assoc($info);
if($searched[Name] == null){
$queroi = ("SELECT * FROM McDuelsPlayerData");
$resultp = $dblinko->query($queroi);


  $dbdatap = array();


  while ( $rowp = $resultp->fetch_assoc())  {
	$dbdatap[]=$rowp;
  }
  echo '<br><br><br><br><h1 align=center>Maybe you meant:</h1>
  <table class="container">
	<thead>
		<tr>
			<th><h1>Name</h1></th>
			<th><h1>Kills</h1></th>
			<th><h1>Deaths</h1></th>
			<th><h1>Wins</h1></th>
            <th><h1>Loses</h1></th>
            <th><h1>Elo</h1></th>
		</tr>
	</thead>
    <tbody>';
    $searchlow = strtolower($search);
foreach($dbdatap as $simi){
$similnames = strtolower($simi[Name]);
$similplayer = similar_text("$searchlow", "$similnames", $percsim);
if($similplayer > 5){
$icon = "https://crafatar.com/avatars/$simi[UUID]?overlay&size=25";
$imgthing = '"' .$icon .'"';
$missoutput = "
	
		<tr>
			<td><img src=$imgthing><a href='player.php?player=$simi[Name]'> $simi[Name]</a></img></td>
			<td>$simi[Kills]</td>
			<td>$simi[Deaths]</td>
			<td>$simi[Won]</td>
            <td>$simi[Lost]</td>
            <td>$simi[Elo]</td>
		</tr>
";
}
} 
if($missoutput == null){
$missoutput = "<tr>
			<td>No Matches Found</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
            <td>0</td>
            <td>0</td>
		</tr>
";
} 

echo "$missoutput
</tbody>
</table>";
}
}

?>
<style>
.Center {
  width: 200px;
  height: 200px;
  margin: auto;
  padding: 2%;
  position: absolute;
  top: 0;
  left: 30;
  bottom: -500;
  right: 0;
  display: table; text-align: center;
}

.btn-bot {
  position: absolute;
  bottom: 0px;
  display: table-cell; vertical-align: bottom;
}
</style>
<div class="Center" align="center">
<button onclick="goBack()" top="28px" align="center" class="button-lightblue pure-button btn-bot">Go Back</button>

</div>
<script>
function goBack() {
  window.history.back();
}
</script>
</body>
<p class="btn-bot">Made with <i class="icon ion-heart"></i> by Samuele Turetta</p>
</html>
