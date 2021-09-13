<?php
require "./vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['name'])) {

    $apiKey = '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';
    // $sg = new \SendGrid($apiKey);

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("test@example.com", "Example User");
    $email->setSubject("Sending with Twilio SendGrid is Fun");
    $email->addTo("support@mftfulfillmentcentre.com", "Example User");
    $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
    $email->addContent(
        "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
    );
    $sendgrid = new \SendGrid($apiKey);
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }

}
header("Location: /boom");
