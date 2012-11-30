<?php 
require_once('dbconnect.php');

$db = DbUtil::loginConnection();
$stmt = $db -> stmt_init();

echo $_SERVER['PHP_AUTH_USER'];

if($stmt -> prepare("SELECT course, grade, instructor, year_offered, semester FROM grades WHERE comp_id = ?") or die(mysqli_error($db))) {
                echo 'now';
                $stmt -> bind_param("s", $_SERVER['PHP_AUTH_USER']);
                $stmt -> execute();
                $stmt -> bind_result($excourse, $exgrade, $exinst, $exyear, $exsem);
                while ($stmt -> fetch()) {
                  echo 'LOTS OF FUCKING SHIT';
                }
}
 ?>