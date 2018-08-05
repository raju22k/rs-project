<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// to get current directory
$curdir=basename(__DIR__);

if(empty($_REQUEST['propertyid'])) {
	header("Location:index.php");
	exit();
} 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../users/user.php';
$user = new User();

$conditions[]='';
$conditions['where'] = array(
    'property_id' => $_REQUEST['propertyid']
    );

$conditions['return_type'] = 'single';
$property_details = $user->getRows('all_properties', $conditions);

if(empty($property_details)) {
	header("Location:properties-for-rent-in-chennai.php");
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
    <!-- Bootstrap Select-->
    <link href="../assets/css/bootstrap-select.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <style type="text/css">
    	
        .widget-wrapper {
            padding-bottom: 2rem;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 2rem;
        }
        .card {
            font-weight: 300;
        }


    </style>


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
                <!--Sidebar-->
                <div class="col-lg-4 mt-5">

                    <div class="widget-wrapper wow fadeIn"  data-wow-delay="0.1s">
                        <h4>Search Properties: </h4>
                        <br>
                        <div class="card">
                        	<div class="card-body modal-c-tabs">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs nav-justified indigo" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#for-rent" role="tab">Rent</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#for-sale" role="tab">Sale</a>
									</li>
								</ul>
								<!-- Tab panels -->
								<div class="tab-content">
									<!--Panel 1-->
									<div class="tab-pane fade in show active" id="for-rent" role="tabpanel">
										<br>
										<form method="POST" action="../properties-for-rent-in-chennai/properties-for-rent-in-chennai.php" name="searchfrm">

										  <!-- Locality -->
										  <div class="row">
											<div class="col-md-12">
											<select data-size="7" data-live-search="true" class="selectpicker" data-title="Property Area" data-width="100%" name="property_locality">
											  <option value="" selected>Select Area</option>   
											<?php  
											  $property_locality = $user->getRows("property_locality");
														  if(!empty($property_locality)): $count = 0; foreach($property_locality as $property_local): $count++;
													?>
													  <option value="<?php echo $property_local['locality']; ?>"><?php echo $property_local['locality']; ?></option>
													  <?php endforeach; else: 
													  endif; 
													  ?>
											</select>
										  </div>
										  </div>


										<!-- Row -->
										<div class="row">
										  <!-- Type -->
										  <div class="col-md-12">
											<select data-size="7" data-live-search="true" class="selectpicker" data-title="Property Type" data-width="100%" name="property_type">
											  <option value="" selected>Select Property Type</option>   
											<?php  
											   $prop_condition['where']['prop_status'] = '1'; //RENT 
											  $property_types = $user->getRows("property_types", $prop_condition);
														  if(!empty($property_types)): $count = 0; foreach($property_types as $property_type): $count++;
													?>
													  <option value="<?php echo $property_type['id']; ?>"><?php echo $property_type['title']; ?></option>
													  <?php endforeach; else: 
													  endif; 
													  ?>
											</select>
										  </div>
										</div>
										<!-- Row / End -->


										<label>Area Range (in Sqft.)</label>
										<div class="row md-form">
										  <!-- Area Range -->
										  <div class="col-md-6">
													<div class="md-form">
														<input type="text" id="area_min" name="area_min" value="" class="form-control">
														<label for="area_min" class="">Min Sqft.</label>
													</div>
										  </div>

										  <div class="col-md-6">
													<div class="md-form">
														<input type="text" id="area_max" name="area_max" value="" class="form-control">
														<label for="area_max" class="">Max Sqft.</label>
													</div>
										  </div>

										</div>

										<label>Price Range (in INR)</label>
										<div class="row md-form">
										  <!-- Area Range -->
										  <div class="col-md-6">
													<div class="md-form">
														<input type="text" id="price_min" name="price_min" value="" class="form-control">
														<label for="price_min" class="">Min INR.</label>
													</div>
										  </div>

										  <div class="col-md-6">
													<div class="md-form">
														<input type="text" id="price_max" name="price_max" value="" class="form-control">
														<label for="price_max" class="">Max INR.</label>
													</div>
										  </div>

										</div>
										<hr>
										<div class="row md-form">
										  <div class="col-md-12"><center>
											<button type="submit"  name="search" id="search" class="btn btn-unique">Search</button>
											<button  type="button" name="reset" id="reset" class="btn btn-info" onclick="window.location.assign('properties-for-sale-in-chennai.php')">List All</button></center>
										  </div>
										</div>

									  </form>
									</div>
									<!--/.Panel 1-->

									<!--Panel 2-->
									<div class="tab-pane fade" id="for-sale" role="tabpanel">
										<br>
										<form method="POST" action="properties-for-sale-in-chennai.php" name="searchfrm">

										  <!-- Locality -->
										  <div class="row">
											<div class="col-md-12">
											<select data-size="7" data-live-search="true" class="selectpicker" data-title="Property Area" data-width="100%" name="property_locality">
											  <option value="" selected>Select Area</option>   
											<?php  
											  $property_locality = $user->getRows("property_locality");
														  if(!empty($property_locality)): $count = 0; foreach($property_locality as $property_local): $count++;
													?>
													  <option value="<?php echo $property_local['locality']; ?>"><?php echo $property_local['locality']; ?></option>
													  <?php endforeach; else: 
													  endif; 
													  ?>
											</select>
										  </div>
										  </div>


										<!-- Row -->
										<div class="row">
										  <!-- Type -->
										  <div class="col-md-12">
											<select data-size="7" data-live-search="true" class="selectpicker" data-title="Property Type" data-width="100%" name="property_type">
											  <option value="" selected>Select Property Type</option>   
											<?php  
											   $prop_condition['where']['prop_status'] = '2'; //SALE 
											  $property_types = $user->getRows("property_types", $prop_condition);
														  if(!empty($property_types)): $count = 0; foreach($property_types as $property_type): $count++;
													?>
													  <option value="<?php echo $property_type['id']; ?>"><?php echo $property_type['title']; ?></option>
													  <?php endforeach; else: 
													  endif; 
													  ?>
											</select>
										  </div>
										</div>
										<!-- Row / End -->


										<label>Area Range (in Sqft.)</label>
										<div class="row md-form">
										  <!-- Area Range -->
										  <div class="col-md-6">
													<div class="md-form">
														<input type="text" id="area_min" name="area_min" value="" class="form-control">
														<label for="area_min" class="">Min Sqft.</label>
													</div>
										  </div>

										  <div class="col-md-6">
													<div class="md-form">
														<input type="text" id="area_max" name="area_max" value="" class="form-control">
														<label for="area_max" class="">Max Sqft.</label>
													</div>
										  </div>

										</div>

										<label>Price Range (in INR)</label>
										<div class="row md-form">
										  <!-- Area Range -->
										  <div class="col-md-6">
													<div class="md-form">
														<input type="text" id="price_min" name="price_min" value="" class="form-control">
														<label for="price_min" class="">Min INR.</label>
													</div>
										  </div>

										  <div class="col-md-6">
													<div class="md-form">
														<input type="text" id="price_max" name="price_max" value="" class="form-control">
														<label for="price_max" class="">Max INR.</label>
													</div>
										  </div>

										</div>
										<hr>
										<div class="row md-form">
										  <div class="col-md-12"><center>
											<button type="submit"  name="search" id="search" class="btn btn-unique">Search</button>
											<button  type="button" name="reset" id="reset" class="btn btn-info" onclick="window.location.assign('properties-for-sale-in-chennai.php')">List All</button></center>
										  </div>
										</div>

									  </form>
									</div>
									<!--/.Panel 2-->
								</div>
							</div>
						</div>
                    </div>

                    <div class="widget-wrapper wow fadeIn" data-wow-delay="0.2s">
                        <h4>My Contact:</h4>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <p><u>My Contact Details</u></p>
                                <p>Please reference the property Id if related to listed properties.</p>
                                <p>Phone: 1233455</p>
                                <p>Email: ran@r.com</p>

                            </div>
                        </div>
                    </div>

                </div>
                <!--/.Sidebar-->

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
						    } else {
							        echo "<img src='../assets/images/properties/large/noimage.jpg' class='img-fluid' alt='No Property Image' /> ";						    	
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
       			<a href="javascript:history.back()" class="btn btn-unique">Back to Listings</a></div>
                  
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
    <!-- Bootstrap Select Javascript -->
    <script type="text/javascript" src="../assets/js/bootstrap-select.min.js"></script>

    <!-- Animations init-->
    <script>
    new WOW().init();
    </script>
		<script>
			(function() {
			})();
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


