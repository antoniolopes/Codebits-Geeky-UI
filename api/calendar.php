<?php
	require_once "codebits_helper.php";
	$data = calendar();
	echo "<ul>";
	foreach($data as $it => $item){
		echo "<li><span class=\"emph\">" . $item['title']."</span>";
		echo "<ul>";
		echo "<li><b>Start</b>: " . $item['start'] . "</li>";
		echo "<li><b>End</b>: " . $item['end'] . "</li>";
		echo "</ul>";
		echo "</li>";
	}
	echo "</ul>";
?>