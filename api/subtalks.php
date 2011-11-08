<?php
	require_once "codebits_helper.php";
	session_start();
	if(isset($_SESSION['token'])){
		$data = get_sub_talks($_SESSION['token']);
		echo "<ul>";
		foreach($data as $item => $value){
			echo "<li>" . $value['id'] . " - " . $value['title'] . " (your rating: " . $value['rated'] . ")</li>";
		}
		echo "</ul>";
	}else{
		$data = get_sub_talks("");
		echo "<ul>";
		foreach($data as $item => $value){
			echo "<li>" . $value['id'] . " - " . $value['title'] . "</li>";
		}
		echo "</ul>";
	}
?>