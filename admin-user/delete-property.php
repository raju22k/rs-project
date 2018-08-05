<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$request_path = basename($_SERVER['HTTP_REFERER']);


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

if(empty($sessData['userLoggedIn']) && empty($sessData['userID'])){
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Please login to your account.';
	    header("Location:index.php");
		exit();
}

if(empty($_REQUEST['propertyid'])) {
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'No property found.';
		header("Location:" . $request_path);
		exit();
} else {
		include 'user.php';
		$user = new User();
        $conditions[] = "";
        $conditions['where'] = array(
            'prop_id' => $_REQUEST['propertyid']
        );
		$conditions['return_type'] = 'single';

        $property_detail = $user->getRows('property_listings', $conditions);
		if($property_detail) {
                $conditions = "";
		        $conditions = array(
		            'id' => $property_detail['id']
		        );
                $delete_listings = $user->delete('property_listings', $conditions);	 //Delete Listing			
                if($delete_listings) {
		                $conditions = "";
		                $conditions = array(
		                    'property_id' => $property_detail['id']
		                );
		                $delete_property_features = $user->delete('property_features', $conditions); //Delete Features

					    $dir = "../assets/images/properties/large/". $_REQUEST['propertyid'] . "/";

					    if (file_exists($dir)) {								//Delete image folder

							   $files = array_diff(scandir($dir), array('.','..')); 
							    foreach ($files as $file) { 
							      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
							    } 
							    if(rmdir($dir)) {
										header("Location:" . $request_path);
										exit();
							    } else {
										header("Location:" . $request_path);
										exit();
							    }
						}
			            $sessData['status']['type'] = 'success';
			            $sessData['status']['msg'] = 'Property details was deleted successfully.';
						header("Location:" . $request_path);
			}
		} else {
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Property details not found.';
			header("Location:" . $request_path);
			exit();
		}
}


?>