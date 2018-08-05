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

      <div class="container">
        <div class="divider-new pt-2">
            <h2 class="h2-responsive wow fadeIn" data-wow-delay="0.2s">About</h2>
        </div>

			<!--Section: Features v.3-->
			<section>

				<!--Grid row-->
				<div class="row pt-2">


				<!--Grid column-->
				<div class="col-lg-7">

					<!--Grid row-->
					<div class="row pb-3">
					<div class="col-2 col-md-1">
						<i class="fa fa-mail-forward fa-lg indigo-text"></i>
					</div>
					<div class="col-10">
						<h5 class="font-weight-bold text-left mb-3 dark-grey-text">Experience</h5>
						<p class="grey-text text-left">Had been a full time real estate agent since 2002. <br>Having experience and local know-how in the field of real estate dealings in central chennai in and around Nungambakkam and Choolaimedu.</p>
					</div>
					</div>
					<!--Grid row-->

					<!--Grid row-->
					<div class="row pb-3">
					<div class="col-2 col-md-1">
						<i class="fa fa-mail-forward fa-lg indigo-text"></i>
					</div>
					<div class="col-10">
						<h5 class="font-weight-bold text-left mb-3 dark-grey-text">Expertise</h5>
						<p class="grey-text text-left">Expertise in both Residential and Commercial property sales and rent. <br>Exceptional knowledge and skills in negotiation, analysis of property values and market trends.</p>
					</div>
					</div>
					<!--Grid row-->


				</div>
				<!--Grid column-->

				<!--Grid column-->
				<div class="col-lg-5 text-center text-lg-left">
					<img src="../assets/images/page_images/documentation.jpg" alt="" class="img-fluid z-depth-0">
				</div>
				<!--Grid column-->

				</div>
				<!--Grid row-->

			</section>
			<!--Section: Features v.3-->




      </div>



            





<?php
include '../contact/contact-form.php';
?>


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

</div>
<!-- Wrapper / End -->


</body>

</html>