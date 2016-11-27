<!-- validate_student_login.php -->
<!-- This file will check if the student logging in is entering a valid value --> 

<?php

require_once('../mysql_connect.php');

$username = $_POST['username'];
$password = ($_POST['password']);
$truePassword = md5($password);

// Make the query to get the info out of advisors table
$sql = "SELECT * FROM `students` WHERE `Username` = '$username' AND `Password` = '$truePassword'";
$rs = mysql_query($sql, $conn);
$name_found = False;
$error_message  = "";

//count of how many many rows are returned when query is run 
$num_rows = mysql_num_rows($rs);

//if only one match, password correct
if($num_rows == 1){
   $name_found = True;
}

// This is the pass case
if ($name_found) 
{
  session_start();
  $_SESSION['username'] = $_POST['username'];

  // go to the student_view.php page
  header('Location:../../php/view/student_view.php');
} 

// This is the fail case
else
{
  // Check if the username was left blank
  if ($_POST['username'] == "") 
  {
    $error_message .= "Username field can't be blank.<br>";
  }
  
  // Check if the username or password was not found in the data base
  else 
  {
    $error_message = "Username or password not recognized.<br>";
  } 
  
  // go to the student_login_error.html file 
  include('../../html/error_forms/student_login_error.html');
}
?>
