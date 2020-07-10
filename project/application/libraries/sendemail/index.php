<?php


$url = 'https://api.sendgrid.com/';
$apiKey = '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';

//api library from sendgrid
require_once "sendgrid-php.php";

$sendgrid = new SendGrid($apiKey);
$email = new  \SendGrid\Mail\Mail();

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("amitprasad0135@gmail.com", "dasdak");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("amitprasad0135@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
//$sendgrid = new \SendGrid(getenv('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'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
/*//require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
 require("sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("amitprasad0135@gmail.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("test@example.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('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'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
*/
?>