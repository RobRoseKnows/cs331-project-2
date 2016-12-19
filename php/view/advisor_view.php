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

<center><table border="0">
<tr>
<form action="../processAdvisorHomepage.php" method="post" name="Home">
  <td><input type="submit" name="next" class="button main selection" value="Schedule appointment"></td>

  <td><input type="submit" name="next" class="button main selection" value="Print schedule"></td>

  <td><input type="submit" name="next" class="button main selection" value="Search appointments"></td>
</form>
</tr>
</table></center>

<?php
//advisor_view.php
//This file shows the advisor what appointments they have scheduled

require_once('../mysql_connect.php'); 
session_start();

//reset search variable to empty string
$_SESSION['search'] = "";

// set the timezone to the east coast
date_default_timezone_set('America/New_York');

//Fetching appointments
$sql = "SELECT * FROM appointments WHERE AdvisorEmail='" . $_SESSION['email'] . "' ORDER BY Date ASC, Time ASC";
$rs = mysql_query($sql, $conn);

// Tell the user who they are logged in as
echo "Logged in as: " . $_SESSION['email']; 
echo  "<pre>  <a href = '../../html/forms/first_page.html'>Log Me Out</a></pre>";


// If there was no appointment, $rs will be false
if($rs)
{
  // Get the appointments
  $appt = mysql_fetch_array($rs);

  // Prints out the titles of the table
  echo "<h3> My Scheduled Appointments </h3>";	
  echo "<table>";
  echo "<tr>";
  echo "<th>Date</th>";
  echo "<th>Time</th>";
  echo "<th>Location</th>";
  echo "<th>Group</th>";
  echo "<th>#Students</th>";
  echo "<th>View Registered Students</th>";
  echo "</tr>";

  // Now this cycles through the section of the query 
  while ($appt) {
    echo "<tr>";
    echo "<td>" . $appt['Date'] . "</td>";
    echo "<td>" . date("g:ia", strtotime($appt['Time'])) . "</td>";
    echo "<td>" . $appt['Location'] . "</td>";

    // check if the appointment is a group appointment or not 
    if($appt['isGroup'] == 0)
      echo "<td>" . "No" . "</td>";
    else
      // not a group appointment
      echo "<td>" . "Yes" . "</td>";

    echo "<td>" . $appt['NumStudents'] . "</td>";
 
    $apptID = $appt['id'];
  
    // Print out the check students button if there are students signed up for the appointment
    if ($appt['NumStudents'] > 0)
    {
      echo "<td>";
      echo "<form method=post action='view_students.php'>";
      echo "<input type=hidden name='ID' value='$apptID' />";
      echo "<input type=submit value='View Registered Students'/>";
      echo "</form>";
      echo "</td>";

      // If there are not any students signed up then tell the user that 
    } else {
      echo "<td>No Students Registered</td>";
    }

    ?>
    <td>
      <form method=post action="../../html/forms/add_appointment.php">
        <?php echo "<input type=hidden name='ID' value='$apptID' />"; ?>
        <input type=submit name=editAppointment value="Edit"/>
      </form>
    <form method=post action="../cancel_advisor_appointment.php">
       <?php echo "<input type=hidden name='ID' value='$apptID' />"; ?>
       <input type=submit value="Cancel"/>
       </form>
	 </td> 
<?php
  echo "</tr>";
  $appt = mysql_fetch_array($rs);
}
  echo "</table>";
}

else
{
  echo "<h3>You have not scheduled any appointments</h3>";
}
?>
<form method=post action="../../html/forms/add_appointment.php">
   <input type=submit value="Add Appointment"/>
</form>
<br/>

<p> Register an Advisor: Click <a href = "../../html/forms/register_advisor.html">here</a> to register.</p>

<h3 style='color: #FF0000;'>Copyright umbc.edu</h3>

</div>
</left>
</div>
</body>
</html>
