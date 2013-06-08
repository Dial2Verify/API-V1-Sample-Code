<?php

/**
 * @author Dial2Verify Labs, India
 * @copyright 2013
 * Built on Dial2Verify API V1 ( http://kb.dial2verify.in/?q=5 )
 */

   // Accept Telephone Number As An Input     
	$TelNumber=substr($_REQUEST["phone_number"],-10);
	
  // Replace with your Dial2Verify API Passkey generated using ( http://kb.dial2verify.in/?q=5 )
    $API_KEY='RA$WORLD_TEST';
    
    $json = array();
	$json["status"] = "unverified";
	$VerificationCall="http://engine.dial2verify.in/Integ/API.dvf?passkey=$API_KEY&Token=Verify&No=$TelNumber";

   // Make a call to Dial2Verify API & Parse The JSON Response
	$VerificationPayload=json_decode(file_get_contents($VerificationCall),true);
	$VerificationStatus=$VerificationPayload["Verified"];
	
   // Verify User Telephone Verification Status
	if ( $VerificationStatus ==1 ) 
	$json["status"] = "Verified";
	Else
	$json["status"] = "unverified";
	
   // Write a JSON Object response 
    header('Content-type: application/json');
    echo(json_encode($json));



?>
