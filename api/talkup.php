<?php
	require_once "codebits_helper.php";
	session_start();
	if(isset($_SESSION['token'])){
		if(isset($_GET['talkid'])){
			$data = vote_talk_up($_GET['talkid'], $_SESSION['token']);
			if(isset($data['error'])){
				echo "no such talk.";
			}else{
				//print_r($data);
				//echo "guess everything went well. don't really know.";
				echo "done.";
			}
		}else{
			echo "no talk_id was provided.";
		}
	}else{
		echo "this operation requires authentication. please, login first.";
	}
?>