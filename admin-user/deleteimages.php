<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['image'])) {
//delete/unlink file 
    $targetFile = "../assets/images/properties/large/". $_SESSION['sessData']['prop_rand_id'] . "/" . $_POST['image'];
    if (file_exists($targetFile)) {
    	unlink($targetFile);
	    echo $_POST['image'] . ' deleted'; // send msg back to user
	}

}

?>