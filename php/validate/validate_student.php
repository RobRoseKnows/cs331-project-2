<!-- validate_student.php -->
<!-- This file checks if the student registering is entering valid information -->

<?php
require_once('../mysql_connect.php');

// Finds all the usernames from the database
$sql = "SELECT Username FROM students";
$rs = mysql_query($sql, $conn);

//By default no errors
$errors = False;
$error_message = "";

//Loop through usernames, check for match
while($username = mysql_fetch_array($rs)) 
{
  if ($_POST['username'] == $username['Username']) 
  {
    //Match found - BAD - there is an error
    $errors = True;
    $error_message = "Username already taken<br>";
    break;
  }
}

//Username left blank check
if ($_POST['username'] == "") 
{
  $errors = True;
  $error_message .= "Username field can't be blank.<br>";
}

//Major left blank check
if ($_POST['major'] == "") 
{
  $errors = True;
  $error_message .= "Major field can't be left blank.<br>";
}

// First name left blank check
if ($_POST['firstName'] == "")
{
  $errors = True;
  $error_message .= "First Name field can't be left blank.<br>";
}

// Last name left blank check
if ($_POST['lastName'] == "")
{
  $errors = True;
  $error_message .= "Last Name field can't be left blank.<br>";
}

// StudentID left blank check
if ($_POST['studentID'] == "") 
{
  $errors = True;
  $error_message .= "Student ID field can't be left blank.<br>";
}

// email left blank check
if ($_POST['email'] == "")
{
  $errors = True;
  $error_message .= "Email field can't be left blank.<br>";
}

if ($errors != True) 
{
  //No errors - GOOD - Insert into database
  $sql = "INSERT INTO students (username, major, email, firstName, lastName, studentID) VALUES (\"" . $_POST['username'] . "\", \"" . $_POST['major'] . "\", \"" . $_POST['email'] . "\", \"" . $_POST['firstName'] . "\", \"" . $_POST['lastName'] . "\", \"" . $_POST['studentID'] . "\")";
  $rs = mysql_query($sql, $conn);
  session_start();
  $_SESSION['username'] = $_POST['username'];

  // Go to the student_view.php file
  header('Location:../view/student_view.php');
}
else
{
  // Go to the register_student_error.html file
  require('../../html/error_forms/register_student_error.html');
}
?>