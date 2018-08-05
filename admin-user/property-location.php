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
					
<!--					<ul class="my-account-nav">
						<li class="sub-nav-title">Manage Users</li>
						<li><a href="users-list.php"><i class="fa fa-users"></i> Users List</a></li>
						<li><a href="users-properties.php"><i class="fa fa-building"></i> Users Properties</a></li>
						<li><a href="property-features.php" class="current"><i class="fa fa-magic"></i> Property Features</a></li>
					</ul> -->

					<ul class="my-account-nav">
						<li class="sub-nav-title">Manage Listings</li>
						<li><a href="my-properties.php"><i class="fa fa-files-o"></i> My Properties</a></li>
						<li><a href="submit-property.php"><i class="fa fa-mail-forward"></i> Submit New Property</a></li>
						<li><a href="property-features.php"><i class="fa fa-magic"></i> Property Features</a></li>
						<li><a href="property-location.php" class="current"><i class="fa fa-map-marker"></i> Manage Locations</a></li>
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
		            <h2 class="h2-responsive wow fadeIn">Manage Property Location</h2>
		            <hr>
		            <a class="btn btn-unique" data-toggle="modal" data-target="#addLocation">Add New Location</a>
		            <hr>
		        <?php
					if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
						include 'user.php';
						$user = new User();
						$features = $user->getRows("property_locality");
				?>
			<table id="user-list" class="table table-responsive z-depth-2 user-list" cellspacing="0" width="100%">
			    <thead>
			        <tr>
			            <th>ID</th>
			            <th>Location Name</th>
			            <th>Edit</th>
			            <th>Delete</th>
			        </tr>
			    </thead>
			    <tbody>

				<?php
		                if(!empty($features)): $count = 0; foreach($features as $feature): $count++;
				?>
						<tr><td class="align-middle"><?php echo $count; ?></td>
						<td class="align-middle"><?php echo $feature['locality']; ?></td>
						<td><a class="btn btn-info" onclick="get_details('<?php echo $feature['id']; ?>')">Edit</a></td>
						<td><a class="btn btn-danger" onclick="delete_feature('<?php echo $feature['id']; ?>')">Delete</a></td></tr>
                 <?php endforeach; else: 
                  endif; 
                  }?>		
			  </tbody>
			</table>

<hr>

		</div>

	</div>
</div>



  
   <!-- Central Modal Medium Success -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-warning" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <p class="heading lead">Edit Location</p>
    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
    
                <!--Body-->
                <div class="modal-body">
                    <div class="row text-center">
                    	<div class="col-md-12 feature-details">
                    	</div>
                    </div>
                </div>
    
                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <a class="btn btn-primary" onclick="save()">Save</a>
                    <a class="btn btn-secondary waves-effect" data-dismiss="modal">Close</a>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Central Modal Medium Success-->


   <!-- Central Modal Medium Success -->
    <div class="modal fade" id="addLocation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-warning" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <p class="heading lead">Add New Location</p>
    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
    
                <!--Body-->
                <div class="modal-body">
                    <div class="row text-center">
                    	<div class="col-md-12 feature-details">
                    		<div class="md-form">
                    			<input type="text" id="title" name="new_title" class="form-control">
                    			<label for="title">Location Name</label>
                    		</div>
                    	</div>
                    </div>
                </div>
    
                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <a class="btn btn-primary" onclick="add()">Save</a>
                    <a class="btn btn-secondary waves-effect" data-dismiss="modal">Close</a>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Central Modal Medium Success-->



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
	function get_details(feature_id){
		$.ajax({
		type: "POST",
		url: "manage-locations.php",
		data: "action=view&feature_id=" + feature_id,
		success: function(message){
			$('.feature-details').html(message);
			$('#editModal').modal('show');
		},
		error: function(){
			alert("Error");
		}
		}); 
	}


	function save() {
		$.ajax({
		type: "POST",
		url: "manage-locations.php",
		data: "action=save&feature_id=" + $('input[name=f_id]').val() + "&title=" + $('input.title').val(),
		success: function(message){
			window.location.reload();
		},
		error: function(){
			alert("Error");
		}
		}); 
	}

	function add() {
		$.ajax({
		type: "POST",
		url: "manage-locations.php",
		data: "action=add&title=" + $('input[name=new_title]').val(),
		success: function(message){
			window.location.reload();
		},
		error: function(){
			alert("Error");
		}
		}); 
	}

	function delete_feature(feature_id){
		$.ajax({
		type: "POST",
		url: "manage-locations.php",
		data: "action=delete&feature_id=" + feature_id,
		success: function(message){
			window.location.reload();
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