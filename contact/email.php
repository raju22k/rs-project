    <?php

       if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SERVER['HTTP_REFERER'])) {
            header('Location: index.php');
        } else {
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']) && isset($_SESSION['status']))
            {

                    $to = "admin@solorix.com"; // this is your Email address
                    $from = $_POST['email']; // this is the sender's Email address
                    $first_name = $_POST['name'];
                 //   $last_name = $_POST['last_name'];
                    $subject = $_POST['subject'];
                    $subject2 = "Copy of your email submission";
                    $message = $first_name . " wrote the following:" . "\n\n" . $_POST['message'];
                    $message2 = "Thank you for your email. \n\n Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

                    $headers = 'From: ' . $from . "\r\n" .
                        'Reply-To: ' . $from . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    $headers2 = 'From: ' . $to . "\r\n" .
                        'Reply-To: ' . $to . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    if ($_SESSION['status'] = 'NS') {
                        mail($to,$subject,$message,$headers);
                        mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
                        $_SESSION['send_status'] = "Mail Sent Successfully";
                    }
                #Do calculation here. Store in $_SESSION.
                    $_SESSION['status'] = 'S';
    	   } else {
                    $_SESSION['send_status'] = "All details are mandatory";
           }
         header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

 
   ?>
