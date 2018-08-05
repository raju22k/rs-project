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
	    header("Location:../admin/dashboard.php");
	    exit();
}


if(empty($_REQUEST['propertyid'])) {
		header("Location:my-properties.php");
		exit();
} else {
		include 'user.php';
		$user = new User();
        $conditions = "";
        $conditions['where'] = array(
            'prop_id' => $_REQUEST['propertyid']
        );
		$conditions['return_type'] = 'single';
        $property_detail = $user->getRows('property_listings', $conditions);
		if($property_detail) {
			if($sessData['userID'] != $property_detail['user_id']) {
				header("Location:my-properties.php");
				exit();
			}
		} else {
			header("Location:my-properties.php");
			exit();
		}
}


if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}

if(empty($_REQUEST['propertyid'])) {
		$_SESSION['sessData']['prop_rand_id'] = '';
} else {
		$_SESSION['sessData']['prop_rand_id'] = $_REQUEST['propertyid'];
}


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
    <!-- Your custom styles (optional) -->
    <link href="../assets/css/style.css" rel="stylesheet">

<style type="text/css">
	
<style>
 
    #actions {
      margin: 2em 0;
    }

    /* Mimic table appearance */
 	#previews {
 		width: 100%;
 	}

	#previews .file-row
	 {
      display: table-row;
      width: 100%;
	}

	#previews .file-row > div
	 {
      display: table-cell;
      vertical-align: middle;
      border-top: 1px solid #ddd;
	}

    /* The total progress gets shown by event listeners */
    #total-progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }

    /* Hide the progress bar when finished */
    #previews .file-row.dz-success .progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }

    /* Hide the delete button initially */
    #previews .file-row .delete {
      display: none;
    }

    /* Hide the start and cancel buttons and show the delete button */

    #previews .file-row.dz-success .start,
    #previews .file-row.dz-success .cancel {
      display: none;
    }
    #previews .file-row.dz-success .delete {
      display: block;
    }


  </style>



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
<div class="row">

		<!-- Widget -->
		<div class="col-md-4 mt-5">
			<div class="sidebar left">

				<div class="my-account-nav-container">
					
					<ul class="my-account-nav">
						<li class="sub-nav-title">Manage Account</li>
						<li><a href="my-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
					</ul>
					
					<ul class="my-account-nav">
						<li class="sub-nav-title">Manage Listings</li>
						<li><a href="my-properties.php"><i class="fa fa-files-o"></i> My Properties</a></li>
						<li><a href="submit-property.php" class="current"><i class="fa fa-mail-forward"></i> Submit New Property</a></li>
					</ul>

					<ul class="my-account-nav">
						<li><a href="change-password.php"><i class="fa fa-lock"></i> Change Password</a></li>
						<li><a href="userAccount.php?logoutSubmit=1"><i class="fa fa-power-off"></i> Log Out</a></li>
					</ul>

				</div>

			</div>
		</div>

	<!-- Submit Page -->
	<div class="col-md-8">
		<div class="submit-page">

		<!-- Section -->
		<div class="divider-new">
		    <h2 class="h2-responsive wow fadeIn">Upload Gallery</h2>
		</div>
		<div class="submit-section">
		<?php echo !empty($statusMsg)?'<div class="notification notice large margin-bottom-10"><p class="'.$statusMsgType.'">'.$statusMsg.'</p></div>':''; ?>
<!--			<form action="upload.php" method="post" class="dropzone" id="myDropzone"></form> -->
		</div>
		<!-- Section / End -->


   <div id="actions" class="row">

      <div class="col-lg-12">
        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-unique fileinput-button">
            <i class="fa fa-plus"></i>
            <span>Add files...</span>
        </span>
        <button type="submit" class="btn btn-primary start">
            <i class="fa fa-upload"></i>
            <span>Start upload</span>
        </button>
        <button type="reset" class="btn btn-warning cancel">
            <i class="fa fa-ban"></i>
            <span>Cancel upload</span>
        </button>
      </div>

      <div class="col-lg-12 pt-2 pb-2">
        <!-- The global file processing state -->
        <span class="fileupload-process">
          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
          </div>
        </span>
      </div>


    </div>    

		<div class="table table-responsive table-fixed" class="files" id="previews">

		  <div id="template" class="file-row">
		    <!-- This is used as the file preview template -->
		    <div class="pt-2 pb-2">
		        <span class="preview"><img data-dz-thumbnail /></span>
		<!--        <p class="name" data-dz-name></p> -->
		        <strong class="error text-danger" data-dz-errormessage></strong>
		    </div>
		    <div style="width: 50%" class="text-center pr-3 pl-3">
		        <p class="size" data-dz-size></p>
		        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
		          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
		        </div>
		    </div>
		    <div>
		      <button class="btn btn-primary start">
		          <i class="fa fa-upload"></i>
		          <span>Start</span>
		      </button>
		      <button data-dz-remove class="btn btn-warning cancel">
		          <i class="fa fa-ban"></i>
		          <span>Cancel</span>
		      </button>
		      <button data-dz-remove class="btn btn-danger delete">
		        <i class="fa fa-trash"></i>
		        <span>Delete</span>
		      </button>
		    </div>
		  </div>

		</div>
		<hr>

		<a href="my-properties.php" id="skip-images" class="btn btn-indigo float-right mt-1">Complete <i class="fa fa-check"></i></a> 

		</div>
	</div>

</div>
</div>
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

<!-- DropZone | Documentation: http://dropzonejs.com -->
<script type="text/javascript" src="../assets/js/dropzone.js"></script>

<script type="text/javascript">
	
// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
  url: "upload.php", // Set the url
  thumbnailWidth: 80,
  thumbnailHeight: 80,
  parallelUploads: 20,
  previewTemplate: previewTemplate,
  acceptedFiles: "image/jpeg,image/png,image/gif",
  autoQueue: false, // Make sure the files aren't queued until manually added
  previewsContainer: "#previews", // Define the container to display the previews
  clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
	init: function() {

		// 4
		$.get('getimages.php', function(data) {

	    // 5
	    $.each(data, function(key,value){
	         
	        var mockFile = { name: value.name, size: value.size };

	        var prod_id = "<?php echo $_REQUEST['propertyid']; ?>"
	         
	        myDropzone.options.addedfile.call(myDropzone, mockFile);

	        myDropzone.createThumbnailFromUrl(mockFile, "../assets/images/properties/large/" + prod_id + "/"+value.name);
	        myDropzone.emit("success", mockFile);
	    });
	     
		});
	}
});


myDropzone.on("addedfile", function(file) {
  // Hookup the start button
  file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
  document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
});

myDropzone.on("sending", function(file) {
  // Show the total progress bar when upload starts
  document.querySelector("#total-progress").style.opacity = "1";
  // And disable the start button
  file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
  document.querySelector("#total-progress").style.opacity = "0";
});


myDropzone.on("removedfile", function(file) {
	    var name = file.name;        
	    $.ajax({
	        type: 'POST',
	        url: 'deleteimages.php',
	        data: "image="+name,
	        dataType: 'html',
           success:function(msg){
                alert(msg);
            }
	    });
 });


// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
  myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};
document.querySelector("#actions .cancel").onclick = function() {
  myDropzone.removeAllFiles(true);
};


</script>


</div>
<!-- Wrapper / End -->


</body>
</html>