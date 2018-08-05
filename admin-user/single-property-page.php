<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// to get current directory
$curdir=basename(__DIR__);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'user.php';
$user = new User();


//unset($conditions];
$conditions[]='';
$conditions['where'] = array(
    'property_id' => $_REQUEST['propertyid']
);
$conditions['return_type'] = 'single';
$property_details = $user->getRows('all_properties', $conditions);

if(empty($property_details)) {
	header("Location:my-properties.php");
	exit();
} 




/*
$conditions='';
$conditions['where'] = array(
    'id' => $property_details['prop_status']
);
$conditions['return_type'] = 'single';
$property_status = $user->getRows('property_status', $conditions);

$conditions='';
$conditions['where'] = array(
    'id' => $property_details['type_id']
);
$conditions['return_type'] = 'single';
$property_type = $user->getRows('property_types', $conditions);

$conditions='';
$conditions['where'] = array(
    'id' => $property_details['rooms']
);
$conditions['return_type'] = 'single';
$property_rooms = $user->getRows('property_rooms', $conditions);

$conditions='';
$conditions['where'] = array(
    'id' => $property_details['bedrooms']
);
$conditions['return_type'] = 'single';
$property_bedrooms = $user->getRows('property_rooms', $conditions);

$conditions='';
$conditions['where'] = array(
    'id' => $property_details['bathrooms']
);
$conditions['return_type'] = 'single';
$property_bathrooms = $user->getRows('property_rooms', $conditions);


$conditions='';
$conditions['where'] = array(
    'id' => $property_details['build_age']
);
$conditions['return_type'] = 'single';
$property_age = $user->getRows('property_age', $conditions);

*/

?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="icon" href="../favicon.ico" type="image/x-icon" sizes="16x16">
    <title>Properties in Chennai</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../assets/css/mdb.min.css" rel="stylesheet">
    <!-- BX Slider Bootstrap -->
    <link href="../assets/css/jquery.bxslider.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Wrapper -->
<div id="wrapper">


<!-- Header Container
================================================== -->
<?php

include '../header/menu.php';

?>
<!-- Header Container / End -->

<div class="container">
	<div class="row">
		<!-- Widget -->
		<div class="col-md-4  top-margin-40">
			<div class="sidebar left">

				<div class="my-account-nav-container">
					
					<ul class="my-account-nav">
						<li class="sub-nav-title">Manage Account</li>
						<li><a href="my-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
					</ul>
					
