<?php
	require_once "codebits_helper.php";
	session_start();
	if(isset($_SESSION['token'])){
		$data = list_accepted_users($_SESSION['token']);
		if(isset($data['error'])){
			echo "no such user.";
		}else{
			echo "<ul>";
			foreach($data as $it => $item){
				echo "<li> " . $item['id'] . " - " . $item['name'] . "</li>";
			}
			echo "</ul>";
		}
	}else{
		echo "this operation requires authentication. please, login first.";
	}
?>