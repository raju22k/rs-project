<?php
//start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//load and initialize user class
include 'user.php';
$user = new User();
//$tbl = "users";
if(isset($_POST['signupSubmit'])){
	//check whether user details are empty
    if(!empty($_POST['username']) && !empty($_POST['email2']) && !empty($_POST['phone'])) {
			//check whether user exists in the database
            $prevCon['where'] = array('email'=>$_POST['email2']);
            $prevCon['return_type'] = 'count';
            $prevUser = $user->getRows('users', $prevCon);
            if($prevUser > 0) {
                 $sessData['status']['type'] = 'error';
                 $sessData['status']['msg'] = 'User already registered.';

            }else{

                $temp_pass = 'Test';
                $password=md5($temp_pass);   
				//insert user data in the database
                $userData = array(
                    'role_id' => 2,
                    'full_name' => $_POST['username'],
                    'email' => $_POST['email2'],
                    'password' => $password,
                    'phone' => $_POST['phone'],
                    'status'=>'F'
                );
                $insert = $user->insert('users', $userData);
				//set status based on data insert
                if($insert){
                    $userProfile = array(
                        'user_id' => $insert,
                        'image' => 'Agent-' . $insert . rand() . 'jpg',
                        'title' => 'My property'
                    );
                    $insert_profile = $user->insert('user_profile', $userProfile);


 /*                   $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                      $actual_link=str_replace("userAccount.php","verifyemail.php",$link);
                      $toEmail = $_POST['email2'];
                      $subject = "User Activation Email";
                    $mailHeaders  = 'MIME-Version: 1.0' . "\r\n";
                    $mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $mailHeaders .= "From: admin@codenameproject.xyz"."\r\n".
                          'X-Mailer: PHP/' . phpversion();
                        $emailmessage = '<html><body>';
                        $emailmessage .= '<h3>Hi '.$_POST['username'].'</h3>';
                        $emailmessage .= '<p>Thanks for the Subcription.</p><br>';
                        $emailmessage .= "Please use the password the temperory password <b>" . $temp_pass . "</b> to login to your account.";
                        $emailmessage = $emailmessage . "<br><h2><strong>Have Questions ?</strong></h2>";
                        $emailmessage = $emailmessage . "<p>Please Call Us @ (+91)44 43520930</p>";
                        $emailmessage = $emailmessage . "<strong><a href='mailto:vishwathcomputers@gmail.com'>Email Us</a></strong>";
                        $emailmessage .= '</body></html>';
                     if(mail($toEmail, $subject, $emailmessage, $mailHeaders)) {
                        $sessData['status']['msg']='<p class="lead">Temperory password was sent to the registered email id <strong>'.$_POST["email2"].'</strong>. <br><br>;

                        $sessData['status']['type'] = 'success';
    //                    $sessData['status']['msg'] = 'You have registered successfully, log in with your credentials.';
                        }else{
                        $sessData['status']['type'] = 'error';
                        $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                        }  */
                        $sessData['status']['msg']='<p>Temperory password was sent to the registered email id <strong>'.$_POST["email2"].'</strong>.</p>';
                        $sessData['status']['type'] = 'success';

                    }else{
                        $sessData['status']['type'] = 'error';
                        $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                }
            }

        
    } else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.'; 
    }
	//store signup status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'my-profile.php':'index.php';
	//redirect to the home/registration page
    header("Location:".$redirectURL); 
} elseif(isset($_POST['loginSubmit'])){
	//check whether login details are empty
    if(!empty($_POST['email']) && !empty($_POST['password'])){
		//get user data from user class
        $conditions['where'] = array(
            'email' => $_POST['email'],
            'password' => md5($_POST['password'])
 //           'status' => 'T'
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows('users', $conditions);
		//set user data and status based on login credentials
        if($userData){
            $sessData['userLoggedIn'] = TRUE;
            $sessData['userID'] = $userData['id'];
            $sessData['user_role'] = $userData['role_id'];
            $sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = 'Welcome '.$userData['full_name'].'!';
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Wrong email or password, please try again.'; 
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter email and password.'; 
    }
	//store login status into the session
    $_SESSION['sessData'] = $sessData;
	//redirect to the home page
    if($userData['role_id']==1){
        $page='my-profile.php';        
    } else {
        $page='../users/my-profile.php';        
    }
    header("Location:my-profile.php");
} elseif(isset($_POST['passSubmit'])){
    //check whether login details are empty
    if(!empty($_POST['email'])) {
        //get user data from user class
        $conditions['where'] = array(
            'email' => $_POST['email']
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows('users', $conditions);
        //set user data and status based on login credentials
        if($userData){

                if($userData['status']=='T'){
                    $temp_pass = 'Test';
                    $password=md5($temp_pass);   
                   $update = $user->update('users', array('password'=>$password),array('email'=>$_POST['email']));
                   $status=$update?'ok':'err';
                   if($status=='ok'){
/*                        $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        $actual_link=str_replace("userAccount.php","resetpass.php",$link);
                        $toEmail = $_POST['email'];
                        $subject = "User Activation Email";
                        $emailmessage = '<html><body>';
                        $emailmessage .= '<h3>Hi '.$userData['full_name'].'</h3>';
                        $emailmessage .= "Please use the password the temperory password <b>" . $temp_pass . "</b> to login to your account.";
                        $emailmessage = $emailmessage . "<br><h2><strong>Have Questions ?</strong></h2>";
                        $emailmessage = $emailmessage . "<p>Please Call Us @ (+91)44 43520930</p>";
                        $emailmessage = $emailmessage . "<strong><a href='mailto:vishwathcomputers@gmail.com'>Email Us</a></strong>";
                        $emailmessage .= '</body></html>';

                        $mailHeaders  = 'MIME-Version: 1.0' . "\r\n";
                        $mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $mailHeaders .= "From: admin@codenameproject.xyz"."\r\n".
                              'X-Mailer: PHP/' . phpversion();
                        if(mail($toEmail, $subject, $emailmessage, $mailHeaders)) {
                                    $sessData['status']['type'] = 'success';
                                    $sessData['status']['msg']='<p class="lead">Temperory password was sent to the registered email id <strong>'.$_POST["email"].'</strong>. <br><br>';
                        } else {
                            $sessData['status']['type'] = 'error';
                            $sessData['status']['msg'] = 'Some problem occurred while sending email, please try again.';
                        } */

                        $sessData['status']['type'] = 'success';
                        $sessData['status']['msg']='<p class="lead">Temperory password was sent to the registered email id <strong>'.$_POST["email"].'</strong>.</p>';

                    } else {
                        $sessData['status']['type'] = 'error';
                        $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                    }
               } elseif($userData['status']=='F') {
                            $sessData['status']['type'] = 'error';
                            $sessData['status']['msg'] = 'The user email entered was registered and unapproved by the agent.';
                } else {
                            $sessData['status']['type'] = 'error';
                            $sessData['status']['msg'] = 'The user email was blocked. Please regsiter with new email id.';
                        } 
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'unregistered email id, please register yourself.'; 
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter email id to reset your password.'; 
    }
    //store login status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:my-profile.php");
}elseif(isset($_POST['editaccount'])){

    $sessData = $_SESSION['sessData'];

    //check whether user details are empty
    if(!empty($_POST['agent_name']) && !empty($_POST['title']) && !empty($_POST['phone']) && !empty($_POST['email'])) {
                //modify user data in the database
                $conditions['where'] = array(
                    'email' => $_POST['email']
                );
                $conditions['return_type'] = 'single';
                $userData = $user->getRows('users', $conditions);
                $user_id = $userData['id'];
                $condition = "";
                $userData = "";
                $condition = array(
                    'id' => $user_id
                );
                $userData = array(
                    'full_name' => $_POST['agent_name'],
                    'phone' => $_POST['phone']
                );
                $insert = $user->update('users', $userData,$condition);

                $condition = "";
                $userData = "";
                $condition = array(
                    'user_id' => $user_id
                );
                $userData = array(
                    'title' => $_POST['title'],
                    'facebook' => $_POST['facebook'],
                    'twitter' => $_POST['twitter'],
                    'google' => $_POST['google'],
                    'linkedin' => $_POST['linkedin']
               );
                $insert_profile = $user->update('user_profile', $userData,$condition);
                if($insert && $insert_profile){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'Your details had updated successfully.';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Name, Title, Phone and Email are mandatory.'; 
    }
    //store signup status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = 'my-profile.php'; //($sessData['status']['type'] == 'success')?'my-profile.php':'editaccount.php';
    //redirect to the home/registration page
    header("Location:".$redirectURL);

}elseif(isset($_POST['changepass'])){
        $sessData = $_SESSION['sessData'];

        if(!empty($_POST['cpass'])) { 
                $conditions['where'] = array(
                    'id' => $sessData['userID']
                );
                $conditions['return_type'] = 'single';
                $userData = $user->getRows('users', $conditions);
                if ($userData['password'] == md5($_POST['cpass'])) {
                    if ($_POST['newpass1'] == $_POST['newpass2']) {
                        $condition = "";
                        $condition = array(
                            'id' => $sessData['userID']
                        );
                        $userpass = array(
                            'password' => md5($_POST['newpass1'])
                       );
                        $insert = $user->update('users',$userpass,$condition);
                        if($insert){
                            $sessData['status']['type'] = 'success';
                            $sessData['status']['msg'] = 'Your password had changed successfully.';
                        }else{
                            $sessData['status']['type'] = 'error';
                            $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                        }
                    } else {
                        $sessData['status']['type'] = 'error';
                        $sessData['status']['msg'] = 'New password and confirm password do not match, please try again.';
                    }

                } else {

                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Current password incorrect, please try again.';
                }
        } else {
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Current password was blank, please try again.';
        }
    $_SESSION['sessData'] = $sessData;
    header("Location:change-password.php");

}elseif(!empty($_REQUEST['logoutSubmit'])){
	//remove session data
    unset($_SESSION['sessData']);
    session_destroy();
	//store logout status into the ession
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'You have logout successfully from your account.';
    $_SESSION['sessData'] = $sessData;
	//redirect to the home page
    header("Location:../index.php");
}elseif(isset($_POST['submit-property'])){
    if(!empty($_POST['property_title']) && !empty($_POST['property_status']) && !empty($_POST['property_type']) && !empty($_POST['price']) && !empty($_POST['area']) && !empty($_POST['address']) && !empty($_POST['property_locality']) && !empty($_POST['summary'])){

        $sessData = $_SESSION['sessData'];

         $property_details = array(
            'user_id' => $sessData['userID'],
            'title' => $_POST['property_title'],
            'prop_status' => $_POST['property_status'],
            'type_id'=> $_POST['property_type'],
            'price'=> $_POST['price'],
            'floor_area'=> $_POST['area'],
//            'rooms'=> $_POST['rooms'],
            'address'=> $_POST['address'],
            'locality'=> $_POST['property_locality'],
            'landmark'=> $_POST['landmark'],
//            'address_city'=> $_POST['city'],
//            'address_state'=> $_POST['state'],
//            'address_pin'=> $_POST['pincode'],
            'description'=> $_POST['summary'],
            'build_age'=> !empty($_POST['building_age'])?$_POST['building_age']:'9',
            'bedrooms'=> !empty($_POST['bedrooms'])?$_POST['bedrooms']:'1',
//            'bathrooms'=> !empty($_POST['bathrooms'])?$_POST['bathrooms']:'0',
            'furnished'=> !empty($_POST['furnished'])?$_POST['furnished']:'1',
            'owner_show'=> 'N',
            'approve_status'=> '1'
        );
        $insert = $user->insert('property_listings', $property_details);
        
        
        
//        $insert = 2;
        if($insert){
            $digits = 4;
            $rand_num = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
            $prop_rand_id = 'PROP' . $rand_num . $insert;
//            $prop_rand_id = 'PROP82012';
            $condition = array(
                'id' => $insert
            );
            $userData = array(
                'prop_id' => $prop_rand_id
            );
            $update = $user->update('property_listings', $userData,$condition);

            if(!empty($_POST['features'])) {
                foreach($_POST['features'] as $feature) {
                    $prop_feature = array(
                        'property_id' => $insert,
                        'feature_id' => $feature
                    );
                    $feature_insert = $user->insert('property_features', $prop_feature);
              }
            }
            $sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = 'Your property details had created successfully. Please upload property photo';
            $sessData['property_id'] = $insert;
            $_SESSION['sessData'] = $sessData;
            header("Location:upload-gallery.php?propertyid=" . $prop_rand_id);
            exit();
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Some problem occurred in data addition, please try again.' . json_encode($property_details) . mySqli.info();
        }
    } else {

            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Please enter all the mandatory fields.';
    }
    $_SESSION['sessData'] = $sessData;
    header("Location:submit-property.php");
}elseif(isset($_POST['update-property'])){
    if(!empty($_POST['property_title']) && !empty($_POST['property_status']) && !empty($_POST['property_type']) && !empty($_POST['price']) && !empty($_POST['area']) && !empty($_POST['address']) && !empty($_POST['property_locality']) && !empty($_POST['summary'])){

        $sessData = $_SESSION['sessData'];

         $property_details = array(
             'user_id' => $sessData['userID'],
            'title' => $_POST['property_title'],
            'prop_status' => $_POST['property_status'],
            'type_id'=> $_POST['property_type'],
            'price'=> $_POST['price'],
            'floor_area'=> $_POST['area'],
//            'rooms'=> $_POST['rooms'],
            'address'=> $_POST['address'],
            'locality'=> $_POST['property_locality'],
            'landmark'=> $_POST['landmark'],
//            'address_city'=> $_POST['city'],
//            'address_state'=> $_POST['state'],
//            'address_pin'=> $_POST['pincode'],
            'description'=> $_POST['summary'],
            'build_age'=> !empty($_POST['building_age'])?$_POST['building_age']:'9',
            'bedrooms'=> !empty($_POST['bedrooms'])?$_POST['bedrooms']:'1',
//            'bathrooms'=> !empty($_POST['bathrooms'])?$_POST['bathrooms']:'0',
            'furnished'=> !empty($_POST['furnished'])?$_POST['furnished']:'1',
            'owner_show'=> 'N',
            'approve_status'=> '1'
        
         
         
     /*       'title' => $_POST['property_title'],
            'prop_status' => $_POST['property_status'],
            'type_id'=> $_POST['property_type'],
            'price'=> $_POST['price'],
            'floor_area'=> $_POST['area'],
            'rooms'=> $_POST['rooms'],
            'address'=> $_POST['address'],
            'address_city'=> $_POST['city'],
            'address_state'=> $_POST['state'],
            'address_pin'=> $_POST['pincode'],
            'description'=> $_POST['summary'],
            'build_age'=> !empty($_POST['building_age'])?$_POST['building_age']:'0',
            'bedrooms'=> !empty($_POST['bedrooms'])?$_POST['bedrooms']:'0',
            'bathrooms'=> !empty($_POST['bathrooms'])?$_POST['bathrooms']:'0',
        */
        );

        $conditions = "";
        $conditions = array(
            'id' => $sessData['property_id']
        );
        $update = $user->update('property_listings', $property_details,$conditions);

//        $update = 2;
        if($update){

                $conditions = "";
                $conditions['where'] = array(
                    'property_id' => $sessData['property_id']
                );
                $property_features = $user->getRows('property_features', $conditions);

            if($property_features) {
                $conditions = "";
                $conditions = array(
                    'property_id' => $sessData['property_id']
                );
                $property_features = $user->delete('property_features', $conditions);
            }

             if(!empty($_POST['features'])) {
                foreach($_POST['features'] as $feature) {
                    $prop_feature = array(
                        'property_id' => $sessData['property_id'],
                         'feature_id' => $feature
                   );
                    $feature_insert = $user->insert('property_features', $prop_feature);
              }
            }
            $sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = 'Your property details had been updated successfully.';
            $_SESSION['sessData'] = $sessData;
            header("Location:my-properties.php");
            
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Some problem occurred, please try again.';
        }
    } else {

            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Please enter all the mandatory fields.';
    }
    $_SESSION['sessData'] = $sessData;
    header("Location:edit-property.php");
}else{
	//redirect to the home page
    header("Location:index.php");
}

