<!-- add_appointment.html -->
<!-- This file is the form for the advisor to create and appointment -->

<?php
require('../../html/header.html');

require_once('../../php/mysql_connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['appointmentError'])) {
    echo($_SESSION['appointmentError']);
    unset($_SESSION['appointmentError']);
}
if (isset($_POST['ID'])) {
    $id = $_POST['ID'];
    //Get the appointment from the table
    $sql = "SELECT * FROM appointments WHERE id=" . $id;
    $rs = mysql_query($sql, $conn);
    if($rs != false){
        $appt = mysql_fetch_assoc($rs);
        $date = $appt['Date'];
        $time = $appt['Time'];
        $location = $appt['Location'];
        $isGroup = $appt['isGroup'];
        $maxAttendees = $appt['MaxAttendees'];
        echo("<h1>Modify an appointment </h1>");
    }
    else{
        echo("<h1>Add an appointment </h1>");
    }
} else {
    echo("<h1>Add an appointment </h1>");
}

echo('<form method=post action="../../php/validate/validate_appointment.php">');
//Gets the necessary information about the appontment, date, time, location, group

if (isset($id)) {
    echo("<input type=hidden name='ID' value=" . $id . " />");
}
echo('<label>Date: <input type="date" name="date"');
if (isset($date)) {
    echo(' value="' . $date.'"');
}
echo(' required/></label> <br>');
// Time is restricted to only having the times between 8:00am and 4:30 pm selected in 30 minutes increments
$times = array("8:00", "8:30", "9:00", "9:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "1:00", "1:30", "2:00", "2:30", "3:00", "3:30", "4:00", "4:30", "5:00");
$ends = array("am", "am", "am", "am", "am", "am", "am", "am", "pm", "pm", "pm", "pm", "pm", "pm", "pm", "pm", "pm", "pm", "pm");
echo('<label>Time: <select name="time" required>');
for ($i = 0; $i < count($times) - 1; $i++) {
    echo('<option value="' . str_pad($times[$i], 5, "0", STR_PAD_LEFT) . '"');
    if (!isset($time) && $i == 0) {
        echo(" selected");
    }
    if (isset($time) && $times[$i] == $time) {
        echo(" selected");
    }
    echo('>' . $times[$i] . $ends[$i] . ' - ' . $times[$i + 1] . $ends[$i + 1] . '</option>');
}
echo("</select></label><br>");
echo('<label>Location: <input type = text name = "location"');
if(isset($location)){
    echo(' value='.$location);
}
echo (' required></label><br>');
echo('<label> Group Advising Session ? <select name = "group" required >');
echo('<option value = 1 selected > Yes</option >');
echo('<option value = 0');
if(isset($isGroup) && $isGroup == 0){
   echo(" selected");
}
echo('>No</option >');
echo('</select ></label><br >');
echo('<label > Maximum Number of Attendees: <input type = text name = "maxAttend"');
if(isset($maxAttendees)){
    echo(' value='.$maxAttendees);
}
echo(' required></label ><br >');
echo('<label > Session Leader: <select name = "leader" required >');
$advisors = array('Ms. Michelle Bulger', 'Ms. Julie Crosby', 'Ms. Christine Powers', 'CNMS Advisors');
for($i = 0; $i < count($advisors); $i++){
    echo('<option value="'.$advisors[$i].'"');
    if(isset($leader) && $leader == $advisors[$i]){
        echo(' selected');
    }
    echo('>'.$advisors[$i].'</option>');
}
echo('</select ></label ><br >');
echo('<p ><input type = submit value = "Submit" /></p >');
echo('</form >');
require('../../html/footer.html'); ?>
