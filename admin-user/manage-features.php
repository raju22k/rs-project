<?php 

$action = $_REQUEST['action'];

include 'user.php';
$user = new User();
if($action=='view') {
	$id = $_REQUEST['feature_id'];
	$conditions['where'] = array(
		'feature_id' => $_REQUEST['feature_id']
	);
	$conditions['return_type'] = 'single';
	$features = $user->getRows("property_features_list",$conditions);

	$msg = "Feature ID: " . $features['feature_id'];
	$msg = $msg . "<input type=hidden name='f_id' value='" . $features['feature_id'] . "'>";
	$msg = $msg . "<div class='md-form'>";
	$msg = $msg . "<input type=text id='title' class='form-control title' name='title' value='" . $features['title'] . "' required>";
	$msg = $msg . "<label for='title' class='active'>Feature Name</label>";
	$msg = $msg . "</div>";
	echo $msg;

} elseif($action=='save') {
	$id = $_REQUEST['feature_id'];
	$title = $_REQUEST['title'];
	if(!empty($title)) {
		$conditions = array(
			'feature_id' => $id
		);
		$data = array(
			'title' => $title
		);
		$features = $user->update("property_features_list",$data,$conditions);
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
			'title' => $title
		);
		$features = $user->insert("property_features_list",$data);
		if($features) {
            $digits = 4;
            $rand_num = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
            $prop_rand_id = 'FEAT' . $rand_num . $features;
            $condition = array(
                'id' => $features
            );
            $userData = array(
                'feature_id' => $prop_rand_id
            );
            $update = $user->update('property_features_list', $userData,$condition);
            if($update) {
				$msg = "success";
			} else {
				$msg = "error";
			}
	}
	echo $msg;

	}

} elseif($action=='delete') {
	$id = $_REQUEST['feature_id'];
	$conditions="";
	$conditions = array(
		'feature_id' => $id
	);
	$features_delete = $user->delete("property_features_list",$conditions);
	if($features_delete) {
		$msg = "Success";
	} else {
		$msg = "Error";
	}


	echo $msg;

}



?>