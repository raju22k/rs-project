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
    <!-- BX Slider Bootstrap -->
    <link href="../assets/css/jquery.bxslider.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../assets/css/style.css" rel="stylesheet">
	<link href="datatables/dataTables.min.css" rel="stylesheet">
	<link href="datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> 
                
 <style type="text/css">
 	
 	table.dataTable thead .sorting:before, table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_desc:after {
   padding: 5px;
}
.dataTables_wrapper .mdb-select {
   background: transparent;
   border: 1px solid #3b8ec2;
   font-size: 14px;
   height: 29px;
   padding: 5px; /* If you add too much padding here, the options won't show in IE */
   width: 268px;
   overflow: hidden;
   color: inherit;
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border-radius: 5px;
   margin-bottom: 0px;
   margin-left: 5px;
   margin-right: 5px;
}

.dataTables_length label {
	margin-top: 10px;
    display: flex;
    justify-content: left;
    color: inherit;
}
.dataTables_filter label {
	margin-top: 3px;
    color: inherit;
    margin-bottom: 0;
}
.dataTables_filter label input[type=search]:focus:not([readonly]) {
	   border-bottom: 1px solid #00695C;
	  -webkit-box-shadow: 0 1px 0 0 #00695C;
	  box-shadow: 0 1px 0 0 #00695C; }
     margin-top:0px;
    padding-bottom: 0;
}
table.dataTable {
    margin-bottom: 3rem!important;
}
div.dataTables_wrapper div.dataTables_info {
    padding-top: 0px;
}

table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_desc_disabled:before {
	content:'';
	}

table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after {
	content:'';
	}

.header-row {
    border: 2px solid #00695C;
    border-radius: 5px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
	padding:0px;
	padding-left:1px;
}

.user-list {
    border: 2px solid #00695C;
    border-radius: 5px;
}

.user-list thead {
	color:white;
	background-color:#00695C;
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
					
					<ul class="my-account-nav">
						<li class="sub-nav-title">Manage Users</li>
						<li><a href="users-list.php"><i class="fa fa-users"></i> Users List</a></li>
						<li><a href="users-properties.php" class="current"><i class="fa fa-building"></i> Users Properties</a></li>
						<li><a href="property-features.php"><i class="fa fa-magic"></i> Property Features</a></li>
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
                <!-- Section heading -->
		            <h2 class="h2-responsive wow fadeIn">Manage User Properties</h2>
		            <hr>

		        <?php
					if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
						include 'user.php';
						$user = new User();
						$userData = $user->getRows("property_listings");
				?>
			<table id="user-list" class="table table-responsive z-depth-2 user-list" cellspacing="0" width="100%">
			    <thead>
			        <tr>
			            <th>Property ID</th>
			            <th>Sumbitted by</th>
			            <th>Submitted on</th>
			            <th>Status</th>
			        </tr>
			    </thead>
			    <tbody>

				<?php
		                if(!empty($userData)): $count = 0; foreach($userData as $user_details): $count++;
						
				?>
					<tr><td><a class="teal-text" onclick="get_details('<?php echo $user_details['prop_id']; ?>')"><?php echo $user_details['prop_id']; ?></a></td>
			    <?php
						$conditions['where'] = array(
							'id' => $user_details['user_id']
						);
						$conditions['return_type'] = 'single';
						$userProfile = $user->getRows("users",$conditions);
				?>
						<td><?php echo $userProfile['full_name']; ?></td>
						<td><?php echo date_format(date_create($user_details['created']),'d-M-Y'); ?></td>
			    <?php
						$conditions['where'] = array(
							'id' => $user_details['approve_status']
						);
						$conditions['return_type'] = 'single';
						$prop_appr_status = $user->getRows("property_aprv_status",$conditions);
				?>
						<td><?php echo $prop_appr_status['status']; ?></td>
                 <?php endforeach; else: 
                  endif; 
                  }?>		
			  </tbody>
			</table>

<hr>

		</div>

	</div>
</div>



  
    <!--Modal: Login / Register Form-->
    <div class="modal fade" id="productDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg cascading-modal" role="document">
            <!--Content-->
            <div class="modal-content">
    
                <!--Modal cascading tabs-->
                <div class="modal-c-tabs">
    
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-2 light-blue darken-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#details" role="tab"><i class="fa fa-building mr-1"></i> Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#images" role="tab"><i class="fa fa-building mr-1"></i> Images</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#description" role="tab"><i class="fa fa-building mr-1"></i> Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#contact" role="tab"><i class="fa fa-building mr-1"></i> Contact</a>
                        </li>
                    </ul>
    
                    <!-- Tab panels -->
                    <div class="tab-content product-details">
                    </div>
    
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: Login / Register Form-->


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
    <!-- BX Slider JavaScript -->
    <script type="text/javascript" src="../assets/js/jquery.bxslider.min.js"></script>

    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <script type="text/javascript" src="datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Animations init-->
    <script>
    new WOW().init();
    </script>


<script type="text/javascript">
	function get_details(prop_id){
		$.ajax({
		type: "POST",
		url: "get_property_details.php",
		data: "prop_id=" + prop_id,
		success: function(message){
			$('.product-details').html(message);
			$('#productDetail').modal('show');
			$('a[data-toggle="tab"]:first').tab('show');
		},
		error: function(){
			alert("Error");
		}
		}); 
	}

</script>


<script type="text/javascript">
	    $(document).ready(function() {
		      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		      	var str = (e.target).toString();
		      	tab_pos = str.substring(str.indexOf("#"));
		      	if (tab_pos = "#images"){
		      		$('.carousel-inner div.carousel-item').removeClass('active');
				    $('.carousel-inner div.carousel-item:first-child').addClass('active');
		      		$('.carousel-indicators li').removeClass('active');
				    $('.carousel-indicators li:first-child').addClass('active');
		      	}
		      	var str = (e.relatedTarget).toString();
		      	tab_pos = str.substring(str.indexOf("#"));
		      	$(tab_pos).removeClass('active');
		      	$(tab_pos).removeClass('show');
		        //e.target // newly activated tab
		        //e.relatedTarget // previous active tab
		      });
     
    });
</script>

<script type="text/javascript">
	
$(document).ready(function() {
    $('#user-list').DataTable({
		"drawCallback": function(settings){
		    $('.dataTables_paginate ul.pagination').addClass('pg-purple');
		}
    	});
    $('.dataTables_length select').addClass('mdb-select md-form');
    $('.dataTables_length select').removeClass('form-control form-control-sm');
    $('.dataTables_filter input').removeClass('form-control form-control-sm');
    $('#user-list_wrapper div.row:first-child').addClass('header-row z-depth-2 mb-3');
    $('#user-list_wrapper div.row:last-child').addClass('footer-row mt-3');
});
           
</script>


</div>
<!-- Wrapper / End -->

</body>
</html>