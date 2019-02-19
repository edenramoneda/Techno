<?php
    // Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

             
             $e = $_POST["e"];
             $message = $_POST["m"];
             try {
                 
                 $mail = new PHPMailer(true);
                 //Enable SMTP debugging. 
                 $mail->SMTPDebug = 4;
                 //Set PHPMailer to use SMTP.
                 $mail->isSMTP();
                 //Set SMTP host name                          
                 $mail->Host = 'smtp.gmail.com';
                 //Set this to true if SMTP host requires authentication to send email
                 $mail->SMTPAuth = true;
                 //Provide username and password     
                 $mail->Username = 'ramsweetsph@gmail.com';
                 $mail->Password = "leeminhobebe143";
                 //If SMTP requires TLS encryption then set it/
                 $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                 $mail->Port = 587;   
             //   $mail->sender = $_POST["email"];
                 $mail->setFrom('ramsweetsph@gmail.com', 'RAM Sweets PH');
                 $mail->addReplyTo($e, $_POST["fn"]);
                 $mail->addAddress('ramsweetsph@gmail.com');
                 $mail->isHTML(true);
                 $mail->Subject = 'RAM Sweets PH Inquiry from ' . $_POST['fn'] . ' <'. $e .'> ' ;
                 $mail->Body = $message;
                 $mail->AltBody = $message;
                 $mail->send(); 
             } catch (Exception $e) {
                 echo "<script>alert('" . "Message has not been sent" . "')</script>", $mail->ErrorInfo;
             }
        // }
 

?>