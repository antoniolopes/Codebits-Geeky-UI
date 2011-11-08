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
			echo "<ul><li><span class=\"emph\"> " .$data['id']. " - " . $data['name'] . "</span>";
				echo "<ul>";
					echo "<li><span class=\"emph\">status</span>: " . $data['status'] . "</li>";
					echo "<li><span class=\"emph\">karma</span>: ". $data['karma'] ."</li>";
					echo "<li><span class=\"emph\">twitter</span>: @" . $data['twitter'] . "</li>";
					echo "<li><span class=\"emph\">blog</span>: " . $data['blog'] . "</li>";
				echo "</ul>";
			echo "</li>";
			echo "</ul>";
		}
	}else{
		echo "this operation requires authentication. please, login first.";
	}
?>