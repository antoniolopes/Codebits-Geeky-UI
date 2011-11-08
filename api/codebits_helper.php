<?php

require_once "curl_helper.php";

function curl_call($url, $params){
	return json_decode(curl_post($url, $params, array(CURLOPT_HEADER => 0), TRUE), TRUE);
}

function authenticate_user($username, $password){
	return curl_call("https://services.sapo.pt/Codebits/gettoken", array("user" => $username, "password" => $password));
}

function list_badges(){
	return curl_call("https://services.sapo.pt/Codebits/listbadges", array());
}

function list_badge_users($badgeid){
	return curl_call("https://services.sapo.pt/Codebits/badgesusers/".$badgeid, array());
}

function get_user_info($userid, $token){
	return curl_call("https://services.sapo.pt/Codebits/user/".$userid, array("token" => $token));
}

function get_user_friends($userid, $token){
	return curl_call("https://services.sapo.pt/Codebits/foaf/".$userid, array("token" => $token));
}

function add_user_friend($userid, $token){
	return curl_call("https://services.sapo.pt/Codebits/foafadd/".$userid, array("token" => $token));
}

function reject_user_friend($userid, $token){
	return curl_call("https://services.sapo.pt/Codebits/foafreject/".$userid, array("token" => $token));
}

function get_user_sessions($userid, $token){
	return curl_call("https://services.sapo.pt/Codebits/usersessions/".$userid, array("token" => $token));
}

function get_session_info($sessionid){
	return curl_call("https://services.sapo.pt/Codebits/session/".$sessionid, array());
}

function get_sub_talks($token){
	return curl_call("https://services.sapo.pt/Codebits/calltalks", array("token" => $token));
}

function vote_talk_up($talkid, $token){
	return curl_call("https://services.sapo.pt/Codebits/calluptalk/".$talkid, array("token" => $token));
}

function vote_talk_down($talkid, $token){
	return curl_call("https://services.sapo.pt/Codebits/calldowntalk/".$talkid, array("token" => $token));
}

function calendar(){
	return curl_call("https://services.sapo.pt/Codebits/calendar", array());
}

function list_accepted_users($token){
	return curl_call("https://services.sapo.pt/Codebits/users", array("token" => $token));
}

?>