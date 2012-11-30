<html>
<head>
	<title>Current Applicants</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	}
	</style>
	<script>
		$(document).ready(function(){
			$('.applicant').click(function(){
				var comp_id = $(this).attr('id');
				$.ajax({
					url: 'getApplicantInfo.php',
					data: {compid : comp_id},
					success: function(data) {
						$('#lookupResult').html(data);
					}
				})
			})
		})
	</script>
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
			<div class="span6">
				<legend>Current Applicants</legend>
				<table class="table table-hover">
					<thead>
						<th>Last</th>
						<th>First</th>
						<th>Year</th>
						<th>School</th>
					</thead>
					<tbody>
						<?php 
						require_once('dbconnect.php');

						$db = DbUtil::loginConnection();
						$stmt = $db -> stmt_init();

						if ($stmt -> prepare("SELECT comp_id, fname, lname, year, school FROM applicant ORDER BY lname") or die(mysqli_error($db))) {
							$stmt -> execute();
							$stmt -> bind_result($comp_id, $fname, $lname, $year, $school);
							while ($stmt -> fetch()) {
								switch ($year) {
									case "1st Year":
										$year = "1st";
										break;
									case "2nd Year":
										$year = "2nd";
										break;
									case "3rd Year":
										$year = "3rd";
										break;
									case "4th Year":
										$year = "4th";
										break;
									case "5th Year":
										$year = "5th";
										break;
								}
								switch ($school) {
									case 'School of Engineering and Applied Science':
										$school = "SEAS";
										break;
									case 'College of Arts and Sciences':
										$school = "CLAS";
										break;
									case 'School of Nursing':
										$school = "NURS";
										break;
									case 'School of Architecture':
										$school = 'SARC';
										break;
									case 'School of Commerce':
										$school = 'COMM';
										break;
								}
								echo '<tr class="applicant" id="' . $comp_id . '"><td>' . $lname . '</td><td>' . $fname . '</td><td>' . $year . '</td><td>' . $school . '</td></tr>';
							}
						}
						$stmt -> close();
						$db -> close();
						 ?>
					</tbody>
				</table>
			</div>
			<div class="span6">
				<legend>Applicant Info</legend>
				<div id="lookupResult"></div>
			</div>
		</div>
	</div>
</body>
</html>
