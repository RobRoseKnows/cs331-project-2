<!-- student_view.php -->
<!-- This file shows the student what appointment they are signed up for and if they are not signed up give them the option to sign up -->

<html>
<head>
<title>View Appointments</title>
<style>
table, th, td {
     border: 1px solid black;
										     }
td {
  text-align:center; 
  vertical-align:middle;
}
form {
position:relative;
top:8px;
}
</style>
</head>
<body>

<?php
session_start();
require('../../CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);
if( isset($_SESSION["other_message"]))
{
echo "Notice: " . $_SESSION["other_message"]; 
}
// Set timezone to the east coast
date_default_timezone_set('America/New_York');

// Get all info about advisors 
$sql = "SELECT * FROM `advisors`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

if(mysql_fetch_array($rs))
  {
    //Getting Appointment Number
    $sql = "SELECT `Appt` FROM `students` WHERE `Email`='" . $_SESSION["email"] . "'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $row = mysql_fetch_row($rs);
    $studentApptNum=$row[0];
    $_SESSION['appt'] = $row[0];

    echo "Logged in as: " . $_SESSION["email"]; 
    echo  "<pre>  <a href = '../../html/forms/first_page.html'>Log Me Out</a></pre>";

    if ( !is_null(($studentApptNum) ))
      {
	// Print a button to cancel the student appointment 
	echo '<form method=post action="../cancel_student_appointment.php">';
	echo '<input type=submit value="Cancel Appointment"/>';
	echo '</form>';
      }
else
  {
    // Print a button to schedule an appointment 
    echo '<form method=post action="../schedule_student_appointment.php">';
    echo '<input type=submit value="Schedule Appointment"/>';
    echo '</form>';
  }
?>

    <?php } 
//handles the case if no advisors have made an appointment
else
  {
    echo "Sorry, no advisors exist<br/>";
    echo  "<pre> <a href = '../../html/forms/first_page.html'>Log Me Out</a></pre>";
  }
?>


<?php include('../../html/footer.html'); ?>