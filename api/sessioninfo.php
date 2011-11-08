<?php
	require_once "codebits_helper.php";
	session_start();
	if(isset($_GET['sessionid'])){
		$data = get_session_info($_GET['sessionid']);
		if(isset($data['error'])){
			echo "no such session.";
		}else{
			echo "<ul><li><span class=\"emph\"> " .$data['title'] . "</span>";
				echo "<ul>";
					echo "<li><span class=\"emph\">where</span>: " . $data['placename'] . "</li>";
					echo "<li><span class=\"emph\">when</span>: ". $data['start'] ."</li>";
					echo "<li><span class=\"emph\">who</span>: ";
					foreach($data['speakers'] as $speaker){
						if(count($data['speakers']) > 1)
							echo ",";
						echo $speaker['name'];
					}
					echo "</li>";
					echo "<li><span class=\"emph\">what</span>: " . $data['description'] . "</li>";
			echo "</ul>";
			echo "</li>";
			echo "</ul>";
		}
	}else{
		echo "no session_id was provided.";
	}
?>