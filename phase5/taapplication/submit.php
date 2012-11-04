<?php 
require_once('dbconnect.php');

$db = DbUtil::loginConnection();
$stmt = $db -> stmt_init();

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
				<p>
					Your application has been submitted.  You may update your application at any time.
				</p>
				<p>	
					<?php 
					printArray($_POST);
					function printArray($array, $pad=''){
						foreach ($array as $key => $value){
							echo $pad . "$key => $value <br>";
							if(is_array($value)){
								echo "NEW ARRAY\n";
								printArray($value, $pad.' ');
							}  
						}	 
					}
					?>
				</p>
			</div>
		</div>
	</div>
</body>
</html>