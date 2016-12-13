<!-- student_view.php -->
<!-- This file shows the student what appointment they are signed up for and if they are not signed up give them the option to sign up -->

<html>
<head>
<title>View Appointments</title>
	<link rel='stylesheet' type='text/css' href='../../html/standard.css'/>
   	<link rel='icon' type='image/png' href='../../html/standard.css'/>
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

<div id="background">
<left><div id="wrapper">
<h1>CMNS Advising</h1>
	
<?php
require_once('../mysql_connect.php');
session_start();
require_once('../check_disabled.php');
require_once('../banner.php');
echo "Notice: " . $_SESSION['otherMessage']; 
// Set timezone to the east coast
date_default_timezone_set('America/New_York');
// Get all info about advisors 
$sql = "SELECT * FROM advisors WHERE 1";
$rs = mysql_query($sql, $conn);
if(mysql_fetch_array($rs))
  {
    //Getting Appointment Number
    $sql = "SELECT Appt FROM students WHERE Email='" . $_SESSION['username'] . "'";
    $rs = mysql_query($sql, $conn);
  
    $sqlRow = mysql_fetch_array($rs);
    $studentApptNum = $sqlRow['Appt']; 
    echo "Logged in as: " . $_SESSION['username']; 
    echo  "<pre>  <a href = '../../html/forms/first_page.html'>Log Me Out</a></pre>";
    // Use isset instead of just if for best practices.
    if(isset($studentApptNum)) { ?>

<table>
<tr>
<th>Date</th>
<th>Time</th>
<th>Advisor</th>
<th>Location</th>
<th>Group</th>
<th>#Students</th>
</tr>

	<?php } 
    require_once('../mysql_connect.php'); 
    //Showing the students appointment
    $sql = "SELECT * FROM appointments WHERE id='" . $studentApptNum . "' ORDER BY Date ASC, Time ASC";
    $rs = mysql_query($sql, $conn);
    $appt = mysql_fetch_array($rs);
    // Print out the student's appointment 
    if(isset($appt))
      {
	echo "<tr>";
	echo "<td>" . $appt['Date'] . "</td>";
	echo "<td>" . date("g:ia", strtotime($appt['Time'])) . "</td>";
	echo "<td>" . $appt['Advisor'] . " (" .$appt['AdvisorUsername'] . ")</td>";
	echo "<td>" . $appt['Location'] . "</td>";
  
	// Check if the appointment is a group or not 
	if($appt['isGroup'] == 0)
	  echo "<td>" . "No" . "</td>";
  else
    echo "<td>" . "Yes" . "</td>";
	echo "<td>" . $appt['NumStudents'] . "</td>";
	echo "</tr>";
      }
    // If the user has not appointment currently scheduled 
else
  {
    echo "<h3>No appointment scheduled</h3>";
  }
?>
</table>

<?php
    if ( isset( $studentApptNum ) )
      {
	$_SESSION['appt'] = $studentApptNum;
	// Print a button to cancel the student appointment 
	echo '<form method=post action="../cancel_student_appointment.php">';
	echo '<input type=submit value="Cancel Appointment"/>';
	echo '</form>';
      }
else
  {
    // Print a button to schedual an appointment 
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

	<h3 style='color: #FF0000;'>Copyright umbc.edu</h3>

</div>
</left>
</div>
</body>
</html>

<?php include('../../html/footer.html'); ?>