<!--					<ul class="my-account-nav">
						<li class="sub-nav-title">Manage Users</li>
						<li><a href="users-list.php"><i class="fa fa-users"></i> Users List</a></li>
						<li><a href="users-properties.php"><i class="fa fa-building"></i> Users Properties</a></li>
						<li><a href="property-features.php"><i class="fa fa-magic"></i> Property Features</a></li>
					</ul> -->

					<ul class="my-account-nav">
						<li class="sub-nav-title">Manage Listings</li>
						<li><a href="my-properties.php" class="current"><i class="fa fa-files-o"></i> My Properties</a></li>
						<li><a href="submit-property.php"><i class="fa fa-mail-forward"></i> Submit New Property</a></li>
						<li><a href="property-features.php"><i class="fa fa-magic"></i> Property Features</a></li>
						<li><a href="property-location.php"><i class="fa fa-map-marker"></i> Manage Locations</a></li>
					</ul>

					<ul class="my-account-nav">
						<li><a href="change-password.php"><i class="fa fa-lock"></i> Change Password</a></li>
						<li><a href="userAccount.php?logoutSubmit=1"><i class="fa fa-power-off"></i> Log Out</a></li>
					</ul>

				</div>

			</div>
		</div>

		<div class="col-md-8">
			  <div class="row mt-5">
			  	<div class="col-md-10">
		        <h2 class="h2-responsive wow fadeIn text-left"><?php echo $property_details['title']; ?></h2>
		    	</div><div class="col-md-2">
		        <h3 class="price text-right"><span class="badge red darken-2"><?php echo $property_details['property_status']; ?></span></h3>
		    	</div>
		      </div>
		        <hr>
                        
  				<div class="view overlay hm-white-light z-depth-1-half mb-3">
					<?php
					    $targetDir = "../assets/images/properties/large/". $_REQUEST['propertyid'] . "/";
					    if(file_exists($targetDir)) {
						    $files = scandir($targetDir);                 //1
						    if ( false!==$files ) {
					  ?>
					<ul class="bxslider">
					<?php
						        foreach ( $files as $file ) {
						            if ( '.'!=$file && '..'!=$file) {       //2
						            	echo "<li><img src='" . $targetDir . $file . "' class='img-fluid' alt='" . $file . "' /></li>";
						            }
						        }
					?>
					</ul>
					<?php
						    }
						 } else {
							        echo "<img src='../assets/images/properties/large/noimage.jpg' class='img-fluid' alt='No Property Image' /> ";
						 }
					?>

				</div>
              <div id="bx-pager" class="text-center">
					<?php
					    $targetDir = "../assets/images/properties/large/". $_REQUEST['propertyid'] . "/";
					    if(file_exists($targetDir)) {
						    $files = scandir($targetDir);  
						    $cnt=0;               //1
						    if ( false!==$files ) {
						        foreach ( $files as $file ) {
						            if ( '.'!=$file && '..'!=$file) {       //2
						            	echo "<a data-slide-index='$cnt' class='mr-1' href=''><img src='" . $targetDir . $file . "' alt='Background' style='width:100px;height:50px;' /></a>";
						            	$cnt++;
						            }
						        }
						    }
						}
					?>
			 </div>              
			<hr>
			<div class="card">
				<h4 class="card-header primary-color white-text">Property Details</h4>
				<div class="card-body">
				    	<div class="row ml-2">
							<div class="col-md-6">
								Prop ID: <span><?php echo $property_details['property_id']; ?></span><br>
								Prop Type: <span><?php echo $property_details['property_type']; ?></span><br>
								Area: <span><?php echo $property_details['area']; ?> sq ft</span><br>
								Price: INR. <span><?php echo $property_details['price']; ?></span>
							</div>

							<div class="col-md-6">
								Locality: <span><?php echo $property_details['place']; ?></span><br>
								Building Age: <span><?php echo $property_details['bld_age']; ?></span><br>
								Bedroom: <span><?php echo $property_details['bed_rooms']; ?></span><br>
								Furnished: <span><?php echo $property_details['furnished']; ?>
							</div>
				    	</div>
				    	<hr>
				    	<div class="row mt-3 ml-4">
				    		Address: <?php echo $property_details['address']; ?><br>
				    		Landmark: <?php echo $property_details['landmark']; ?>
				    	</div>
				    	<hr>
				</div>
			</div>            
			<br>
			<div class="card">
				<h4 class="card-header primary-color white-text">Property Description</h4>
				<div class="card-body">
						<p>
							<?php echo $property_details['description']; ?>
						</p>
				</div>
			</div>            
			<br>	  

			<div class="card">
				<h4 class="card-header primary-color white-text">Property Features</h4>
				<div class="card-body">
						<?php

								unset($conditions);
						                $conditions[] = "";
						                $conditions['where'] = array(
						                    'property_id' => $property_details['id']
						                );
						                $property_features = $user->getRows('property_features', $conditions);

							            if($property_features) {
						?>

										<div class="row">
										<br>

						<?php
						                foreach ($property_features as $feature) {
						                	$conditions[]='';
							                $conditions['where'] = array(
							                    'id' => $feature['feature_id']
							                );
							                $conditions['return_type'] = 'single';
						                	$feature_name = $user->getRows('property_features_list', $conditions);
											echo "<div class='col-md-3'><i class='fa fa-check-square fa-lg mr-1 teal-text'> </i>" . $feature_name['title'] . "</div>" ;
										}
									}
						?>
										</div>

				</div>
			</div>
			<br><div class="row justify-content-md-center">
 			<a href="my-properties.php" class="btn btn-unique">My Properties</a>
                  	</div>
		</div>
	</div>
</div>
		<br><br>
                


<!-- Footer
================================================== -->
<!-- Footer
================================================== -->
<?php
include '../footer/footer.php';
?>
<!-- Footer / End -->


<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


<!-- Scripts
================================================== -->

    <!-- JQuery -->
    <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../assets/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../assets/js/mdb.min.js"></script>

    <!-- BX Slider JavaScript -->
    <script type="text/javascript" src="../assets/js/jquery.bxslider.min.js"></script>

    <!-- Animations init-->
    <script>
    new WOW().init();
    </script>
    <script type="text/javascript">
    	$(document).ready(function(){
			  $('.bxslider').bxSlider({
			  	     controls: false,
                    responsive: true,
                    pagerCustom: '#bx-pager'

			  });
		});
    </script>

</div>
<!-- Wrapper / End -->


</body>
</html>


