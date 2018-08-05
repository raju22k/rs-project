<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// to get current directory
$curdir=basename(__DIR__);

?>

<!DOCTYPE html>
<html lang="en">

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

<?php

include '../header/menu.php';

?>


<div class="view intro intro-bg hm-white-light">
    <div class="full-bg-img">
        <div class="container">
            <div class="d-flex align-items-center d-flex justify-content-center" style="height: 500px">
                <div class="row">
                    <div class="col-md-12 wow fadeIn mb-3">
                        <div class="intro-info-content text-center">
<!--                            <h1 class="display-1 mb-2 wow fadeInDown" data-wow-delay="0.3s"><p class="pink-text">SquareFeetIndia.com</p></h1> -->
                            <h2 class="font-up mb-2 font-bold wow fadeIn" data-wow-delay="0.2s">
                            <p class="pink white-text pb-2 pt-2 pr-2 pl-2">Real Estate and Property Management Services</p></h2>
                            <a class="btn btn-indigo btn-lg wow fadeIn" data-wow-delay="0.2s" href="../properties-for-sale-in-chennai">Sale</a> <a class="btn btn-dark-green btn-lg wow fadeIn" data-wow-delay="0.2s" href="../properties-for-rent-in-chennai">Rent</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Content
================================================== -->
<div class="container">
        <div class="divider-new pt-5">
            <h2 class="h2-responsive wow fadeIn" data-wow-delay="0.2s">Recent Properties</h2>
        </div>
   		<div class="card-deck row wow">


<?php
						include '../users/user.php';
						$user = new User();
//		                $conditions['where'] = array(
//		                    'approve_status' => '2'
//		                );
						$conditions['order_by'] = "id DESC";
		                $conditions['limit'] = 3;
		                $property_details = $user->getRows('all_properties', $conditions);
		                if(!empty($property_details)): $count = 0; foreach($property_details as $property_detail): $count++;
?>

                <div class="col-md-4 d-flex align-items-stretch mb-4">
				<!--Card-->
				<div class="card wow fadeIn" data-wow-delay="0.1s">

				    <!--Card image-->
						<?php 
							
							if ($property_detail['property_status'] === "RENT") {
								$prop_folder = "properties-for-rent-in-chennai";
							} else {
								$prop_folder = "properties-for-sale-in-chennai";							
							}

						    $search_dir = "../assets/images/properties/large/" . $property_detail['property_id'];

						    $images = glob("$search_dir/*.*");
						    sort($images);
						    // Image selection and display:

						    //display first image
						    if (count($images) > 0) { // make sure at least one image exists
						        $img = $images[0]; // first image
						        echo "<a href=../" . $prop_folder . "/single-property-page.php?propertyid=" . $property_detail['property_id'] . "><img class='img-fluid' src='$img' alt='' /></a><div class='prop-status'>" . $property_detail['property_status'] . "</div>";
						    } else {
						    	echo "<a href=../" . $prop_folder . "/single-property-page.php?propertyid=" . $property_detail['property_id'] . "><img class='img-fluid' src='../assets/images/properties/large/noimage.jpg' alt='No Image' /></a><div class='prop-status'>" . $property_detail['property_status'] . "</div>";
						        // possibly display a placeholder image?
						    }

						?>
				    <!--Card content-->
				    <div class="card-body">
				        <!--Title-->
				        <h4 class="card-title"><a href="../<?php echo  $prop_folder ?>/single-property-page.php?propertyid=<?php echo $property_detail['property_id']; ?>" class="black-text"><?php  
				        	if (strlen($property_detail['title']) <= 20)   
				        		echo $property_detail['title']; 
				        	else
				        		echo substr($property_detail['title'],0,17) . '...';
				        		?>
				        
				        </a></h4>
				        <hr style="margin-top:0">
				        <div class="row">
				        <div class="col-md-6">
						<p class="card-text" style="margin-bottom:2px"><?php echo $property_detail['area']; ?> SqFt.</p>
						</div><div class="col-md-6">
						<p class="card-text" style="margin-bottom:2px">&#8377; <?php echo $property_detail['price']; ?></p>
						</div></div>
				    </div>


				    <div class="card-footer text-muted">
					    <?php echo $property_detail['place']; ?>
					</div>

				</div>
				<!--/.Card-->
			</div>

<?php 				endforeach; else: 
                  	endif; 
?>

		</div>


<?php
include '../contact/contact-form.php';
?>


</div>



<?php
include '../footer/footer.php';
?>


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