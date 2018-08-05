<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// to get current directory
$curdir=basename(__DIR__);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'search-sess-set.php'

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


<?php

include '../header/menu.php';

?>


<div class="clearfix"></div>
<!-- Header Container / End -->


    <main>

        <!--Main layout-->
        <div class="container">
            <div class="row col-lg-12">


                <!--Main column-->
                <div class="col-lg-12">

                    <!--First row-->
                    <div class="row wow fadeIn" data-wow-delay="0.4s">
                        <div class="col-lg-12">
                            <div class="divider-new">
                                <h2 class="h2-responsive">Properties for sale in Chennai</h2>
                            </div>
                        </div>
                    </div>
                    <!--/.First row-->


<?php

            //SQL query go here. This query will display all record by setting the Limit.
            $conditions['start'] = $pageLimit;
            $conditions['limit'] = $setLimit;
            unset($conditions['return_type']);
            $conditions['where']['property_status'] = 'SALE'; // SALE
		        $property_details = $user->getRows('all_properties',$conditions);
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
                        <div class="col-lg-4 d-flex align-items-stretch mb-4">
                            <!--Card-->
                            <div class="card wow fadeIn" data-wow-delay="0.2s">

								<!--Card image-->
									<?php 

										$search_dir = "../assets/images/properties/large/" . $property_detail['property_id'];

										$images = glob("$search_dir/*.*");
										sort($images);
										// Image selection and display:

										//display first image
										if (count($images) > 0) { // make sure at least one image exists
											$img = $images[0]; // first image
											echo "<a href=single-property-page.php?propertyid=" . $property_detail['property_id'] . "><img class='img-fluid' src='$img' alt='' /></a><div class='prop-status'>" . $property_detail['property_status'] . "</div>";
										} else {
											echo "<a href=single-property-page.php?propertyid=" . $property_detail['property_id'] . "><img class='img-fluid' src='../assets/images/properties/large/noimage.jpg' alt='No Image' /></a><div class='prop-status'>" . $property_detail['property_status'] . "</div>";
											// possibly display a placeholder image?
										}

									?>
								<!--Card content-->
								<div class="card-body">
									<!--Title-->
									<h4 class="card-title"><a href="single-property-page.php?propertyid=<?php echo $property_detail['property_id']; ?>" class="black-text"><?php  
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


<div class="sticky-container">
    <ul class="sticky">
        <li>
            <img src="data:image/png;base64,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" width="30" height="30">
            <p><a href="" data-toggle="modal" data-target="#orangeModalSubscription">Search Property</a></p>
        </li>
        <li>
           <img src="data:image/png;base64,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" width="30" height="30">           
           <p><a href="../contact" target="_blank">Contact Us</a></p>
        </li>
    </ul>
</div>



<?php

//include 'search-form.php';

include 'search-form.php';

?>








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
    <!-- Bootstrap Select Javascript -->
    <script type="text/javascript" src="../assets/js/bootstrap-select.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../assets/js/mdb.min.js"></script>

    <!-- Animations init-->
    <script>
    new WOW().init();
    </script>
		<script>
			(function() {
			})();
		</script>
</div>
<!-- Wrapper / End -->


</body>
</html>