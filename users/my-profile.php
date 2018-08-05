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

if($sessData['user_role']==1) {
	    header("Location:../admin-user/my-profile.php");
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
						<li><a href="my-profile.php" class="current"><i class="fa fa-user"></i> My Profile</a></li>
					</ul>
					
					<ul class="my-account-nav">
						<li class="sub-nav-title">Manage Listings</li>
						<li><a href="my-properties.php"><i class="fa fa-files-o"></i> My Properties</a></li>
						<li><a href="submit-property.php"><i class="fa fa-mail-forward"></i> Submit New Property</a></li>
					</ul>

					<ul class="my-account-nav">
						<li><a href="change-password.php"><i class="fa fa-lock"></i> Change Password</a></li>
						<li><a href="userAccount.php?logoutSubmit=1"><i class="fa fa-power-off"></i> Log Out</a></li>
					</ul>

				</div>

			</div>
		</div>

		<div class="col-md-8">

		        <?php
					if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
						include 'user.php';
						$user = new User();
						$conditions['where'] = array(
							'id' => $sessData['userID']
						);
						$conditions['return_type'] = 'single';
						$userData = $user->getRows("users",$conditions);
						$conditions="";
						$conditions['where'] = array(
							'user_id' => $sessData['userID'],
						);
						$conditions['return_type'] = 'single';
						$userProfile = $user->getRows("user_profile",$conditions);

						if(empty($userData['full_name']) && empty($userProfile['title']) && empty($userProfile['phone']) && empty($userData['email'])) {
							$statusMsg = "Full Name, Title, Phone and Email are mandatory to manage property listings.";
						}

				?>

           <section id="team" class="section team-section pb-4 wow fadeIn" data-wow-delay="0.3s">

                <!-- Section heading -->
		        <div class="divider-new">
		            <h2 class="h2-responsive wow fadeIn">My Profile</h2>
		        </div>
                <!-- Grid row -->
                <div class="row mb-lg-4 center-on-small-only">

                    <!-- Grid column -->
                    <div class="col-md-12 mb-r">

                        <div class="col-md-4 float-left">
                            <div class="avatar edit-profile-photo">
		 						<?php if (!empty($userProfile['image']) && file_exists("../assets/images/agents/" . $userProfile['image'])) {    ?>
								<img src="../assets/images/agents/<?php echo $userProfile['image']; ?>" class="z-depth-1" id="imgholder" width="590" alt="">
								<?php } else {  ?>
								<img src="../assets/images/agents/default_avatar.jpg" class="z-depth-1" id="imgholder" alt="">
								<?php } ?>
								<div class="change-photo-btn">
									<div class="photoUpload">
									    <span><i class="fa fa-upload"></i> Upload Photo</span>
									    <input type="file" accept=".jpg" name="fileupload" class="upload" id="fileupload" />
									    <input type="hidden" name="agentfilename" id="agentfilename" value="<?php echo $userProfile['image']; ?>" />
									</div>
								</div>
                            </div>
                        </div>

                        <div class="col-md-8 float-right">
                            <h4 class="mb-4"><strong><?php echo $userData['full_name']; ?></strong></h4>
                            <p class="grey-text"><i class="fa fa-mobile-phone"> </i>&nbsp;&nbsp;<?php echo $userData['phone']; ?></p>
                            <p class="grey-text"><i class="fa fa-envelope"> </i>&nbsp;&nbsp;<?php echo $userData['email']; ?></p>

                            <!-- Facebook -->
                            <a href="<?php echo $userProfile['facebook']; ?>" class="icons-sm fb-ic"><i class="fa fa-facebook"> </i></a>
                            <!-- Twitter -->
                            <a href="<?php echo $userProfile['twitter']; ?>" class="icons-sm tw-ic"><i class="fa fa-twitter"> </i></a>
                            <!-- Google Plus -->
                            <a href="<?php echo $userProfile['google']; ?>" class="icons-sm gplus-ic"><i class="fa fa-google-plus"> </i></a>
                            <!-- Linked In -->
                            <a href="<?php echo $userProfile['linkedin']; ?>" class="icons-sm li-ic"><i class="fa fa-linkedin"> </i></a>
                            <br />

                            <button type="button" class="btn btn-unique" data-toggle="modal" data-target="#editform">Edit Details</button>

                        </div>

                    </div>
                    <!-- Grid column -->
              	</div>
             </section>

				<?php } ?>

			<!-- Modal -->
			<div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="editformdetail" aria-hidden="true">
			    <div class="modal-dialog modal-notify modal-info" role="document">
			        <div class="modal-content">
			            <div class="modal-header">
			            	<p class="heading">Edit Details</p>
				            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true" class="white-text">&times;</span>
			                </button>
			            </div>
						<form method="post" class="profile-edit-form" action="userAccount.php">
			            <div class="modal-body">

								<div class="md-form form-sm">
								    <i class="fa fa-user prefix"></i>
								    <input type="text" name="agent_name" id="username" class="form-control validate" value="<?php echo $userData['full_name']; ?>" required>
								</div>


								<div class="md-form form-sm">
								    <i class="fa fa-bars prefix"></i>
								    <input type="text" name="title" id="title" class="form-control validate" value="<?php echo $userProfile['title']; ?>" required>
								</div>

								<div class="md-form form-sm">
								    <i class="fa fa-mobile-phone prefix"></i>
								    <input type="text" name="phone" id="phone" class="form-control validate" value="<?php echo $userData['phone']; ?>" required>
								</div>

								<div class="md-form form-sm">
								    <i class="fa fa-envelope prefix"></i>
								    <input type="email" name="email" id="email" class="form-control" value="<?php echo $userData['email']; ?>" readonly>
								</div>

								<div class="md-form form-sm">
								    <i class="fa fa-facebook-square prefix"></i>
								    <input type="text" name="facebook" id="facebook" class="form-control validate" value="<?php echo $userProfile['facebook']; ?>">
								</div>


								<div class="md-form form-sm">
								    <i class="fa fa-twitter prefix"></i>
								    <input type="text" name="twitter" id="twitter" class="form-control validate" value="<?php echo $userProfile['twitter']; ?>">
								</div>

								<div class="md-form form-sm">
								    <i class="fa fa-google-plus prefix"></i>
								    <input type="text" name="google" id="google" class="form-control validate" value="<?php echo $userProfile['google']; ?>">
								</div>

								<div class="md-form form-sm">
								    <i class="fa fa-linkedin prefix"></i>
								    <input type="text" name="linkedin" id="linkedin" class="form-control validate" value="<?php echo $userProfile['linkedin']; ?>">
								</div>
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			                <button type="submit" name="editaccount" class="btn btn-primary">Save changes</button>
			            </div>
			        	</form>
			        </div>
			    </div>
			</div>

		</div>

	</div>
