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

if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}


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
    <!-- CS Select Bootstrap 
    <link href="../assets/css/cs-select.css" rel="stylesheet">
    <link href="../assets/css/cs-skin-border.css" rel="stylesheet">
    -->
    <!-- Bootstrap Select-->
    <link href="../assets/css/bootstrap-select.min.css" rel="stylesheet">
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
<div class="row">

		<!-- Widget -->
		<div class="col-md-4 mt-5">
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
						<li><a href="my-properties.php"><i class="fa fa-files-o"></i> My Properties</a></li>
						<li><a href="submit-property.php" class="current"><i class="fa fa-mail-forward"></i> Submit New Property</a></li>
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

	<!-- Submit Page -->
	<div class="col-md-8">
		<!-- Section heading -->
		    <h2 class="h2-responsive wow fadeIn mt-5">Submit New Property</h2>
		<hr>

		<div class="submit-page">
		<form method="post" action="userAccount.php">		
		<!-- Section -->
		<h3>Basic Information</h3>
		<div class="submit-section">

		
			        <?php echo !empty($statusMsg)?'<div class="notification notice large margin-bottom-10"><p class="'.$statusMsgType.'">'.$statusMsg.'</p></div>':''; ?>
		
            <div class="md-form mt-3">
                <input type="text" id="title" name="property_title" value="" class="form-control" required>
                <label for="title" class="">Property Title</label>
            </div>

			<!-- Row -->
			<div class="row with-forms">

				<!-- Status -->
				<div class="col-md-6">
                    <select data-size="4" class="selectpicker" id="property_status" data-title="Property Status" data-width="100%" name="property_status" required>
					<?php  
					if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
						include 'user.php';
						$user = new User();
						$property_status = $user->getRows("property_status");
                        if(!empty($property_status)): $count = 0; foreach($property_status as $propertystatus): $count++;
                  ?>
	                  <option value="<?php echo $propertystatus['id']; ?>"><?php echo $propertystatus['status']; ?></option>
 	                  <?php endforeach; else: 
 	                  endif; 
 	                  }?>
					</select>
				</div>

				<!-- Type -->
				<div class="col-md-6">
                    <select data-size="7" class="selectpicker" id="property_type" data-title="Property Type" data-width="100%" name="property_type" required>


					</select>
				</div>

			</div>
			<!-- Row / End -->


			<!-- Row -->
			<div class="row mt-4">

				<!-- Price -->
				<div class="col-md-6">
		            <div class="md-form">
		                <input type="text" id="price" name="price" value="" class="form-control" required>
		                <label for="price" class="">Price (INR)</label>
		            </div>
				</div>
				
				<!-- Area -->
				<div class="col-md-6">
		            <div class="md-form">
		                <input type="text" id="area" name="area" value="" class="form-control" required>
		                <label for="area" class="">Area (In Sqft.)</label>
		            </div>
				</div>

			</div>
			<!-- Row / End -->

		</div>
		<!-- Section / End -->

		<!-- Section -->
		<h3>Location</h3>
		<div class="submit-section">

			<!-- Row -->
			<div class="row mt-4">

				<!-- Address -->
				<div class="col-md-12">
		            <div class="md-form">
		                <input type="text" id="address" name="address" value="" class="form-control" required>
		                <label for="address" class="">Address</label>
		            </div>
		        </div>
		    </div>
		    
			<!-- Row -->
			<div class="row mt-4">
				<!-- City -->
				<div class="col-md-6">
                    <select data-size="7" data-live-search="true" class="selectpicker" data-title="Property Locality" data-width="100%" name="property_locality" required>
					<?php  
					if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
						$property_locality = $user->getRows("property_locality");
                        if(!empty($property_locality)): $count = 0; foreach($property_locality as $property_local): $count++;
                  ?>
	                  <option value="<?php echo $property_local['id']; ?>"><?php echo $property_local['locality']; ?></option>
 	                  <?php endforeach; else: 
 	                  endif; 
 	                  }?>
					</select>
				</div>

				<!-- State -->
				<div class="col-md-6">
		            <div class="md-form">
		                <input type="text" id="landmark" name="landmark" value="" class="form-control">
		                <label for="state" class="">Landmark</label>
		            </div>
				</div>


			</div>
			<!-- Row / End -->

		</div>
		<!-- Section / End -->


		<!-- Section -->
		<h3>Detailed Information</h3>
		<div class="submit-section mt-4">
			<!-- Description -->
			<div class="md-form">
				<textarea type="text" class="WYSIWYG md-textarea" name="summary" cols="40" rows="3" id="summary" spellcheck="true" required></textarea>
				<label for="summary">Description</label>
			</div>

			<!-- Row -->
			<div class="row">

				<!-- Age of Home -->
				<div class="col-md-4">
                    <select data-size="4" class="selectpicker" data-title="Building Age (Optional)" data-width="100%" name="building_age">
					<?php  
					if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
						$property_age = $user->getRows("property_age");
                        if(!empty($property_age)): $count = 0; foreach($property_age as $property_age1): $count++;
                  ?>
	                  <option value="<?php echo $property_age1['id']; ?>"><?php echo $property_age1['age_list']; ?></option>
 	                  <?php endforeach; else: 
 	                  endif; 
 	                  }?>
					</select>
				</div>

				<!-- Beds -->
				<div class="col-md-4">
                    <select data-size="4" class="selectpicker" data-title="Bedrooms (Optional)" data-width="100%" name="bedrooms">
					<?php  
					if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
						$property_rooms = $user->getRows("property_rooms");
                        if(!empty($property_rooms)): $count = 0; foreach($property_rooms as $property_room): $count++;
                  ?>
	                  <option value="<?php echo $property_room['id']; ?>"><?php echo $property_room['rooms']; ?></option>
 	                  <?php endforeach; else: 
 	                  endif; 
 	                  }?>
					</select>
				</div>

				<!-- Baths -->
				<div class="col-md-4">
                    <select data-size="4" class="selectpicker" data-title="Furnished (Optional)" data-width="100%" name="furnished">
					<?php  
					if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
						$property_furns = $user->getRows("property_furn");
                        if(!empty($property_furns)): $count = 0; foreach($property_furns as $property_furn): $count++;
                  ?>
	                  <option value="<?php echo $property_furn['id']; ?>"><?php echo $property_furn['name']; ?></option>
 	                  <?php endforeach; else: 
 	                  endif; 
 	                  }?>
					</select>
				</div>

			</div>
			<!-- Row / End -->


			<!-- Checkboxes -->
			<h5 class="mt-4 mb-3">Other Features <span>(optional)</span></h5>
			<div class="checkboxes row">
		
			<?php  
			if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
				$property_features_list = $user->getRows("property_features_list");
                if(!empty($property_features_list)): $count = 0; foreach($property_features_list as $property_feature): $count++;
	        ?>
	          <div class="col-md-3">
			    <div class="form-group">
			        <input type="checkbox" class="filled-in" id="check-<?php echo $property_feature['id']; ?>" name="features[]" value="<?php echo $property_feature['id']; ?>">
			        <label for="check-<?php echo $property_feature['id']; ?>"><?php echo $property_feature['title']; ?></label>
			    </div>
			  </div>
                  <?php endforeach; else: 
                  endif; 
                  }?>		
			</div>
			<!-- Checkboxes / End -->

		</div>
		<!-- Section / End -->
		<?php
			$conditions['where'] = array(
				'id' => $sessData['userID']
			);
			$conditions['return_type'] = 'single';
			$userData = $user->getRows("users",$conditions);
		?>
		<!-- Section -->
		<div class="submit-section mt-4 mb-3">
			<h3>Contact Details</h3>

			<!-- Row -->
			<div class="row mt-4">

				<!-- Name -->
				<div class="col-md-4">
		            <div class="md-form">
		                <input type="text" id="agent_name" name="agent_name" value="<?php echo $userData['full_name']; ?>" class="form-control" readonly>
		                <label for="agent_name" class="">Name</label>
		            </div>
				</div>

				<!-- Email -->
				<div class="col-md-4">
		            <div class="md-form">
		                <input type="text" id="agent_email" name="agent_email" value="<?php echo $userData['email']; ?>" class="form-control" readonly>
		                <label for="agent_email" class="">E-Mail</label>
		            </div>
				</div>

				<!-- Name -->
				<div class="col-md-4">
		            <div class="md-form">
		                <input type="text" id="agent_phone" name="agent_phone" value="<?php echo $userData['phone']; ?>" class="form-control" readonly>
		                <label for="agent_phone" class="">Phone</label>
		            </div>
				</div>

			</div>
			<!-- Row / End -->

		</div>
		<!-- Section / End -->


		<div class="divider"></div>
		<button tye="submit" name="submit-property" class="btn btn-unique">Submit & Upload Gallery <i class="fa fa-arrow-circle-right"></i></button> 
		</form>
		</div>
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
    <!-- CS Select JavaScript 
    <script type="text/javascript" src="../assets/js/classie.js"></script>
    <script type="text/javascript" src="../assets/js/selectFx.js"></script>
    -->
    <!-- Bootstrap Select Javascript -->
    <script type="text/javascript" src="../assets/js/bootstrap-select.min.js"></script>

    <!-- Animations init-->
    <script>
    new WOW().init();
    </script>

		<script>
			(function() {
				$('#property_status').on('changed.bs.select', function (e) {
				  // do something...
				  //alert($('#property_status').val());
					$.ajax({
						type:'POST',
						url:'property-type.php',
						data:'action_type=listproptype&id='+$('#property_status').val(),
						success:function(html){
							$('#property_type').html(html);
							$('#property_type').selectpicker('refresh');
						}
					}); 				  
				});



			})();
		</script>


</div>
<!-- Wrapper / End -->


</body>
</html>