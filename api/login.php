<?php
	if(isset($_GET['username']) && isset($_GET['password'])){
		if($_GET['username']== "" || $_GET['password'] == ""){
			echo "no empty usernames or passwords, please.";
		}else{
			require_once "codebits_helper.php";
			$data = authenticate_user($_GET['username'], $_GET['password']);
			if(isset($data['uid'])){
				session_start();
				$_SESSION["uid"] = $data["uid"];
				$_SESSION["token"] = $data["token"];
				$_SESSION["lastlogin"] = $data["lastlogin"];
				$_SESSION["lastip"] = $data["lastip"];
				echo "login successful. you can now execute other commands that require authentication.";
			}else{
				echo "there seems to be something wrong with your credentials.";
			}
		}
	}else{
		echo "unknown error.";
	}
?>