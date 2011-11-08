<?php
	require_once "codebits_helper.php";
	session_start();
	if(isset($_SESSION['token'])){
		if(isset($_GET['userid'])){
			$data = get_user_sessions($_GET['userid'], $_SESSION['token']);
			if(isset($data['error'])){
				echo "no such user.";
			}else{
				if(count($data) == 0){
					echo "user has no favorite sessions.";
				}else{
					echo "<ul>";
					foreach($data as $item => $value){
						echo "<li>";
						echo "<span class=\"emph\">" . $value['id'] . " - " . $value['title'] . "</span></br>(" . $value['start'] . " - " . $value['place'] . ")";
						echo "</li>";
					}
					echo "</ul>";
				}
			}
		}else{
			echo "no user_id was provided.";
		}
	}else{
		echo "this operation requires authentication. please, login first.";
	}
?>