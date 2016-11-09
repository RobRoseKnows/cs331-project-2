<!-- validate_student_login.php -->
<!-- This file will check if the student logging in is entering a valid value --> 

<?php

require_once('../mysql_connect.php');

// Make a query to get the usernames from the students database
$sql = "SELECT Username FROM students";
$rs = mysql_query($sql, $conn);
$name_found = False;
$error_message = "";

//Checking if name in db - GOOD if found
while($username = mysql_fetch_array($rs)) 
{
  if ($_POST['username'] == $username['Username']) 
  {
    $name_found = True;
  }
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
  
  // Check if the username was not found in the data base
  else 
  {
    $error_message = "Username not recognized.<br>";
  } 
  
  // go to the student_login_error.html file 
  include('../../html/error_forms/student_login_error.html');
}
?>
