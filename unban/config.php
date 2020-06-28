<?php


//Site Theme (see all the available themes here: https://goo.gl/g7AQTV - themes include 'default', 'do-blue', 'do-green', 'do-black', 'do-yellow, 'do-red', 'do-purple')
$theme = "default";

//Page Title
$pagetitle = "My Minecraft Server | Ban Appeal";

//Logo link - where should the user be redirected to when they click the logo?
$logolink = "#"; // Leave at # for no link

//Do you want a dropdown / select box for players to say what they are appealing e.g. mute, ban, forum ban
$appealoptions = false; // Set true for options, false for no options

//Where should ban appeal forms be sent to for review?
$sendto = "bans@myserver.com";

//Should we send a confirmation E-Mail to the user when they submit a ban appeal?
$sendconfirmation = true;

//Where should E-Mails be sent from (for confirmation emails)
$sendfrom = "no-reply@myserver.com";

//Confirmation E-Mail subject
$confirmsubject = "Unban Appeal Confirmation";

//Confirmation E-Mail message (you can use HTML here)
$confirmmsg = "Your ban appeal request has been received. It will reviewed within the next few days and you will be notified via the E-Mail you provided. <br><br><strong>- Server Name</strong>";

//The message said to the user when they successfully submit a ban appeal (you can use HTML here)
$successnotice = "<div class='return' style='background-color:green;'><strong>Success!</strong></br></br>Your ban appeal has been submitted. You should receive a response via <strong>E-Mail</strong> within a day or two.</div>";

//Shall we use Google's anti-spam bot CAPTCHA? I recommend you do to prevent spam. 
//IF YOU CHOOSE TRUE, YOU MUST CONFIGURE IT BELOW (see my Spigot page for details).
$captcha = true;
//CAPTCHA config:
$sitekey = "ENTER SITE KEY";
$secretkey = "ENTER SECRET KEY";





/* ------ Accept/Deny Email Info ------ */

//Enable 'Accept' button?
$acceptbutton = true;

//What E-Mail shall we send to the player when the admin clicks the "Unban Player" button? (you can use HTML here)
$appealaccepted = "Congratulations, your ban appeal has been accepted!";

//Enable 'Deny' button?
$denybutton = true;

//What E-Mail shall we send to the player when the admin clicks the "Deny Appeal" button? (you can use HTML here)
$appealdenied = "Hello, <br><br>Thank you for taking the time to appeal your ban. Unfortunately, your appeal has been denied.";

//Please enter a password here that we can use to securely send ban appeal accepted/denied emails
$replykey = "CHANGEME"; // I recommend you change this if an Admin leaves the team

/* --- End of Accept/Deny Email Info --- */





/* ------ Admin Email Info ------ */

//Should we show the player's Minecraft head in the E-Mail? (enabling this may send your ban appeal emails to spam/junk)
//Try disabling this if your emails are going to spam/junk
$minecrafthead = true;

//Should Admins receive the applicants IP?
$provideip = true;

//Should Admins receive the country the applicant is from?
$providelocation = true;

//Should Admins receive the time that the ban appeal was submitted?
$providetime = true;

//Should Admins receive the date that the ban appeal was submitted?
$providedate = true;


/* --- End of Admin Email Info --- */

//We have included a blank website page so that you can do/add whatever you want, change to false to disable
// Rename this file to change it from 'blank-page', keep .php at the end! - you can also duplicate it to make more pages
$blankpage = true;

$checkupdate = true; //IMPORTANT for security, recommended that you keep this on, it is very easy to update this system

?>