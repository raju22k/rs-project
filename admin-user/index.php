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
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}


!empty($sessData['userLoggedIn'])?header("Location:my-profile.php"):'';

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
    <link rel="stylesheet" href="http://rs.solorix.com/assets/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="http://rs.solorix.com/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="http://rs.solorix.com/assets/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="http://rs.solorix.com/assets/css/style.css" rel="stylesheet">
</head>

<body>

<!-- Wrapper -->
<div id="wrapper">





<!--Modal: Login / Register Form-->
<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Modal cascading tabs-->
            <div class="modal-c-tabs">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs tabs-2 default-color-dark darken-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fa fa-user mr-1"></i> Login</a>
                    </li>
                </ul>

                <!-- Tab panels -->
                <div class="tab-content">
                    <!--Panel 7-->
                    <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                   <?php if(!empty($statusMsg)) { ?>
						<div class="alert danger-color alert-dismissible fade show mr-4 ml-4" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
				        <?php echo $statusMsg; ?>
						</div>   
					<?php } ?>     
                        <!--Body-->
                        <div class="modal-body mb-1">
						<form method="post" class="login" action="userAccount.php">
                            <div class="md-form form-sm">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="email" name="email" id="email" class="form-control">
                                <label for="email">Your email</label>
                            </div>

                            <div class="md-form form-sm">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" name="password" class="form-control">
                                <label for="password">Your password</label>
                            </div>
                            <div class="text-center mt-2">
                                <button type="submit"  name="loginSubmit" class="btn btn-unique">Log in <i class="fa fa-sign-in ml-1"></i></button>
                            </div>
                        </form>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <div class="text-left mt-1">
                                <p>Forgot <a href="#" class="blue-text">Password?</a></p>
                            </div>
                        </div>

                    </div>
                    <!--/.Panel 7-->

                </div>

            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Login / Register Form-->


<!-- Scripts
================================================== -->
    <!-- JQuery -->
    <script type="text/javascript" src="http://rs.solorix.com/assets/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="http://rs.solorix.com/assets/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="http://rs.solorix.com/assets/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="http://rs.solorix.com/assets/js/mdb.min.js"></script>

<script type="text/javascript">
    $(window).on('load',function(){
    	$('#modalLRForm').modal({
		    backdrop: 'static',
		    keyboard: false
		});
        $('#modalLRForm').modal('show');

    });
</script>

    <!-- Animations init-->
    <script>
    new WOW().init();
    </script>





</div>
<!-- Wrapper / End -->


</body>
</html>