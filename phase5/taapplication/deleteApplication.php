<?php 
require_once('dbconnect.php');

$db = DbUtil::loginConnection();
$stmt = $db -> stmt_init();

if ($stmt -> prepare("DELETE FROM availability WHERE compid = ?")) {
	$stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
	$stmt -> execute();
	$db -> commit();
}

if ($stmt -> prepare("DELETE FROM grades WHERE comp_id = ?") or die(mysqli_error($db))) {
	$stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
	$stmt -> execute();
	$db -> commmit();
}

if ($stmt -> prepare("DELETE FROM applicant WHERE ")) {
	# code...
}
 ?>