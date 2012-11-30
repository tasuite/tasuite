<?php 
require_once('dbconnect.php');

$db = DbUtil::loginConnection();
$stmt = $db -> stmt_init();

if($stmt -> prepare("SELECT fname, lname, personal_statement, year, school FROM applicant WHERE comp_id = ?") or die(mysqli_error($db))) {
	$stmt -> bind_param("s", $_GET['compid']);
	$stmt -> execute();
	$stmt -> bind_result($fname, $lname, $ps, $year, $school);
	$stmt -> fetch();

	echo '<h3>' . $fname . ' ' . $lname . '\'s Application (' . $_GET['compid'] . ')</h3>';
	echo '<p><strong>' . $year . ", " . $school . '</strong></p>';
	echo '<p><strong>Personal Statement:</strong> ' . $ps . '</p>';
}

echo '<hr>';

echo '<h4>' . $fname . '\'s Grades</h4>';

if($stmt -> prepare("SELECT course, grade, instructor, semester, year_offered FROM grades WHERE comp_id = ?") or die(mysqli_error($db))) {
	$stmt -> bind_param("s", $_GET['compid']);
	$stmt -> execute();
	$stmt -> bind_result($course, $grade, $instructor, $semester, $year_offered);
	while ($stmt -> fetch()) {
		echo '<strong>' . $course . '</strong> ' . $semester . ' ' . $year_offered . ' (' . $instructor . '): ' . $grade . '<br>';
	}
}

echo '<hr>';

echo '<h4>' . $fname . '\'s Availability</h4>';

if($stmt -> prepare("SELECT course, section_day_time FROM availability NATURAL JOIN sections WHERE compid = ? ORDER BY sis_section_number") or die(mysqli_error($db))) {
	$stmt -> bind_param("s", $_GET['compid']);
	$stmt -> execute();
	$stmt -> bind_result($course, $sec);
	while ($stmt -> fetch()) {
		echo '<strong>' . $course . '</strong> ' . $sec . '<br>'; 
	}
}

$stmt -> close();
$db -> close();
 ?>