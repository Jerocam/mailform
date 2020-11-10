<?php

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;

   require 'config.php';
   require 'plugins/PHPMailer/src/Exception.php';
   require 'plugins/PHPMailer/src/PHPMailer.php';
   require 'plugins/PHPMailer/src/SMTP.php';

   $to = 'BlueOwlLearning@gmail.com';     //CHANGE THIS EMAIL ADDRESS FOR RECEIVING AN EMAIL FROM THE WEBSITE FORM
   $fullname = $_POST['fullname'];
   $subject = $_POST['subject'];
   $message = $_POST['message'];
   $email_from = $_POST['emailFrom'];
   $headers = "MIME-Version: 1.0" . "\r\n";
   $headers .= "From: " .$email_from. "\r\n";
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

   $mail = new PHPMailer(true);

   try {

      $mail->STMPOptions = array(
         'ssl'=> array(
            'verify_peer'=> false,
            'verify_peer_name'=> false,
            'allow_self_signed'=> true, 
         )
      );

      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = CONFIG['email']['host'];                // Set the SMTP server to send through
      $mail->SMTPAuth   = true; 
      $mail->Port       = CONFIG['email']['port'];                // Enable SMTP authentication
      $mail->SMTPSecure = CONFIG['email']['SMTPSecure'];          // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Username   = CONFIG['email']['username'];            // SMTP username
      $mail->Password   = CONFIG['email']['password'];            // SMTP password

      //Recipients
      $mail->AddReplyTo($email_from, $fullname);
      $mail->setFrom($email_from, $fullname);
      $mail->addAddress($to, 'Blue Owl');                            

      // Content
      $mail->isHTML(true);                                       // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $message;
      $mail->AltBody = strip_tags($message);

      $mail->send();
    
      echo 'Message has been sent';
      
   } 
   catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   }

?>