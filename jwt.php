<?php



//$fields = array(
//	'username' => 'Emawebdesign',
//	'name' => 'Emanuele'
//);
//


function getJwt($fields = array(),$secretkey = NULL) {

	$encoded_header = base64_encode('{"alg": "HS256","typ": "JWT"}');

	$encoded_payload = base64_encode(json_encode($fields));

	$header_payload = $encoded_header . '.' . $encoded_payload;

	$signature = base64_encode(hash_hmac('sha256', $header_payload, $secretkey, true));

	$jwt_token = $header_payload . '.' . $signature;

	return $jwt_token;

}

function checkJwt($token = NULL,$secretkey = NULL) {

	$jwt_values = explode('.', $token);

	$recieved_signature = $jwt_values[2];

	$recievedHeaderAndPayload = $jwt_values[0] . '.' . $jwt_values[1];

	echo $recievedHeaderAndPayload . "\n";

	$resultedsignature = base64_encode(hash_hmac('sha256', $recievedHeaderAndPayload, $secretkey, true));

	echo $resultedsignature . "---" . $recieved_signature . "\n";

	if ($resultedsignature == $recieved_signature)
	    return true;
	else
	    return false;

}

//$token = getJwt($fields, $secret_key);

//echo $token ."<br>";

//if (checkJwt($token, $secret_key)) echo "Token valid";
//else echo "Token invalid!";
?>