<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    $date = date('y-m-d');
    $email_owner = "Doctor";    
    
    if($account_type == 'user'){
       $email_owner = "Client"; 
    }
    //send email to the client
    $message = "
     <h2>Your are receiving this email from your ".$email_owner."</h2>
     <p>".$email_owner." Name: ".$first_name." ".$last_name."</p>
     <p>".$email_owner." Email: ".$email."</p>
     <p>".$email_owner." Contact: ".$number."</p>
     <p>Your Appoint has been set up.</p>
    ";

    require_once "vendor/autoload.php";

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0; 
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                               
        $mail->Username = 'wolfarmtechnologies.uganda@gmail.com';     
        $mail->Password = '(Danks6669)';                        
        $mail->SMTPSecure = 'tls';                           
        $mail->Port = 587;                                   

        $mail->setFrom('wolfarmtechnologies.uganda@gmail.com');

        //Recipients
        $mail->addAddress($client_email);              
        $mail->addReplyTo($email);

        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'My Doctor Feedback';
        $mail->Body    = $message;

        $mail->send();

        $_SESSION['success'] = 'Email sent';
        $message_error = $_SESSION['success'];
    } 
    catch (Exception $e) {
        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
        $message_error = $_SESSION['error'];
    }

