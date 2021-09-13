<?php
require "./vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['name'])) {

   
    $to      = 'support@mftfulfillmentcentre.com';
    $subject = 'the subject';
    $message = 'hello';
    $headers = 'From: mailer@noreply.mftfulfillmentcentre.com'       . "\r\n" .
                 'Reply-To: info@mftfulfillmentcentre.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

}
header("Location: /");
