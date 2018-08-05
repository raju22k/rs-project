<?php
	if(isset($_POST) == true){
		$errors= array();
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];   
	    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	    $extensions = array("jpeg","jpg","png"); 		
	    if(in_array($file_ext,$extensions )=== false){
	    	$errors[]="extension not allowed, please choose a JPEG or PNG file.";
	    }
	    if($file_size > 1048576){
	    	$errors[]='File size grater than 1 MB';
	    }				
	    if(empty($errors)==true){
//			$file = "../assets/images/agents/".$file_name; 
			$file = "../assets/images/agents/".$_POST['agentfilename']; 
	    	if (move_uploaded_file($file_tmp,$file)) {
			    $source_properties = getimagesize($file);
			    $image_type = $source_properties[2]; 
			    $fileName='';
			    if( $image_type == IMAGETYPE_JPEG ) {   
			        $image_resource_id = imagecreatefromjpeg($file);  
			        $target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
			        imagejpeg($target_layer,$file);
			    }
			}
	    }else{
	        $myfile = fopen("log.txt", "w") or die("Unable to open file!");
			$txt = implode("\n", $errors);
			fwrite($myfile, $txt);
			fclose($myfile);
	    }
	}

function fn_resize($image_resource_id,$width,$height) {
    $target_width =590;
    $target_height =590;
    $target_layer=imagecreatetruecolor($target_width,$target_height);
    imagecopyresampled($target_layer,$image_resource_id,0,0,0,0,$target_width,$target_height, $width,$height);
    return $target_layer;
}



?>