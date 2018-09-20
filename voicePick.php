<?php
//receive AT Posts
$sessionId =            $_POST['sessionId'];
$isActive  =            $_POST['isActive'];
$direction =            $_POST['direction'];
$callerNumber =         $_POST['callerNumber'];
$destinationNumber =    $_POST['destinationNumber'];
$dtmfDigits  =          $_POST['dtmfDigits'];
$recordingUrl =         $_POST['recordingUrl'];
$durationInSeconds  =   $_POST['durationInSeconds'];
$currencyCode  =        $_POST['currencyCode'];
$amount  =              $_POST['amount'];

require_once('AfricasTalkingGateway.php');
require_once('config.php');

$gateway  = new AfricasTalkingGateway($username, $apiKey,"sandbox");

if ($isActive == 1)  {
      //For English press 1, For Kiswahili press 2
      $response  = '<?xml version="1.0" encoding="UTF-8"?>';
      $response .= '<Response>';
      $response .= '<GetDigits timeout="30" finishOnKey="#" callbackUrl="http://www.miathenehigh.ac.ke/callcenter/language_convertor.php">';
      $response .= '<Play url="http://www.miathenehigh.ac.ke/callcenter/audio/welcome_tone.mp3"/>';
      $response .= '</GetDigits>';
      $response .= '</Response>';

      // Print the response onto the page so that our gateway can read it
      header('Content-type: application/xml');
      echo $response;

}
else {
  // You can then store this information in the database for your records
$sessionId =             $_POST['sessionId'];
$isActive  =             $_POST['isActive'];
$direction =             $_POST['direction'];
$callerNumber =          $_POST['callerNumber'];
$recordingUrl =          $_POST['recordingUrl'];
$durationInSeconds  =    $_POST['durationInSeconds'];
$currencyCode  =         $_POST['currencyCode'];
$amount  =               $_POST['amount'];
//$data=$conn->query("INSERT INTO call_log (record_url,duration,currency,amount) VALUES('$recordingUrl','$durationInSeconds','$currencyCode','$amount')");

}

?>