<!-- validate_advisor_login.php -->
<!-- This file contains validation for the advisor login, it will post the correct error message to the advisor_login_error.html page --> 

<?php

require_once('../mysql_connect.php');

$username = $_POST['username'];
$password = ($_POST['password']);
$truePassword = md5($password);

// Make the query to get the info out of advisors table
$sql = "SELECT * FROM `Advisor Data` WHERE `Username` = '$username' AND `Password` = '$truePassword'";
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
  header('Location:../../php/view/advisor_view.php');
} 

// This is the fail case
else
{
  // Username field left blank
  if ($_POST['username'] == "") 
  {
    $error_message .= "Username field can't be blank.<br>";
  }

  // Username does not exist in the table OR password is incorrect
  else 
  {
    $error_message = "Username or password not recognized.<br>";
  } 
  
  include('../../html/error_forms/advisor_login_error.html');
}
?>
