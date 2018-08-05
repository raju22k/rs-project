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

<?php

include '../header/menu.php';

?>


<div class="clearfix"></div>



<!-- Content
================================================== -->
<div class="container">
<!--        <div class="divider-new pt-5">
            <h2 class="h2-responsive wow fadeIn" data-wow-delay="0.2s">Services Offered</h2>
        </div>
	<div class="row">
            <h1>How Can I help You?</h1>
            Chennai was a wonderful place to live in. Navaraj Real Estate hunt could quite easily start with looking for the real estate prices (i.e. average prices) so as to gauge what kind of house and location will fit your budget. This is assuming that you have already estimated how much you can afford to spend on that Navaraj real estate piece that you are so much after. <br><br>
            With little effort you can easily find out the Navaraj real estate prices. You can do this in a lot of different ways. One way is to directly give a call to a us and ask about what kind of house you can get within your budget (if you are looking for investment purposes). <br><br>
            However, if you are looking for property because you actually want to live in Chennai (and enjoy your life), then you would be better off starting with your most basic requirements from a house e.g. you could specify a 1 bedroom house or a condo or whatever, if that is the minimum space you would need to be able to live in comfortably with your partner or your family etc. <br><br>
            I would perform inspection of your property and discuss the complete process with you. I would also provide with a thorough market analysis, which will inform you of recent sales in your area and a suggested listing price. I would discuss with you the best marketing strategy suited to your particular property, rather than conform your property to a standard marketing plan. 
	</div> -->
<!--Section: Blog v.1-->
<section class="py-4 text-center text-lg-left">

    <!--Section heading-->
    <h1 class="h1 font-weight-bold text-center mb-5 pt-4">Services Offered</h1>
    <!--Section description-->

    <!--Grid row-->
    <div class="row">

        <!--Grid column-->
        <div class="col-lg-5 col-xl-5 pb-3">
            <!--Featured image-->
            <div class="view overlay rounded z-depth-2">
                <img src="../assets/images/page_images/site-inspection.jpg" alt="Property Site Inspection"
                    class="img-fluid">
                <a>
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-7 col-xl-7">
            <!--Excerpt-->
            <h3 class="mb-4 font-weight-bold dark-grey-text">
                <strong>All Real Estate Services</strong>
            </h3>
            <p>We would do all type of real estate services in Central Chennai in and around Nungambakkam and Choolaimedu. 
            We do complete services for our clients who were willing to buy or sell properties in central Chennai.</p>
        </div>
        <!--Grid column-->

    </div>
    <!--Grid row-->

    <hr class="mb-5 mt-5 pb-3">

    <!--Grid row-->
    <div class="row">

        <!--Grid column-->
        <div class="col-lg-7 col-xl-7 pb-3">
            <!--Excerpt-->
            <h3 class="mb-4 font-weight-bold dark-grey-text">
                <strong>Property Management Services</strong>
            </h3>
            <p>Once the deal was over our relationship still continues. We are happy to assist our clients on any type of challenges regarding the properties occured after the real estate deal was over.</p>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-5 col-xl-5 mb-5">
            <!--Featured image-->
            <div class="view overlay rounded z-depth-2">
                <img src="../assets/images/page_images/after-deal-service.jpg" alt="After Deal Service"
                    class="img-fluid">
                <a>
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>
        </div>
        <!--Grid column-->

    </div>
    <!--Grid row-->

    <hr class="mb-5 mt-4 pb-3">

    <!--Grid row-->
    <div class="row pb-5">

        <!--Grid column-->
        <div class="col-lg-5 col-xl-5 pb-3">
            <!--Featured image-->
            <div class="view overlay rounded z-depth-2">
                <img src="../assets/images/page_images/documentation.jpg" alt="Documentation" class="img-fluid">
                <a>
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-7 col-xl-7">
            <!--Excerpt-->
            <h3 class="mb-4 font-weight-bold dark-grey-text">
                <strong>Documentaion Services</strong>
            </h3>
            <p>We help our clients on all kinds documentation that are required for any type of real estate dealings.</p>
        </div>
        <!--Grid column-->
    </div>
    <!--Grid row-->

    <hr class="mb-5 mt-5 pb-3">

    <!--Grid row-->
    <div class="row">

        <!--Grid column-->
        <div class="col-lg-7 col-xl-7 pb-3">
            <!--Excerpt-->
            <h3 class="mb-4 font-weight-bold dark-grey-text">
                <strong>Legal Services</strong>
            </h3>
            <p>We help our clients to verify the authenticity of the legal documents such as title deeds, sale deeds, construction agreements, tenancy documentation, mortgage documents. etc.</p>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-5 col-xl-5 mb-5">
            <!--Featured image-->
            <div class="view overlay rounded z-depth-2">
                <img src="../assets/images/page_images/legal-verification.jpg" alt="Legal Verification"
                    class="img-fluid">
                <a>
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>
        </div>
        <!--Grid column-->

    </div>
    <!--Grid row-->

        


</section>
<!--Section: Blog v.1-->
</div>


            
        






<?php
include '../contact/contact-form.php';
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