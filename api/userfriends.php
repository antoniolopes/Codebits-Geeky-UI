<?php
	require_once "codebits_helper.php";
	session_start();
	if(isset($_SESSION['token'])){
		$data = array();
		if(isset($_GET['userid'])){
			$data = get_user_friends($_GET['userid'], $_SESSION['token']);
		}else{
			$data = get_user_friends($_SESSION['uid'], $_SESSION['token']);
		}
		if(isset($data['error'])){
			echo "no such user.";
		}else{
			echo "<ul>";
			foreach($data as $it => $item){
				echo "<li> " . $item['id'] . " - " . $item['name'] . " (" .$item['state']. ")</li>";
			}
			echo "</ul>";
		}
	}else{
		echo "this operation requires authentication. please, login first.";
	}
?>