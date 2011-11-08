<?php
	require_once "codebits_helper.php";
	$data = list_badges();
	echo "<ul>";
	foreach($data as $it => $item){
		echo "<li><span class=\"emph\">" . $item['id'] . " - " . $item['title'] . "</span>";
		echo "<ul><li>" . $item['description'] . "</li><li><i>User Count</i>: " . $item['usercount'] . "</li></ul></li>";
	}
	echo "</ul>";
?>