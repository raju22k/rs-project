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

//                $temp_pass = 'Test';
                $temp_pass = random_password();
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


                      $toEmail = $_POST['email2'];
                      $subject = "Thanks for Registration";
                        $mailHeaders  = 'MIME-Version: 1.0' . "\r\n";
                        $mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $mailHeaders .= "From: admin@codenameproject.xyz"."\r\n".
                              'X-Mailer: PHP/' . phpversion();
                        $emailmessage = '<html><body>';
                        $emailmessage .= '<h3>Hi '.$_POST['username'].'</h3>';
                        $emailmessage .= '<p>Thanks for registering with us.</p><br>';
                        $emailmessage .= "Please use the password the temperory password <b>" . $temp_pass . "</b> to login to your account.";
                        $emailmessage = $emailmessage . "<br><h2><strong>Have Questions ?</strong></h2>";
                        $emailmessage = $emailmessage . "<p>Please Call Us @ (+91)1234567890</p>";
                        $emailmessage = $emailmessage . "<strong><a href='mailto:test@test.com'>Email Us</a></strong>";
                        $emailmessage .= '</body></html>';
                     if(mail($toEmail, $subject, $emailmessage, $mailHeaders)) {
                        $sessData['status']['msg']='<p>Temperory password was sent to the registered email id <strong>'.$_POST["email2"].'</strong>.';

                        $sessData['status']['type'] = 'success';
//                        $sessData['status']['msg'] = 'You have registered successfully, log in with your credentials.';
                        }else{
                        $sessData['status']['type'] = 'error';
                        $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                        }  
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
    if($userData['role_id']==1) {
        $page='../admin-user/my-profile.php';
    } else {
        $page='my-profile.php';
    }
	//redirect to the home page
    header("Location:" . $page);
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

//                    $temp_pass = 'Test';
                    $temp_pass = random_password();

                    $password=md5($temp_pass);   
                   $update = $user->update('users', array('password'=>$password),array('email'=>$_POST['email']));
                   $status=$update?'ok':'err';
                   if($status=='ok'){
                      $toEmail = $_POST['email'];
                      $subject = "Thanks for Registration";
                        $mailHeaders  = 'MIME-Version: 1.0' . "\r\n";
                        $mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $mailHeaders .= "From: admin@codenameproject.xyz"."\r\n".
                              'X-Mailer: PHP/' . phpversion();
                        $emailmessage = '<html><body>';
                        $emailmessage .= '<h3>Hi '.$userData['ful_name'].'</h3>';
                        $emailmessage .= '<p>Thanks for registering with us.</p><br>';
                        $emailmessage .= "Please use the password the temperory password <b>" . $temp_pass . "</b> to login to your account.";
                        $emailmessage = $emailmessage . "<br><h2><strong>Have Questions ?</strong></h2>";
                        $emailmessage = $emailmessage . "<p>Please Call Us @ (+91)1234567890</p>";
                        $emailmessage = $emailmessage . "<strong><a href='mailto:test@test.com'>Email Us</a></strong>";
                        $emailmessage .= '</body></html>';
                     if(mail($toEmail, $subject, $emailmessage, $mailHeaders)) {
                        $sessData['status']['msg']='<p>Temperory password was sent to the registered email id <strong>'.$_POST["email"].'</strong>.';

                        $sessData['status']['type'] = 'success';
                        echo 'success';
//                        $sessData['status']['msg'] = 'You have registered successfully, log in with your credentials.';
                        }else{
                        $sessData['status']['type'] = 'error';
                        $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                        }  

                    } else {
                        $sessData['status']['type'] = 'error';
                        $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                        echo 'error';
                    }
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'unregistered email id, please register yourself.'; 
                        echo 'error';
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter email id to reset your password.'; 
                        echo 'error';
    }
    //store login status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
//    header("Location:index.php");
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
    header("Location:index.php");
}elseif(isset($_POST['submit-property'])){
    if(!empty($_POST['property_title']) && !empty($_POST['property_status']) && !empty($_POST['property_type']) && !empty($_POST['price']) && !empty($_POST['area']) && !empty($_POST['rooms']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['pincode']) && !empty($_POST['summary'])){

        $sessData = $_SESSION['sessData'];

         $property_details = array(
            'user_id' => $sessData['userID'],
            'title' => $_POST['property_title'],
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
            $sessData['status']['msg'] = 'Some problem occurred in data addition, please try again.';
        }
    } else {

            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Please enter all the mandatory fields.';
    }
    $_SESSION['sessData'] = $sessData;
    header("Location:submit-property.php");
}elseif(isset($_POST['update-property'])){
    if(!empty($_POST['property_title']) && !empty($_POST['property_status']) && !empty($_POST['property_type']) && !empty($_POST['price']) && !empty($_POST['area']) && !empty($_POST['rooms']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['pincode']) && !empty($_POST['summary'])){

        $sessData = $_SESSION['sessData'];

         $property_details = array(
            'title' => $_POST['property_title'],
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
        );

        $conditions = "";
        $conditions = array(
            'id' => $sessData['property_id']
        );
        $update = $user->update('property_listings', $property_details,$conditions);

        $update = 2;
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



function random_password() {
    $alphabets = range('A','Z');
    $alphabets1 = range('a','z');
    $numbers = range('0','9');
    $final_array = array_merge($alphabets,$alphabets1,$numbers);
    $length=16;
         
    $password = '';
  
    while($length--) {
      $key = array_rand($final_array);
      $password .= $final_array[$key];
    }
  
    return $password;

}
