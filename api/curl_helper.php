<?php

function curl_post($url, $params, $options, $with_result){
	// create a new cURL resource
	$ch = curl_init();

	// set URL
	$full_url = $url."?";
	foreach($params as $param => $value){
		$full_url = $full_url.$param."=".urlencode($value)."&";
	}
	curl_setopt($ch, CURLOPT_URL, $full_url);

	// set other appropriate options
	foreach($options as $option => $value){
		curl_setopt($ch, $option, $value);
	}
	
	// If result is expected, activate this option
	if($with_result)
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // This will return a result in JSON/XML instead for just TRUE/FALSE
	
	// Execute cURL request
	$result = curl_exec($ch);
	
	// close cURL resource, and free up system resources
	curl_close($ch);
	
	return $result;
}

?>