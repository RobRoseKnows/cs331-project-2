<!-- validate_appointment.php -->
<!-- This file will make sure that an advisor does not input an invalid appointment -->

<?php

require_once('../mysql_connect.php');
session_start();

// Creates the query to get the information from the appointments database where the username is equal to the current session username
$sql = "SELECT Date, Time FROM appointments WHERE AdvisorUsername = \"". $_SESSION['username'] . "\"";
$rs = mysql_query($sql, $conn);
$errors = "False";
$error_message = "";

// Set the time zone to the east coast 
date_default_timezone_set('America/New_York');

// Post all the information input by the advisor
$date = $_POST['date'];
$time = $_POST['time'];
$location = $_POST['location'];
$group = $_POST['group'];

// Create a date for today 
$today = date_create();
$todayStr = date_format($today, 'Y-m-d');
$currTime = date_format($today, 'G:i');

//Time not already scheduled check
while($row = mysql_fetch_array($rs)) 
{
  if ($time == $row['Time'] && $date == $row['Date'])
  {
    //Match found - BAD - there is an error
    $errors = True;
    $error_message = "This appointment is already scheduled<br>";
  }
}

//Date left blank check
if ($date == "") 
{
  $errors = True;
  $error_message .= "Date field can't be blank.<br>";
}

//Date already past 
if($date <= $todayStr && $time <= $currTime && $error_message == "")
{
  $errors = True;
  $error_message .= "You may not schedule appointments in the past.<br>";
}

//Location left blank check
if ($location == "") 
{
  $errors = True;
  $error_message .= "Location field can't be blank.<br>";
}

// If there are errors 
if($errors != "True")
{
  // Get the information from the advisors database for the fullName
  // This will be used in the next query 
  $sql = "SELECT fullName FROM advisors WHERE Username = \"" . $_SESSION['username'] . "\"";
  $rs = mysql_query($sql, $conn);
  $fullName = mysql_fetch_array($rs)['fullName'];

  echo $sql;
	
  // Insert a new appointment into the appointments table
  $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername) VALUES (\"" . $date . "\", \"" . $time . "\", \"" . $location . "\", " . $group . ", \"" . $fullName . "\", \"" . $_SESSION['username'] . "\")";                    
  $rs = mysql_query($sql, $conn);

  // Go back to the advisor_view.php 
  header('Location:../view/advisor_view.php');
}
else
{
  // Go to the error page for add appoinment 
  require('../../html/error_forms/add_appointment_error.html');
}
?>