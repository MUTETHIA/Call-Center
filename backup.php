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


//fetch finance phone numbers from db for calling the numbers
   $stmt=$conn->query("SELECT phone_number from contact_table WHERE section_id=1");
   $financephone=array();
 while($row=mysqli_fetch_assoc($stmt)){
   $financephone[]=$row['phone_number'];
 }
 $finance_record= implode(",",$financephone);


 //fetch SCI phone numbers from db for calling the numbers
    $scistmt=$conn->query("SELECT phone_number from contact_table WHERE section_id=2");
    $sciphone=array();
 while($rowsci=mysqli_fetch_assoc($scistmt)){
    $sciphone[]=$rowsci['phone_number'];
 }
 $sci_record= implode(",",$sciphone);


// Create a new instance of our awesome gateway class
$gateway  = new AfricasTalkingGateway($username, $apiKey,"sandbox");

switch($dtmfDigits){
    case "0":
    // Talk to finance sectio and routing to various phone numbers... Compose the response
    $response  = '<?xml version="1.0" encoding="UTF-8"?>';
    $response .= '<Response>';
    //$response .= '<Say>Please hold while we connect you to Sales.</Say>';
    $response .= '<Play url="http://www.miathenehigh.ac.ke/callcenter/audio/mmust.mp3"/>'; //this will play the audio of alerting the customer, wait as the call is being transfered to the finance section
    $response .= '<Dial sequential="false" phoneNumbers="test.sandbox@ke.sip.africastalking.com,'.$finance_record.' " ringbackTone="http://www.miathenehigh.ac.ke/callcenter/audio/mmust.mp3"/>';
    $response .= '</Response>';

    // Print the response onto the page so that our gateway can read it
    header('Content-type: application/xml');
    echo $response;
    break;

    case "1":
        // Talk to support... Compose the response
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Say>Please hold while we connect you to School of Computing.</Say>';
        $response .= '<Dial sequential="false" phoneNumbers="test.sandbox@ke.sip.africastalking.com,'.$sci_record.'" ringbackTone="http://www.miathenehigh.ac.ke/callcenter/audio/mmust.mp3"/>';
        $response .= '</Response>';
    
        // Print the response onto the page so that our gateway can read it
        header('Content-type: application/xml');
        echo $response;
    break;

    case "2":
        // Talk listen again..
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Redirect>http://www.miathenehigh.ac.ke/callcenter/voicePick.php</Redirect>';
        $response .= '</Response>';

        // Print the response onto the page so that our gateway can read it
        header('Content-type: application/xml');
        echo $response;
        break;

    default:
        // Talk to support... Compose the response
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Say voice="man">Please hold while we connect you to Support.</Say>';
        $response .= '<Dial sequential="true" phoneNumbers="test.sandbox@ke.sip.africastalking.com,+234708843466" ringbackTone="http://www.miathenehigh.ac.ke/callcenter/audio/mmust.mp3"/>';
        $response .= '</Response>';

        // Print the response onto the page so that our gateway can read it
        header('Content-type: application/xml');
        echo $response;
    break;
}


?>
