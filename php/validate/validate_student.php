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
$other_print = "";

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
if ($_POST['major'] == "Other")
{
  //set a variable and store the other error message in it
  $other_print .= "PRINT SOME MESSAGE ABOUT BEING AN OTHER.<br>";

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

//passwords given do not match
if ($_POST['password'] == $_POST['rePassword']) 
{
    $errors = True;
    $error_message .= "Passwords do not match.<br>";
}
  
if ($errors != True) 
{
  //No errors - GOOD - Insert into database
  $uName = $_POST['username'];
  $email = $_POST['email'];
  $major = $_POST['major'];
  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $studentID = $_POST['studentID']
  $password = $_POST['password'];
 
  $sql = "insert into `students` (`Username`, `email`, `Major`, `Appt`, `id`, `firstName`, `lastName`, `studentID`, `Password`) values ('$uName', '$email', '$major', NULL, NULL, '$fName', '$lName', '$studentID', '".md5($password)."'); 
  $rs = mysql_query($sql, $conn);
 
  session_start();
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['otherMessage'] = $other_print;

  // Go to the student_view.php file
  header('Location:../view/student_view.php');
}
else
{
  // Go to the register_student_error.html file
  require('../../html/error_forms/register_student_error.html');
}
?>