</div>

<div class="clearfix"></div>
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

<script type="text/javascript">
	
$(function(){

/*	$("#drop-box").click(function(){
		$("#upl").click();

	});
*/
	// To prevent Browsers from opening the file when its dragged and dropped on to the page
	$(document).on('drop dragover', function (e) {
        e.preventDefault();
    }); 

	// Add events
	$('input[type=file]').on('change', fileUpload); 

	// File uploader function

	function fileUpload(event){  
		files = event.target.files;
		var data = new FormData();
		var error = 0;
		for (var i = 0; i < files.length; i++) {
  			var file = files[i];
 // 			console.log(file.size);
			if(!file.type.match('image.*')) {
		   		alert("select only images");
		   		error="1";
		  	}else if(file.size > 1048576){
		  		alert("file size was more than 1 MB");
		   		error="2";
		  	}else{
		  		data.append('image', file, document.getElementById('fileupload').value);
		  		data.append('agentfilename', document.getElementById('agentfilename').value);
		  	}
	 	}
	 	if(!error){
		 	var xhr = new XMLHttpRequest();
		 	xhr.open('POST', 'userimageupload.php', true);
		 	xhr.send(data);
		 	xhr.responseType = 'text';

		 	xhr.onload = function () {
				if (xhr.status === 200) {
					document.location.reload();
            	} else {
					alert("error upload");
				}
			};
		}
	}

});

</script>


</div>
<!-- Wrapper / End -->

</body>
</html>