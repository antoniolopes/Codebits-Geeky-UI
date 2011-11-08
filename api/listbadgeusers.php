<?php
	require_once "codebits_helper.php";
	if(isset($_GET['badgeid'])){
		$data = list_badge_users($_GET['badgeid']);
		if(count($data) > 0){
			echo "<ul>";
			foreach($data as $it => $item){
				echo "<li>" . $item['uid'] . " - " . $item['name'] . "</li>";
			}
			echo "</ul>";
		}else{
			echo "invalid badge_id or there are no users with this badge.";
		}
	}else{
		echo "no badge_id was provided.";
	}
?>