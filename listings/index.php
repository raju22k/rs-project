<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// to get current directory
$curdir=basename(__DIR__);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_REQUEST['reset']) && ($_REQUEST['reset']=='true')) {
  session_unset();
}


include '../users/user.php';
$user = new User();

if(!isset($_SESSION['property_status'])) { $_SESSION['property_status']=""; }
if(!isset($_SESSION['property_type'])) { $_SESSION['property_type']=""; }
if(!isset($_SESSION['bedrooms'])) { $_SESSION['bedrooms']=""; }
if(!isset($_SESSION['bathrooms'])) { $_SESSION['bathrooms']=""; }
if(!isset($_SESSION['area_min'])) { $_SESSION['area_min']=""; }
if(!isset($_SESSION['area_max'])) { $_SESSION['area_max']=""; }
if(!isset($_SESSION['price_min'])) { $_SESSION['price_min']=""; }
if(!isset($_SESSION['price_max'])) { $_SESSION['price_max']=""; }

if(!isset($_GET["page"])){
    if(empty($_POST['property_status'])) {
      $_POST['property_status']="";
      $_SESSION['property_status'] ="";
    } else {
      $_SESSION['property_status'] = $_POST['property_status'];
    }

    if(empty($_POST['property_type'])) {
      $_POST['property_type']="";
      $_SESSION['property_type'] ="";
    } else {
      $_SESSION['property_type'] = $_POST['property_type'];
    }

    if(empty($_POST['bedrooms'])) {
      $_POST['bedrooms']="";
      $_SESSION['bedrooms'] ="";
    } else {
      $_SESSION['bedrooms'] = $_POST['bedrooms'];
    }

    if(empty($_POST['bathrooms'])) {
      $_POST['bathrooms']="";
      $_SESSION['bathrooms'] ="";
    } else {
      $_SESSION['bathrooms'] = $_POST['bathrooms'];
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
    if(!empty($_SESSION['property_status'])){
      $conditions['where']['prop_status'] = $_SESSION['property_status'];
     }  
    if(!empty($_SESSION['property_type'])){
      $conditions['where']['type_id'] = $_SESSION['property_type'];
     }  
    if(!empty($_SESSION['bedrooms'])){
      $conditions['where']['bedrooms'] = $_SESSION['bedrooms'];
     }  
    if(!empty($_SESSION['bathrooms'])){
      $conditions['where']['bathrooms'] = $_SESSION['bathrooms'];
     }  
    if(!empty($_SESSION['area_min'])){
      $conditions['where']['floor_area >'] = $_SESSION['area_min'];
     }  
    if(!empty($_SESSION['area_max'])){
      $conditions['where']['floor_area <'] = $_SESSION['area_max'];
     }  
    if(!empty($_SESSION['price_min'])){
      $conditions['where']['price >'] = $_SESSION['price_min'];
     }  
    if(!empty($_SESSION['price_max'])){
      $conditions['where']['price <'] = $_SESSION['price_max'];
     }  
    $conditions['where']['approve_status'] = '2';
    $conditions['return_type'] = 'count';
    $cnt = $user->getRows('property_listings',$conditions);

  if(isset($_GET["page"]))
  $page = (int)$_GET["page"];
  else
  $page = 1;

  $setLimit = 6;
  $pageLimit = ($page * $setLimit) - $setLimit; 


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
    <!-- CS Select Bootstrap -->
    <link href="../assets/css/cs-select.css" rel="stylesheet">
    <link href="../assets/css/cs-skin-border.css" rel="stylesheet">
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


<?php

include '../header/menu.php';

?>

<div class="clearfix"></div>
<!-- Header Container / End -->


    <main>

        <!--Main layout-->
        <div class="container">
            <div class="row">

                <!--Sidebar-->
                <div class="col-lg-4 mt-5">

                    <div class="widget-wrapper wow fadeIn"  data-wow-delay="0.1s">
                        <h4>Search Properties: </h4>
                        <br>
                        <form method="POST" action="index.php" name="searchfrm">

                        <div class="card">
                            <div class="card-body">
							<!-- Row -->
							<div class="row md-form">
								<!-- Status -->
								<div class="col-md-12">
									<select class="cs-select cs-skin-border" name="property_status">
										<option value="" selected>Any Status</option>		
									<?php  
										$property_status = $user->getRows("property_status");
				                        if(!empty($property_status)): $count = 0; foreach($property_status as $propertystatus): $count++;
				                  ?>
					                  <option value="<?php echo $propertystatus['id']; ?>"><?php echo $propertystatus['status']; ?></option>
				 	                  <?php endforeach; else: 
				 	                  endif; 
				 	                  ?>
									</select>
								</div>
							</div>
							<!-- Row / End -->


							<!-- Row -->
							<div class="row md-form">
								<!-- Type -->
								<div class="col-md-12">
									<select class="cs-select cs-skin-border" name="property_type">
										<option value="" selected>Any Type</option>		
									<?php  
										$property_types = $user->getRows("property_types");
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

							<!-- Row -->
							<div class="row md-form">

								<!-- Min Area -->
								<div class="col-md-6">
									<select class="cs-select cs-skin-border" name="bedrooms">
										<option value="" selected>Bedrooms (Any)</span></option>		
									<?php  
										$property_rooms = $user->getRows("property_rooms");
				                        if(!empty($property_rooms)): $count = 0; foreach($property_rooms as $property_room): $count++;
				                  ?>
					                  <option value="<?php echo $property_room['id']; ?>"><?php echo $property_room['rooms']; ?></option>
				 	                  <?php endforeach; else: 
				 	                  endif; 
				 	                  ?>
									</select>
								</div>

								<!-- Max Area -->
								<div class="col-md-6">
									<select class="cs-select cs-skin-border" name="bedrooms">
										<option value="" selected>Bathrooms (Any)</span></option>		
									<?php  
										$property_rooms = $user->getRows("property_rooms");
				                        if(!empty($property_rooms)): $count = 0; foreach($property_rooms as $property_room): $count++;
				                  ?>
					                  <option value="<?php echo $property_room['id']; ?>"><?php echo $property_room['rooms']; ?></option>
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

							<div class="row md-form">
								<div class="col-md-12">
									<button type="submit"  name="search" id="search" class="btn btn-unique">Search</button>
									<button  type="button" name="reset" id="reset" class="btn btn-info" onclick="window.location.assign('index.php?reset=true')">List All</button>
								</div>
							</div>
							</div>
						</div>
						</form>
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

                <!--Main column-->
                <div class="col-lg-8">

                    <!--First row-->
                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                        <div class="col-lg-12">
                            <div class="divider-new">
                                <h2 class="h2-responsive">Property Listings</h2>
                            </div>
                        </div>
                    </div>
                    <!--/.First row-->
<?php

            //SQL query go here. This query will display all record by setting the Limit.
//            $conditions['where']['status'] = "'1'";
            $conditions['start'] = $pageLimit;
            $conditions['limit'] = $setLimit;
            unset($conditions['return_type']);


/*		                $conditions['where'] = array(
		                    'approve_status' => '2'
		                );
		                $conditions['order_by'] = "id DESC";
		                $conditions['limit'] = 3; 
		                $property_details = $user->getRows('property_listings', $conditions); */
		                $property_details = $user->getRows('property_listings',$conditions);
?>

                    <!--Second row-->
                    <div class="row card-deck wow">
<?php
		                if(!empty($property_details)): $count = 0; foreach($property_details as $property_detail): $count++;

		                	if (($count-1 % 2) == 0) {
		                		echo "</div><div class='row card-deck wow'>";
		                	}
?>

                        <!--First columnn-->
                        <div class="col-lg-6 d-flex align-items-stretch mb-4">
                            <!--Card-->
                            <div class="card wow fadeIn" data-wow-delay="0.2s">

						<?php 

							$status_condition['where'] = array(
			                    'id' => $property_detail['prop_status']
			                );
							$status_condition['return_type'] = 'single';
							$property_status = $user->getRows('property_status', $status_condition);

						    $search_dir = "../assets/images/properties/large/" . $property_detail['prop_id'];
						    $images = glob("$search_dir/*.*");
						    sort($images);
						    // Image selection and display:

						    //display first image
						    if (count($images) > 0) { // make sure at least one image exists
						        $img = $images[0]; // first image
						        echo "<img class='img-fluid' src='$img' alt='' /><div class='ribbon'><span>" . $property_status['status'] . "</span></div>";
						    } else {
						    	echo "<img class='img-fluid' src='../assets/images/properties/large/noimage.jpg' alt='No Image' /><div class='ribbon'><span>" . $property_status['status'] . "</span></div>";
						        // possibly display a placeholder image?
						    }

						?>
							    <div class="card-body">
							        <!--Title-->
							        <h4 class="card-title"><?php echo $property_detail['title']; ?></h4>
									<p class="card-text">Property ID: <?php echo $property_detail['prop_id']; ?></p>
									<p class="card-text">Locality: <?php echo $property_detail['address_city']; ?></p>
									<p class="card-text">Area: <?php echo $property_detail['floor_area']; ?></p>
									<p class="card-text">Price: INR. <?php echo $property_detail['price']; ?></p>

							        <a href="single-property-page.php?propertyid=<?php echo $property_detail['prop_id']; ?>" class="btn btn-primary">Details</a>
							    </div>


							    <div class="card-footer text-muted">
								    Posted on: <?php echo date_format(date_create($property_detail['created']),"d-M-Y"); ?>
								</div>

                            </div>
                            <!--/.Card-->
                        </div>
                        <!--First columnn-->
<?php 				

					endforeach; else: 
                  	endif; 
?>


                    </div>
                    <!--/.Second row-->
                 	<div class="row justify-content-md-center mt-3">
			            <?php
			            // Call the Pagination Function to load Pagination.
			            echo displayPaginationBelow($setLimit,$page,$cnt);
			            ?>
            		</div>
                </div>
                <!--/.Main column-->

            </div>
        </div>
        <!--/.Main layout-->

    </main>




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
    <!-- CS Select JavaScript -->
    <script type="text/javascript" src="../assets/js/classie.js"></script>
    <script type="text/javascript" src="../assets/js/selectFx.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../assets/js/mdb.min.js"></script>

    <!-- Animations init-->
    <script>
    new WOW().init();
    </script>
		<script>
			(function() {
				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx(el);
				} );
			})();
		</script>
</div>
<!-- Wrapper / End -->


</body>
</html>