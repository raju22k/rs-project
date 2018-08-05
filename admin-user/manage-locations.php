<?php 

$action = $_REQUEST['action'];

include 'user.php';
$user = new User();
if($action=='view') {
	$id = $_REQUEST['feature_id'];
	$conditions['where'] = array(
		'id' => $_REQUEST['feature_id']
	);
	$conditions['return_type'] = 'single';
	$features = $user->getRows("property_locality",$conditions);

//	$msg = "ID: " . $features['id'];
	$msg = '';
	$msg = $msg . "<input type=hidden name='f_id' value='" . $features['id'] . "'>";
	$msg = $msg . "<div class='md-form'>";
	$msg = $msg . "<input type=text id='title' class='form-control title' name='title' value='" . $features['locality'] . "' required>";
	$msg = $msg . "<label for='title' class='active'>Location Name</label>";
	$msg = $msg . "</div>";
	echo $msg;

} elseif($action=='save') {
	$id = $_REQUEST['feature_id'];
	$title = $_REQUEST['title'];
	if(!empty($title)) {
		$conditions = array(
			'id' => $id
		);
		$data = array(
			'locality' => $title
		);
		$features = $user->update("property_locality",$data,$conditions);
		if($features) {
			$msg = "success";
		} else {
			$msg = "error";
		}
	}
echo $msg;

}  elseif($action=='add') {
	$title = $_REQUEST['title'];
	if(!empty($title)) {
		$data = array(
			'locality' => $title
		);
		$features = $user->insert("property_locality",$data);
		if($features) {
				$msg = "success";
			} else {
				$msg = "error";
	}
	echo $msg;

	}

} elseif($action=='delete') {
	$id = $_REQUEST['feature_id'];
	$conditions="";
	$conditions = array(
		'id' => $id
	);
	$features_delete = $user->delete("property_locality",$conditions);
	if($features_delete) {
		$msg = "Success";
	} else {
		$msg = "Error";
	}


	echo $msg;

}



?>