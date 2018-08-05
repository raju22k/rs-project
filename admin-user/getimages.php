<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    $targetDir = "../assets/images/properties/large/". $_SESSION['sessData']['prop_rand_id'] . "/";

    $result  = array();
    if(file_exists($targetDir)) {
        $files = scandir($targetDir);                 //1
        if ( false!==$files ) {
            foreach ( $files as $file ) {
                if ( '.'!=$file && '..'!=$file) {       //2
                    $obj['name'] = $file;
                    $obj['size'] = filesize($targetDir.'/'.$file);
                    $result[] = $obj;
                }
            }
        }
    } 
    header('Content-type: text/json');              //3
    header('Content-type: application/json');
    echo json_encode($result);
?>