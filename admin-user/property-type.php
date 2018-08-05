<?php

include 'user.php';
$user = new User();


if($_POST['action_type'] == 'listproptype'){
        $conditions['where'] = array('prop_status'=>$_POST['id']);
//        $users = $db->getRows('sub_category',$conditions);
		$property_types = $user->getRows("property_types",$conditions);
        if(!empty($property_types)): $count = 0; 
        foreach($property_types as $property_type): $count++;
                echo '<option value="'.$property_type['id'].'">'.$property_type['title'].'</option>';
        endforeach; else: 
        echo '<option value="">Sub Category not available</option>';
        endif;
    }

?>
