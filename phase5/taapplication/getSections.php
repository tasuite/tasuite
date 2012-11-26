<?php
require_once('dbconnect.php');

$db = DbUtil::loginConnection();
$stmt = $db -> stmt_init();

if($stmt -> prepare("SELECT id, section_day_time, sis_section_number FROM sections WHERE course = ?") or die(mysqli_error($db))) {
	$stmt -> bind_param("s", $_POST['cname']);
	$stmt -> execute();
	$stmt -> bind_result($sisid, $secdaytime, $sissecno);
	while($stmt -> fetch()) {
		echo '<label class="control-label" for="section' . $sissecno . '">' . $secdaytime . '</label>
                <div class="controls">
                  <div id="toggle-button" class="tb"><input name="section' . $sissecno . '" type="checkbox" value="' . $sisid .'" ></div>
                </div>';
	}
}

$stmt -> close();
$db -> close();

 ?>