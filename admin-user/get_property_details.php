<?php

include 'user.php';
$user = new User();

$conditions='';
$conditions['where'] = array(
    'prop_id' => $_REQUEST['prop_id']
);
$conditions['return_type'] = 'single';
$property_details = $user->getRows('property_listings', $conditions);

$conditions='';
$conditions['where'] = array(
    'id' => $property_details['user_id']
);
$conditions['return_type'] = 'single';
$property_users = $user->getRows('users', $conditions);

$conditions='';
$conditions['where'] = array(
    'user_id' => $property_details['user_id']
);
$conditions['return_type'] = 'single';
$property_user_profile = $user->getRows('user_profile', $conditions);




$conditions='';
$conditions['where'] = array(
    'id' => $property_details['prop_status']
);
$conditions['return_type'] = 'single';
$property_status = $user->getRows('property_status', $conditions);

$conditions='';
$conditions['where'] = array(
    'id' => $property_details['type_id']
);
$conditions['return_type'] = 'single';
$property_type = $user->getRows('property_types', $conditions);

$conditions='';
$conditions['where'] = array(
    'id' => $property_details['rooms']
);
$conditions['return_type'] = 'single';
$property_rooms = $user->getRows('property_rooms', $conditions);

$conditions='';
$conditions['where'] = array(
    'id' => $property_details['bedrooms']
);
$conditions['return_type'] = 'single';
$property_bedrooms = $user->getRows('property_rooms', $conditions);

$conditions='';
$conditions['where'] = array(
    'id' => $property_details['bathrooms']
);
$conditions['return_type'] = 'single';
$property_bathrooms = $user->getRows('property_rooms', $conditions);


$conditions='';
$conditions['where'] = array(
    'id' => $property_details['build_age']
);
$conditions['return_type'] = 'single';
$property_age = $user->getRows('property_age', $conditions);

$prop_details = "<div class='tab-pane fade in show active' id='details' role='tabpanel'>";
$prop_details = $prop_details . "<div class='modal-body'>";
$prop_details = $prop_details . "<div class='property-box-post'>";
$prop_details = $prop_details . "<div class='property-box-post-head'>";
$prop_details = $prop_details . "<p>" . $property_details['title'] . "</p></div>";
$prop_details = $prop_details . "<div class='property-box-post-meta'>";
$prop_details = $prop_details . "<ul><li>Type<strong>" . $property_type['title'] . "</strong></li>";
$prop_details = $prop_details . "<li>Status<strong>" . $property_status['status'] . "</strong></li>";
$prop_details = $prop_details . "<li>Bedrooms<strong>" . $property_bedrooms['rooms'] . "</strong></li>";
$prop_details = $prop_details . "<li>Bathrooms<strong>" . $property_bathrooms['rooms'] . "</strong></li>";
$prop_details = $prop_details . "<li>Area (Sqft.)<strong>" . $property_details['floor_area'] . "</strong></li>";
$prop_details = $prop_details . "<li>Price (INR.)<strong>" . $property_details['price'] . "</strong></li></ul></div>";
$prop_details = $prop_details . "</div>";

$prop_details = $prop_details . "<br><div class='row container'>";
$prop_details = $prop_details . "<div class='property-box-post-head ml-3 col-md-12 mb-3'>";
$prop_details = $prop_details . "<p>Property Features</p></div>";
$conditions = "";
$conditions['where'] = array(
    'property_id' => $property_details['id']
);
$property_features = $user->getRows('property_features', $conditions);

if($property_features) {
	foreach($property_features as $feature) {
		$conditions='';
	    $conditions['where'] = array(
	        'id' => $feature['feature_id']
	    );
	    $conditions['return_type'] = 'single';
		$feature_name = $user->getRows('property_features_list', $conditions);
		$prop_details = $prop_details . "<div class='col-md-3'><i class='fa fa-check-square fa-lg mr-1 teal-text'> </i>" . $feature_name['title'] . "</div>" ;
	}
}
$prop_details = $prop_details . "</div>";
$prop_details = $prop_details . "</div>";
$prop_details = $prop_details . "</div>";

$prop_details = $prop_details . "<div class='tab-pane fade' id='images' role='tabpanel'>";
$prop_details = $prop_details . "<div class='modal-body' style='min-height: 350px; max-height: 350px;'>";

