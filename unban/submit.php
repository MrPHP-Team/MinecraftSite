<!-- Made with love by 16YELDARB -->
<!-- https://www.spigotmc.org/members/16yeldarb.36673/ -->

<?php include 'config.php'; ?>

<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $pagetitle;?></title>
	<link href="assets/img/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style-<?php echo $theme; ?>.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>


<div class="logocontainer">

	<a href="<?php echo $logolink;?>"><img src="assets/img/logo.png" class="logo"/></a>

</div>

<?php

$version = 1.10;
$versionget = 1.10;
//$versionget = file_get_contents('http://mcpluginsdev.com/spigotunbanversion.txt');

$emailheaders = "MIME-Version: 1.0" . "\r\n";
$emailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";


$appealreplyheaders = $emailheaders . "From: " . $sendfrom . "\r\n";

if(isset($_GET["accept"])) {

    if ($_GET['key'] == $replykey) {

    	echo "<div class='return' style='background-color:green'>Accepted appeal E-Mail sent.</div>";
    	mail($_GET["accept"],"Ban Appeal Accepted",$appealaccepted,$appealreplyheaders);
    	
    	$unbanlist = fopen("tounban.txt", "a+");
    	fwrite($unbanlist, strtolower($_GET['username']) . "\n");
    	fclose($unbanlist);

    } else {

    	echo "<div class='return' style='background-color:red'>Admin key is incorrect</div>";

    }
	

} else if (isset($_GET["deny"])) {
	
    if ($_GET['key'] == $replykey) {

    	echo "<div class='return' style='background-color:green'>Rejected appeal E-Mail sent.</div>";
    	mail($_GET["deny"],"Ban Appeal Denied",$appealdenied,$appealreplyheaders);

    	$unbanlist = fopen("tounban.txt", "r+") or die (fopen("tounban.txt", "w"));

    	while(! feof($unbanlist)) {

    		$listedusername = fgets($unbanlist);
    		$listedusername = trim($listedusername);
 			if (strtolower($_GET["username"]) == $listedusername) { 

 				$contents = file_get_contents("tounban.txt");
				$removeline = str_replace($listedusername, '', $contents);
				file_put_contents("tounban.txt", $removeline);

 			}

  		}

  		fclose($unbanlist);

    } else {

    	echo "<div class='return' style='background-color:red'>Admin key is incorrect</div>";

    }

}

//It is recommended you don't edit the below unless you're familiar with php
//Below is the core code for the E-Mail/Form system

function submittedForm($successnotice, $minecrafthead, $provideip, $providelocation, $providetime, $providedate, $version, $versionget, $sendto, $sendfrom, $sendconfirmation, $checkupdate, $confirmsubject, $confirmmsg, $replykey, $acceptbutton, $denybutton, $emailheaders, $appealreplyheaders, $appealoptions) {

	$username = htmlspecialchars($_POST['username']);
	$reason = htmlspecialchars($_POST['reason']);
	if ($appealoptions == true){$appealoption = htmlspecialchars($_POST['appealoption']);}else{$appealoption = "Ban";};

    $emailbodyextra = ""; //Here for later updates
	//$confirmmsgextra = "" . file_get_contents('http://mcpluginsdev.com/spigotunbanextra.txt'); //Here for later updates
	$successextra = ""; //Here for later updates

	echo $successnotice . $successextra;

	$ip = $_SERVER['REMOTE_ADDR'];
	$location = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));

	$headers = $emailheaders . "From: " . $_POST['email'] . "\r\n";

	if ($minecrafthead == true){$emailimage = "<img src='https://cravatar.eu/helmhead/" . $username . "' width='90px'/><br>";}else{$emailimage = "";}
	$emailbody = $emailimage . "<strong>" . $username . "</strong><br><br><strong>Appealing:</strong><br>" . $appealoption . "<br><br><strong>Reason:</strong><br>" . $reason . "<br><br>----------------------------------------";
	$emailbody = str_replace("\n.", "\n..", $emailbody); //Security check

	if ($provideip == true){$emailbody .= "<br><br><strong>IP Address:</strong> " . $ip;}
	if ($providelocation == true){$emailbody .= "<br><strong>Location:</strong> " . $location->country;}
	if ($providetime == true){$emailbody .= "<br><strong>Time Submitted:</strong> " . date("h:i:sa");}
	if ($providedate == true){$emailbody .= "<br><strong>Date Submitted:</strong> " . date("Y/m/d");}
	if (($version < $versionget) && $checkupdate == true) {$versionoutwarning = "<br><br><strong>Your current version of MC Ban Appeal is out of date!<br>Please get the new version here: <a href='https://goo.gl/Xjavfs'>https://goo.gl/Xjavfs</a>";}else{$versionoutwarning = "";}
	if ($acceptbutton == true){$emailbody .= "<br><br><a href='http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?accept=" . $_POST['email'] . "&username=" . $_POST['username'] . "&key=" . $replykey . "'><img src='https://i.imgur.com/lm867A1.png' style='width: 114px; height: 29px;'/></a>";}
	if ($denybutton == true){$emailbody .= " <a href='http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?deny=" . $_POST['email'] . "&username=" . $_POST['username'] . "&key=" . $replykey . "'><img src='https://i.imgur.com/AlyMFBm.png'/></a>";}
	
	mail($sendto,"Unban Appeal",$emailbody . $versionoutwarning . $emailbodyextra,$headers);

	if ($sendconfirmation == true){mail($_POST['email'],$confirmsubject,$confirmmsg,$appealreplyheaders);}

}

if(isset($_POST['submit'])){

	if ($captcha == true) {

		$sender_username = stripslashes($_POST["username"]);
		$sender_email = stripslashes($_POST["email"]);
		$sender_reason = stripslashes($_POST["reason"]);
		$response = $_POST["g-recaptcha-response"];
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array(
			'secret' => $secretkey,
			'response' => $_POST["g-recaptcha-response"]
		);
		$options = array(
			'http' => array (
				'method' => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$verify = file_get_contents($url, false, $context);
		$captcha_success=json_decode($verify);

		if ($captcha_success->success==false) {

			echo "<div class='return' style='background-color:red'>CAPTCHA Failed. <a href='index.php' style='color:white;'>Click to retry</a></div>";

		} else if ($captcha_success->success==true) {

			// Security / Valid Email Check
			$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

			if ($email === FALSE) {

    			echo "<div class='return' style='background-color:red'>Invalid E-Mail. Failed to submit ban appeal. Click the back button to go back.</div>";
    		
			} else {

				submittedForm($successnotice, $minecrafthead, $provideip, $providelocation, $providetime, $providedate, $version, $versionget, $sendto, $sendfrom, $sendconfirmation, $checkupdate, $confirmsubject, $confirmmsg, $replykey, $acceptbutton, $denybutton, $emailheaders, $appealreplyheaders, $appealoptions);
		
			}
		}
	} else {

		$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

		if ($email === FALSE) {

    		echo "<div class='return' style='background-color:red'>Invalid E-Mail. Failed to submit ban appeal.</div>";
    		
		} else {

			submittedForm($successnotice, $minecrafthead, $provideip, $providelocation, $providetime, $providedate, $version, $versionget, $sendto, $sendfrom, $sendconfirmation, $checkupdate, $confirmsubject, $confirmmsg, $replykey, $acceptbutton, $denybutton, $emailheaders, $appealreplyheaders, $appealoptions);
		
		}
	}
}

?>

</body>


</html>

<!-- Covered by the MIT License Copyright (c) 2018 16YELDARB -->