<!-- student_view.php -->
<!-- This file shows the student what appointment they are signed up for and if they are not signed up give them the option to sign up -->

<html>
<head>
    <title>View Appointments</title>
    <link rel='stylesheet' type='text/css' href='../../html/standard.css'/>
    <link rel='icon' type='image/png' href='../../html/corner.png'/>
    <style>
        table, th, td {
            border: 1px solid black;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        form {
            position: relative;
            top: 8px;
        }
    </style>
</head>
<body>

<div id="background">
<left><div id="wrapper">
<h1>CMNS Advising</h1>
    
<?php
session_start();
require('../../CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);
if (isset($_SESSION["other_message"])) {
    echo("Notice: " . $_SESSION["other_message"]);
    echo("<br>");
}
// Set timezone to the east coast
date_default_timezone_set('America/New_York');

// Get all info about advisors 
$sql = "SELECT * FROM `advisors`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);


echo '<form method=post action="../editStudentInfo.php">';
echo '<input type=submit value="Edit Information"/>';
echo '</form>';


if(mysql_fetch_array($rs))
  {
    //Getting Appointment Number
    $sql = "SELECT `Appt` FROM `students` WHERE `Email`='" . $_SESSION["email"] . "'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $row = mysql_fetch_row($rs);
    $studentApptNum = $row[0];
    $_SESSION['appt'] = $row[0];

    echo "Logged in as: " . $_SESSION["email"];
    echo "<pre>  <a href = '../../html/forms/first_page.html'>Log Me Out</a></pre>";

    if (!is_null(($studentApptNum))) {
      //print a table containing info about the student's appointment
?>
<center><table>
<tr>
<th>Date</th>
<th>Time</th>
<th>Location</th>
<th>Advisor</th>
</tr>
<?php

	//Get the appointment information
	$sql2 = "SELECT `SessionLeader`, `Date`, `Time`, `Location` FROM `appointments` WHERE `id` = $studentApptNum";
      $rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
      $myRow = mysql_fetch_row($rs2);
      
      echo"<tr>";
      echo"<td class='not_register'>" .$myRow[1] . "</td>";
      echo"<td class='not_register'>" .$myRow[2] . "</td>";
      echo"<td class='not_register'>" .$myRow[3] . "</td>";
      echo"<td class='not_register'>" .$myRow[0] . "</td>";
      
        // Print a button to cancel the student appointment
      echo"<td>";
        echo '<form method=post action="../cancel_student_appointment.php">';
        echo '<input type=submit value="Cancel Appointment"/>';
        echo '</form>';
	echo"</td>";
    } else {
        // Print a button to schedule an appointment
        echo '<form method=post action="../schedule_student_appointment.php">';
        echo '<input type=submit value="Schedule Appointment"/>';
        echo '</form>';
    }
    ?>
</table></center>

<?php } //handles the case if no advisors have made an appointment
else {
    echo "Sorry, no advisors exist<br/>";
    echo "<pre> <a href = '../../html/forms/first_page.html'>Log Me Out</a></pre>";
}
?>

    <h3 style='color: #FF0000;'>Copyright umbc.edu</h3>

</div>
</left>
</div>
</body>
</html>

<?php include('../../html/footer.html'); ?>
