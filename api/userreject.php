<?php
	require_once "codebits_helper.php";
	session_start();
	if(isset($_SESSION['token'])){
		if(isset($_GET['userid'])){
			$data = reject_user_friend($_GET['userid'], $_SESSION['token']);
			if(isset($data['error'])){
				echo "no such user.";
			}else{
				//print_r($data);
				//echo "guess everything went well. don't really know.";
				echo "done.";
			}
		}else{
			echo "no user_id was provided.";
		}
	}else{
		echo "this operation requires authentication. please, login first.";
	}
?>