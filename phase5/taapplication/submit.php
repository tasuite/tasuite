<?php 
require_once('dbconnect.php');
require_once('globals.php');

$db = DbUtil::loginConnection();
$stmt = $db -> stmt_init();
	if($stmt -> prepare("INSERT INTO applicant VALUES (?, ?, ?, ?, ?, ?)") or die(mysqli_error($db))) {
		$stmt -> bind_param("ssssss", $_POST['inputCompid'], $_POST['inputFname'], $_POST['inputLname'], $_POST['inputStatement'], $_POST['inputYear'], $_POST['inputSchool']);
		$stmt -> execute();
		$db -> commit();
	}


for ($i=1; $i <= $_POST['gradeCount']+0 ; $i++) { 
	$stmt = $db -> stmt_init();
	if ($stmt -> prepare("INSERT INTO grades VALUES (?, ?, ?, ?, ?, ?)") or die(mysqli_error($db))) {

		$stmt -> bind_param("ssssss", $_POST['inputCompid'], $_POST['inputCourse'.$i], $_POST['inputGrade'.$i], $_POST['inputInstructor'.$i], $_POST['inputSemester'.$i], $_POST['inputYear'.$i]);
		$stmt -> execute();
		$db -> commit();
	}
}

foreach ($_POST as $key => $value) {
	if(!(strpos($key, 'section') === false)) {
		$stmt = $db -> stmt_init();
		if($stmt -> prepare("INSERT INTO availability VALUES (?,?)") or die(mysqli_error($db))) {
			$stmt -> bind_param("ss", $value,  $_POST['inputCompid']);
			$stmt -> execute();
			$db -> commit();
		}
	}
}

$db -> close();
$stmt -> close();
?>

<html>
<head>
	<title>Thank You</title>
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
				<legend>Thank You</legend>
				<div class="alert alert-success">
					Your application has been submitted.  You may update your application at any time by returning to the form.
				</div>
				<form action="index.php" method="POST"><button class="btn btn-success">Go Back</button></form>
				<form action="http://its.virginia.edu/netbadge/logout.html" method="POST"><button class="btn btn-danger">Netbadge Logout</button></form>
			</div>
		</div>
	</div>
</body>
</html>