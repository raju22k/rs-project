<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// to get current directory
$curdir=basename(__DIR__);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

if(empty($sessData['userLoggedIn']) && empty($sessData['userID'])){
	    header("Location:index.php");
	    exit();
}

!empty($_SESSION)?session_unset():'';

$sessData['page_type'] = 'edit';
$sessData['status']['type'] = '';
$sessData['status']['msg'] = '';


$_SESSION['sessData'] = $sessData;

include_once "function.php";


//print_r($_SESSION);

?>
<!DOCTYPE html>

<html>
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


<!-- Content
================================================== -->
<div class="container">
	<div class="row top-margin-40">


		<!-- Widget -->
		<div class="col-md-4">
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

			<!--Section-->
			<section class="section extra-margins text-center text-lg-left">

                <!-- Section heading -->
		            <h2 class="h2-responsive wow fadeIn">My Properties</h2>
		        <hr>

<?php
						include 'user.php';
						$user = new User();

						$condition_cnt['return_type'] = 'count';
						$cnt = $user->getRows('all_properties',$condition_cnt);
					
					  if(isset($_GET["page"]))
					  $page = (int)$_GET["page"];
					  else
					  $page = 1;
					
					  $setLimit = 5;
					  $pageLimit = ($page * $setLimit) - $setLimit; 




//		                $conditions['where'] = array(
//		                    'user_id' => $sessData['userID']
//		                );

						//SQL query go here. This query will display all record by setting the Limit.
						$conditions['start'] = $pageLimit;
						$conditions['limit'] = $setLimit;
						unset($conditions['return_type']);

						$property_details = $user->getRows('all_properties', $conditions);
		                if(!empty($property_details)): $count = 0; foreach($property_details as $property_detail): $count++;
?>

			    <!--Grid row-->
			    <div class="row">

			        <!--Grid column-->
			        <div class="col-lg-4 mb-4">
			            <!--Featured image-->
			            <div class="view overlay hm-white-slight z-depth-1-half">
							<?php 
							    $search_dir = "../assets/images/properties/large/" . $property_detail['property_id'];
							    $images = glob("$search_dir/*.*");
							    sort($images);
							    // Image selection and display:

							    //display first image
							    if (count($images) > 0) { // make sure at least one image exists
							        $img = $images[0]; // first image
							        echo "<img src='$img' class='img-fluid' alt='Property Image' /> ";
							    } else {
							        echo "<img src='../assets/images/properties/large/noimage.jpg' class='img-fluid' alt='No Property Image' /> ";
							        // possibly display a placeholder image?
							    }

							?>
			            </div>
			        </div>
			        <!--Grid column-->

			        <!--Grid column-->
			        <div class="col-lg-7 ml-xl-4 mb-4">
			            <!--Excerpt-->
			            <div class="row">
			            <div class="col-md-8">
			            <a href="single-property-page.php?propertyid=<?php echo $property_detail['property_id']; ?>" class="teal-text"><h6 class="pb-1"><i class="fa fa-building"></i><strong> Property ID: <?php echo $property_detail['property_id']; ?> </strong></h6></a>
						</div><div class="col-md-4 text-right">
			                        <a href="" class="pink-text">
										<h6 class="font-weight-bold pb-1">
											<i class="fa fa-image"></i> <?php echo $property_detail['property_status']; ?></h6>
									</a>
							</div>
						</div>
			            <h4 class="mb-3"><strong><?php echo $property_detail['title']; ?></strong></h4>
			            <p>Location: <?php echo $property_detail['place']; ?></p>
						<a class="btn btn-primary btn-sm" href="edit-property.php?propertyid=<?php echo $property_detail['property_id']; ?>"><i class="fa fa-pencil"></i> Edit Details</a>
						<a class="btn btn-primary btn-sm" href="upload-gallery.php?propertyid=<?php echo $property_detail['property_id']; ?>"><i class="fa fa-image"></i> Edit Images</a>
						<a class="btn btn-primary btn-sm" href="delete-property.php?propertyid=<?php echo $property_detail['property_id']; ?>" class="delete"><i class="fa fa-remove"></i> Delete</a>
			        </div>
			        <!--Grid column-->

			    </div>
			    <!--Grid row-->

			    <hr class="mb-5">
<?php 				endforeach; else: 
                  	endif; 
?>

                 	<div class="row justify-content-md-center mt-3">
			            <?php
			            // Call the Pagination Function to load Pagination.
			            echo displayPaginationBelow($setLimit,$page,$cnt);
			            ?>
            		</div>

			</section>
			<!--Section-->
         





			<a href="submit-property.php" class="btn btn-unique">Submit New Property</a>
		</div>

	</div>
</div>


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

    <!-- Animations init-->
    <script>
    new WOW().init();
    </script>



</div>
<!-- Wrapper / End -->


</body>

</html>