<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
		header("Location:users-properties.php");
		exit();
} else {
		include 'user.php';
		$user = new User();
        $conditions = "";
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
				$data = array(
					'approve_status' => '2'
				);
                $update_listings = $user->update('property_listings', $data, $conditions);	 		
				header("Location:users-properties.php");
		} else {
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Property details not found.';
			header("Location:users-properties.php");
			exit();
		}
}

?>