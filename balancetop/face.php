<?php
$user = strtolower($_GET['username']);
function getFace($user, $faceSize) {
	//Fetches a users skin and crops to the face, then resizes it and caches it.
	//Only get the file if it doesn't exist OR it is older than 1 hour.
	$thumb = "faces/" . $user . ".png";
	if((file_exists($thumb) && filemtime($thumb) <= time()-60*60) || !file_exists($thumb))  {

		if(file_exists($thumb)){
			unlink($thumb);
		}
		// Create url to users skin.
		$filename = ci_find_file("../login/skins/" . $user . ".png"); //Относительный путь ко скинам
		if(!$filename)
			return false;
		$newFile = $thumb;

		//Check that the user has a skin
		if(!file_exists($filename))
			return false;
		// Get dimensions of the original image
		list($current_width, $current_height) = getimagesize($filename);
		// The x and y coordinates on the original image where we
		// will begin cropping the image
		$left = 8;
		$top = 8;

		// This will be the final size of the image (e.g. how many pixels
		// left and down we will be going)
		$crop_width = $faceSize;
		$crop_height = $faceSize;

		ini_set('gd.png_ignore_warning', 1);

		// Resample the image
		$canvas = imagecreatetruecolor($crop_width, $crop_height);
		$current_image = imagecreatefrompng($filename);
		imagecopyresized ($canvas , $current_image , 0 , 0 , $left , $top , $crop_width * 8, $crop_height * 8, $current_width , $current_width );
		imagepng($canvas, $newFile, 9);
		return true;
	}
	return true;
}
if(getFace($user, 40))
{
	echo '<img src="http://' . dirname($_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']) . '/faces/' . $user . '.png" />';
} else {
	echo '<img src="http://' . dirname($_SERVER["REQUEST_URI"]) . '/default.png" />';
}

function ci_find_file($fileName) {
	// Handle case insensitive requests
	$directoryName = dirname($fileName);
	$fileArray = glob($directoryName . '/*', GLOB_NOSORT);
	$fileNameLowerCase = strtolower($fileName);
	foreach($fileArray as $file) {
		if(strtolower($file) == $fileNameLowerCase) {
			return $file;
		}
	}
	return false;
}
?>