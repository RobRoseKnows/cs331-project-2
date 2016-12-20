<?php
if (!isset($_SESSION)) {
    session_start();
}

<<<<<<< HEAD
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
=======

//makes changes
$preferred = $_POST["prefName"];
$email = $_SESSION["studentEmail"];
>>>>>>> master

//Actually update student data
include_once "mysql_connect.php";
$sql = "update `students` set `prefName` = '$preferred', `Major` = '$major' where `Email` = '$email'";
$rs = mysql_query($sql, $conn);

header('Location: view/student_view.php');
?>
