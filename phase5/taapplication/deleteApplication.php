<?php 
require_once('dbconnect.php');

$db = DbUtil::loginConnection();
$stmt = $db -> stmt_init();

if ($stmt -> prepare("DELETE FROM availability WHERE compid = ?") or die(mysqli_error($db))) {
	$stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
	$stmt -> execute();
}

if ($stmt -> prepare("DELETE FROM grades WHERE comp_id = ?") or die(mysqli_error($db))) {
	$stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
	$stmt -> execute();
}

if ($stmt -> prepare("DELETE FROM applicant WHERE comp_id = ?") or die(mysqli_error($db))) {

	$stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
	$stmt -> execute();
}
$db -> commit();
$stmt -> close();
$db -> close();
 ?>

<html>
<head>
	<title>Application Deleted</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	}
	</style>
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a style="color: white" class="brand" href="#">TA Application</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row-fluid">
			<div class="span10">
				<legend>Application Deleted</legend>
				<div class="alert alert-danger">
					Your application has been deleted from the system.  This action was permanent.  You may re-apply at anytime by returning to the application page,
					however, though all information must be re-entered.
				</div>
				<form action="index.php" method="POST"><button class="btn btn-success">Go Back</button></form>
				<form action="http://its.virginia.edu/netbadge/logout.html" method="POST"><button class="btn btn-danger">Netbadge Logout</button></form>
			</div>
		</div>
	</div>
</body>
</html>