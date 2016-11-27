<!-- validate_advisor.php -->
<!-- This file will validate the registration of the advisor -->

<?php
require_once('../mysql_connect.php');

$sql = "SELECT username FROM advisors";
$rs = mysql_query($sql, $conn);

//By default no errors
$errors = False;
$error_message = "";

//Loop through usernames, check for match
while($username = mysql_fetch_array($rs)) 
{
  if ($_POST['username'] == $username['username']) 
  {
    //Match found - BAD - there is an error
    $errors = True;
    $error_message = "Username already taken<br>";
  }
}

//Username left blank check
if ($_POST['username'] == "") 
{
    $errors = True;
    $error_message .= "Username field can't be blank.<br>";
}

//First name left blank check
if ($_POST['fName'] == "") 
{
    $errors = True;
    $error_message .= "First name field can't be blank.<br>";
}

//Last name left blank check
if ($_POST['lName'] == "") 
{
    $errors = True;
    $error_message .= "Last name field can't be blank.<br>";
}

//office left blank
if ($_POST['office'] == "")
  {
    $errors = True;
    $error_message .= "Office field can't be blank.<br>";
  }

//passwords given do not match
if ($_POST['password'] == $_POST['rePassword']) 
{
    $errors = True;
    $error_message .= "Passwords do not match.<br>";
}

if ($errors != True) 
{
  //No errors - GOOD - Insert into database
  $fullName = $_POST['fName'] . " " . $_POST['lName'];
  $uName = $_POST['username'];
  $office = $_POST['office'];
  $password = $_POST['password'];
  
  $sql = "insert into `advisors` (`Username`, `id`, `fullName`, `Office`, `Password`) values ('$uName', NULL, '$fullName', '$office', '".md5($password)."'); 
  $rs = mysql_query($sql, $conn);
  
  session_start();
  $_SESSION['username'] = $_POST['username'];
  header('Location:../../php/view/advisor_view.php');
}
else
{
  require('../../html/error_forms/register_advisor_error.html');
}
?>
