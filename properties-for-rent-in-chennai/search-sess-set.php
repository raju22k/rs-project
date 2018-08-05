<?php

if(isset($_REQUEST['reset']) && ($_REQUEST['reset']=='true')) {
  session_unset();
}


include '../users/user.php';
$user = new User();

if(!isset($_SESSION['property_locality'])) { $_SESSION['property_locality']=""; }
if(!isset($_SESSION['property_type'])) { $_SESSION['property_type']=""; }
if(!isset($_SESSION['area_min'])) { $_SESSION['area_min']=""; }
if(!isset($_SESSION['area_max'])) { $_SESSION['area_max']=""; }
if(!isset($_SESSION['price_min'])) { $_SESSION['price_min']=""; }
if(!isset($_SESSION['price_max'])) { $_SESSION['price_max']=""; }

if(!isset($_GET["page"])){

    if(empty($_POST['property_locality'])) {
      $_POST['property_locality']="";
      $_SESSION['property_locality'] ="";
    } else {
      $_SESSION['property_locality'] = $_POST['property_locality'];
    }

    if(empty($_POST['property_type'])) {
      $_POST['property_type']="";
      $_SESSION['property_type'] ="";
    } else {
      $_SESSION['property_type'] = $_POST['property_type'];
    }

    if(empty($_POST['area_min'])) {
      $_POST['area_min']="";
      $_SESSION['area_min'] ="";
    } else {
      $_SESSION['area_min'] = $_POST['area_min'];
    }

    if(empty($_POST['area_max'])) {
      $_POST['area_max']="";
      $_SESSION['area_max'] ="";
    } else {
      $_SESSION['area_max'] = $_POST['area_max'];
    }

    if(empty($_POST['price_min'])) {
      $_POST['price_min']="";
      $_SESSION['price_min'] ="";
    } else {
      $_SESSION['price_min'] = $_POST['price_min'];
    }

    if(empty($_POST['price_max'])) {
      $_POST['price_max']="";
      $_SESSION['price_max'] ="";
    } else {
      $_SESSION['price_max'] = $_POST['price_max'];
    }


}

include_once "function.php";
    $conditions=null;
    if(!empty($_SESSION['property_locality'])){
      $conditions['where']['place'] = $_SESSION['property_locality'];
     }  
    if(!empty($_SESSION['property_type'])){
      $conditions['where']['type_id'] = $_SESSION['property_type'];
     }  
    if(!empty($_SESSION['area_min'])){
      $conditions['where']['area >'] = $_SESSION['area_min'];
     }  
    if(!empty($_SESSION['area_max'])){
      $conditions['where']['area <'] = $_SESSION['area_max'];
     }  
    if(!empty($_SESSION['price_min'])){
      $conditions['where']['price >'] = $_SESSION['price_min'];
     }  
    if(!empty($_SESSION['price_max'])){
      $conditions['where']['price <'] = $_SESSION['price_max'];
     }  
//    $conditions['where']['approve_status'] = '2';
//    $conditions['where']['type_id'] = '1';
    $conditions['where']['property_status'] = 'RENT'; // SALE
    $conditions['return_type'] = 'count';
    $cnt = $user->getRows('all_properties',$conditions);

  if(isset($_GET["page"]))
  $page = (int)$_GET["page"];
  else
  $page = 1;

  $setLimit = 6;
  $pageLimit = ($page * $setLimit) - $setLimit; 

?>