<?php
require "./vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['name']) && isset($_POST['email'])) {
    try {
        
    $mail = new PHPMailer(true);

// $mail->SMTPDebug = 2;   
    $name =$_POST['name'];//req
    $subject =$_POST['phone'];//req
    $email = $_POST['email'];
//    $message = $_POST['message'];

    $content = file_get_contents("./email.html", true);

    foreach ($_POST as $key => $value) {
        $content = str_replace('{{'.$key.'}}', $value, $content);
    }
//$message .= "Name is :"."&nbsp;".$name."<br />";
    $message = trim($content);

// $mail->isSendmail();
   /*   $mail->IsSMTP(true);                                           // Set mailer to use SMTP
$mail->Host = 'smtp.sendgrid.net';                          // Specify main and backup server
$mail->Port = 465;                                                 // Set the SMTP port
$mail->SMTPAuth = true;                                            // Enable SMTP authentication
$mail->Username = 'apikey';                // SMTP username
$mail->Password = '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';                              // SMTP password
    $mail->SMTPSecure = 'ssl';                                     // Enable encryption, 'ssl' also accepted
        */

              
            $mail->IsSMTP(true);                                           // Set mailer to use SMTP
$mail->Host = 'premium50.web-hosting.com';                          // Specify main and backup server
$mail->Port = 465;                                                 // Set the SMTP port
$mail->SMTPAuth = true;                                            // Enable SMTP authentication
$mail->Username = 'mailer@noreply.mftfulfillmentcentre.com';                // SMTP username
$mail->Password = 'YEg-!cLaURf+';                              // SMTP password
    $mail->SMTPSecure = 'ssl';   
        
        

    $mail->setFrom('mailer@noreply.mftfulfillmentcentre.com', 'noreply');
    // $mail->FromName = 'MFT Fulfillment Website Query';


//   $mail->addAddress('samaksh@electrovese.com','dsds');
    $mail->addAddress('info@mftfulfillmentcentre.com','dsds');

//   $mail->AddAddress('charanjeetelectrovese@gmail.com');
    $mail->IsHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Query From User '. $name;
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    }
    echo 'Message has been sent';
} catch (Exception $e) {
        echo $e;
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
header("Location: /")
?>
