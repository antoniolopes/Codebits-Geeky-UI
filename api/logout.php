<?php
	session_start();
	if(isset($_SESSION['uid'])){
		session_destroy();
		echo "logout executed. you cannot execute commands that require authentication now.";
	}else{
		echo "you don't seem to have a session opened, so logout is pointless actually.";
	}
?>