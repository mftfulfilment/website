<?php
require "./vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['name']) && isset($_POST['email'])) {

    
    $name =$_POST['name'];//req
    $phone =$_POST['phone'];//req
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to      = 'support@mftfulfillmentcentre.com';
    $subject = $subject;
    $message = 'Phone: ' . $phone  . '<br/>' . 'email: ' . $email . '<br /><br />' . $message;
    $headers = 'From: webmaster@example.com'       . "\r\n" .
                 'Reply-To: ' . $email . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}
header("Location: /boom");
