<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require 'PHPmailer/src/Exception.php';
require 'PHPmailer/src/PHPMailer.php';
require 'PHPmailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $surname= $_POST["surname"];


    $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                                 //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';            //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                        //Enable SMTP authentication
    $mail->Username   = 'sivaramans901@gmail.com';   //SMTP write your email
    $mail->Password   = 'nzcsqnogtmobjbdq';          //SMTP password
    $mail->SMTPSecure = 'ssl';                       //Enable implicit SSL encryption
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom( $_POST["email"], $_POST["name"]);   // Sender Email and name
    $mail->addAddress('karpagasivaraman955@gmail.com');       //Add a recipient email  
    $mail->addReplyTo($_POST["email"], $_POST["name"]);       // reply to sender email

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = $_POST["subject"];   // email subject headings
    $mail->Body    = $_POST["message"]; //email message

    // Success sent message alert
    $mail->send();
  
    echo
    " 
    <script> 
     alert('Message was sent successfully!');
     document.location.href = 'contact.html';
    </script>
    ";

    
    
}
?>