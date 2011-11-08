<?php
	require_once "codebits_helper.php";
	session_start();
	if(isset($_SESSION['token'])){
		$data = array();
		if(isset($_GET['userid'])){
			$data = get_user_info($_GET['userid'], $_SESSION['token']);
		}else{
			$data = get_user_info($_SESSION['uid'], $_SESSION['token']);
		}
		if(isset($data['error'])){
			echo "no such user.";
		}else{
			echo "<ul><li><span class=\"emph\">" . $data['name'] . "</span>";
				echo "<ul>";
					echo "<li><span class=\"emph\">bio</span>: " . $data['bio'] . "</li>";
				echo "</ul>";
			echo "</li>";
			echo "</ul>";
		}
	}else{
		echo "this operation requires authentication. please, login first.";
	}
?>