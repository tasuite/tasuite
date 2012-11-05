<?php 
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
$data = json_decode(file_get_contents($_GET['url'],false,$context), true);

echo "Constructed URL is (click for raw JSON): <a href=\"" . $_GET['url'] . "\" target=\"_blank\">" . $_GET['url'] . "</a>";

foreach($data as $regrade){
	echo "<hr>";
	echo "<strong>Computing ID:</strong> " . $regrade["compid"] . "<br>";
	echo "<strong>Assignment:</strong> " . $regrade['assignment'] . "<br>";
	echo "<strong>Description:</strong> " . $regrade['text'] . "<br>";
	echo "<strong>Status:</strong> " . $regrade['status'] . "<br>";
	echo "<strong>Date:</strong> " . $regrade['date'] . "<br>";
}
 ?>