<?php
//AT POST
$sessionId =             $_POST['sessionId'];
$isActive  =             $_POST['isActive'];
$direction =             $_POST['direction'];
$callerNumber =          $_POST['callerNumber'];
$destinationNumber =     $_POST['destinationNumber'];
$dtmfDigits  =           $_POST['dtmfDigits'];
$recordingUrl =          $_POST['recordingUrl'];
$durationInSeconds  =    $_POST['durationInSeconds'];
$currencyCode  =         $_POST['currencyCode'];
$amount  =               $_POST['amount'];
//params
require_once('AfricasTalkingGateway.php');
require_once('config.php');

// Create a new instance of our awesome gateway class
$gateway  = new AfricasTalkingGateway($username, $apiKey,"sandbox");

switch($dtmfDigits){
    case "1":
       // redirect to english menu selection.
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Redirect>http://www.miathenehigh.ac.ke/callcenter/english/english_voiceIVR.php</Redirect>';
        $response .= '</Response>';

        // Print the response onto the page so that our gateway can read it
        header('Content-type: application/xml');
        echo $response;
        break;

    case "2":
       // redirect to kiswahili menu selection.
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Redirect>http://www.miathenehigh.ac.ke/callcenter/kiswahili/kiswahil_voiceIVR.php</Redirect>';
        $response .= '</Response>';

        // Print the response onto the page so that our gateway can read it
        header('Content-type: application/xml');
        echo $response;
        break;

    default:
        // replay the message to the user, once any number received
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Redirect>http://www.miathenehigh.ac.ke/callcenter/voicePick.php</Redirect>';
        $response .= '</Response>';

        // Print the response onto the page so that our gateway can read it
        header('Content-type: application/xml');
        echo $response;
    break;
}

?>