$targetDir = "../assets/images/properties/large/". $_REQUEST['prop_id'] . "/";
if(file_exists($targetDir)) {
     // <!--Carousel Wrapper-->
    $prop_details = $prop_details . "<div id='property-images' class='carousel slide carousel-fade' data-ride='carousel'>";
    // Slides    
    $prop_details = $prop_details . "<div class='carousel-inner' role='listbox'>";

    $files = scandir($targetDir);  
    $cnt=0;               //1
    if ( false!==$files ) {
        foreach ( $files as $file ) {
            if ( '.'!=$file && '..'!=$file) {       //2
                $prop_details = $prop_details . "<div class='carousel-item'>";
                $prop_details = $prop_details . "<img class='d-block w-100' src='" . $targetDir . $file . "' alt='$file' style='height:300px;'>";
                $prop_details = $prop_details . "</div>";
                $cnt++;
            }
        }
    } else {
        $prop_details = $prop_details . "<img src='../assets/images/properties/large/noimage.jpg' class='d-block w-100' alt='No Property Image' style='height:300px;' />";
    }
    $prop_details = $prop_details . "</div>";
    //    <!--Indicators-->
    $prop_details = $prop_details .     "<ol class='carousel-indicators'>";
    for($i=0;$i<$cnt;$i++) {
    $prop_details = $prop_details .         "<li data-target='#property-images' data-slide-to='$i' class=''></li>";
    }
    $prop_details = $prop_details . "    </ol>";
    //    <!--/.Indicators-->

    //Controls 
    $prop_details = $prop_details . "    <a class='carousel-control-prev' href='#property-images' role='button' data-slide='prev'>";
    //$prop_details = $prop_details . "        <span class='carousel-control-prev-icon' aria-hidden='true'></span>";
    $prop_details = $prop_details . "        <i class='fa fa-arrow-circle-left fa-lg teal-text'> </i>";
    $prop_details = $prop_details . "        <span class='sr-only'>Previous</span>";
    $prop_details = $prop_details . "    </a>";
    $prop_details = $prop_details . "    <a class='carousel-control-next' href='#property-images' role='button' data-slide='next'>";
    //$prop_details = $prop_details . "        <span class='carousel-control-next-icon' aria-hidden='true'></span>";
    $prop_details = $prop_details . "        <i class='fa fa-arrow-circle-right fa-lg teal-text'> </i>";
    $prop_details = $prop_details . "        <span class='sr-only'>Next</span>";
    $prop_details = $prop_details . "    </a>";

    $prop_details = $prop_details . "</div>";
    //<!--/.Carousel Wrapper-->
} else {
    $prop_details = $prop_details . "<img src='../assets/images/properties/large/noimage.jpg' class='d-block w-100' alt='No Property Image' style='height:300px;' />";
}

$prop_details = $prop_details . "</div>";
$prop_details = $prop_details . "</div>";



$prop_details = $prop_details . "<div class='tab-pane fade' id='description' role='tabpanel'>";
$prop_details = $prop_details . "<div class='modal-body'>";
$prop_details = $prop_details . "<div class='property-box-post'>";
$prop_details = $prop_details . "<div class='property-box-post-head'>";
$prop_details = $prop_details . "<p>Property Description</p></div>";
$prop_details = $prop_details . $property_details['description'];
$prop_details = $prop_details . "</div>";

$prop_details = $prop_details . "</div>";
$prop_details = $prop_details . "</div>";

$prop_details = $prop_details . "<div class='tab-pane fade' id='contact' role='tabpanel'>";
$prop_details = $prop_details . "<div class='modal-body'>";
$prop_details = $prop_details . "<div class='property-box-post'>";
$prop_details = $prop_details . "<div class='property-box-post-head'>";
$prop_details = $prop_details . "<p>User Details</p></div>";

$prop_details = $prop_details . "<div class='row col-md-12'>";
$prop_details = $prop_details . "<div class='col-md-6'>";
$prop_details = $prop_details . "<ul class=''>";
$prop_details = $prop_details . "<li><span>Name:</span> ". $property_users['full_name'] . "</li>";
$prop_details = $prop_details . "<li><span>Phone:</span> " . $property_users['phone'] . "</li>";
$prop_details = $prop_details . "<li><span>Email:</span> " . $property_users['email'] . "</li>";
$prop_details = $prop_details . "</ul></div>";

$prop_details = $prop_details . "<div class='col-md-6'>";
$prop_details = $prop_details . "<ul class=''>";
$prop_details = $prop_details . "<li><span>Facebook:</span> " . $property_user_profile['facebook'] . "</li>";
$prop_details = $prop_details . "<li><span>Twitter:</span> " . $property_user_profile['twitter'] . "</li>";
$prop_details = $prop_details . "<li><span>Google+:</span> " . $property_user_profile['google'] . "</li>";
$prop_details = $prop_details . "<li><span>Linkedin:</span> " . $property_user_profile['linkedin'] . "</li>";

$prop_details = $prop_details . "</ul></div>";
$prop_details = $prop_details . "</div>";

$prop_details = $prop_details . "</div>";



$prop_details = $prop_details . "</div>";
$prop_details = $prop_details . "</div>";

$prop_details = $prop_details . "<div class='modal-footer display-footer'>";
$prop_details = $prop_details . "<div class='options text-center'>";
$prop_details = $prop_details . "<a class='btn btn-outline-primary waves-effect ml-auto' href='edit-property.php?propertyid=" . $property_details['prop_id'] . "' >Edit Details</a>";

$prop_details = $prop_details . "<a class='btn btn-outline-secondary waves-effect ml-auto' href='upload-gallery.php?propertyid=". $property_details['prop_id'] . "' >Edit Images</a>";

$prop_details = $prop_details . "<a class='btn btn-outline-success waves-effect ml-auto' href='approve-property.php?propertyid=". $property_details['prop_id'] . "' >Approve</a>";

$prop_details = $prop_details . "<a class='btn btn-outline-danger waves-effect ml-auto' href='delete-property.php?propertyid=". $property_details['prop_id'] . "' >Delete</a>";
$prop_details = $prop_details . "<a class='btn btn-outline-warning waves-effect ml-auto' data-dismiss='modal'>Close</a>";
$prop_details = $prop_details . "</div>";
$prop_details = $prop_details . "</div>";

echo $prop_details;
//echo "<p>" . $property_details['title'] . "</p>" ;

?>