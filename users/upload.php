<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


    $targetDir = "../assets/images/properties/large/". $_SESSION['sessData']['prop_rand_id'] . "/";

if(!empty($_FILES)){
    if (!file_exists($targetDir)) {
      mkdir($targetDir, 0777, true);
    }


        $targetFile = $targetDir . 'PROPIMAGE' . round(microtime(true)) . rand(0000,9999) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);  
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $file = $targetFile; 
            $source_properties = getimagesize($file);
            $image_type = $source_properties[2]; 
            $fileName='';
            if( $image_type == IMAGETYPE_JPEG ) {   
                $image_resource_id = imagecreatefromjpeg($file);  
                $target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
                imagejpeg($target_layer,$targetFile);
            }
            elseif( $image_type == IMAGETYPE_GIF )  {  
                $image_resource_id = imagecreatefromgif($file);
                $target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
               imagegif($target_layer,$targetFile);
            }
            elseif( $image_type == IMAGETYPE_PNG ) {
                $image_resource_id = imagecreatefrompng($file); 
                $target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
                imagepng($target_layer,$targetFile);
           }
        }
        else {
              echo "upload file to server failed!";      
        } 
} else {     
        echo "no file chosen for uplaod";                                                      
} 

function fn_resize($image_resource_id,$width,$height) {
    $target_width =1200;
    $target_height =800;
    $target_layer=imagecreatetruecolor($target_width,$target_height);
    imagecopyresampled($target_layer,$image_resource_id,0,0,0,0,$target_width,$target_height, $width,$height);
    return $target_layer;
}




?>


