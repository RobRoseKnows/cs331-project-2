<?php
session_start();

//grabs session vars
$_SESSION["firstName"] = mysql_real_escape_string($_POST["firstName"]);
$_SESSION["lastName"] = mysql_real_escape_string($_POST["lastName"]);
$_SESSION["studEmail"] = mysql_real_escape_string($_POST["studEmail"]);
$_SESSION["major"] = mysql_real_escape_string($_POST["major"]);

//makes changes changes
$firstn = mysql_real_escape_string($_POST["firstName"]);
$lastn = mysql_real_escape_string($_POST["lastName"]);
$email = mysql_real_escape_string($_POST["studEmail"]);
$major = mysql_real_escape_string($_POST["major"]);
$sid = $_SESSION["SIDNumber"];

//Actually update student data
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
	$sql = "update `students` set `firstName` = '$firstn', `lastName` = '$lastn', `Email` = '$email', `Major` = '$major' where `studentID` = '$sid'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

header('Location: view/student_view.php');
?>
