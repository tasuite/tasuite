<?php 
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
$data = json_decode(file_get_contents($_GET['url'],false,$context), true);

echo "Constructed URL is (click for raw JSON): <a href=\"" . $_GET['url'] . "\" target=\"_blank\">" . $_GET['url'] . "</a>";

foreach($data as $student) {
	echo("<hr>");
	echo("<strong>Computing ID:</strong> " . $student['compid'] . "<br>");
	echo("<strong>Name:</strong> " . $student['lname'] . ', ' . $student['fname'] . "<br>");
	echo("<strong>Role:</strong> " . $student['role'] . '<br>');
}
 ?>