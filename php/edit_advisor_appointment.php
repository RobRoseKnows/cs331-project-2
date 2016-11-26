<!-- edit_advisor_appointment.php -->
<!-- This file will edit the appointment from the appointments table and then update the students table to make sure the student is not in an appointment that does not exist -->
<?php
require('../html/header.html');
require_once('./mysql_connect.php');
$id = $_POST['ID'];
$sql = "SELECT * FROM appointments WHERE id=".$id.";";
$rs = mysql_query($sql, $conn);
$appt = mysql_fetch_array($rs);
if(isset($_POST['cancelEditAppointment'])){
    header("Location: view/advisor_view.php");
}elseif (isset($_POST['confirmEditAppointment'])){
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    //Date left blank check
    if ($date == "")
    {
        $date = $appt['Date'];
    }

    // Time left blank check
    if ($time == "")
    {
        $time = $appt['Time'];
    }

    // Date in the past check
    if($date <= $todayStr && $time <= $currTime && $error_message == ""){
        $date = $appt['Date'];
        $time = $appt['Time'];
    }

    //Location left blank check
    if ($location == "")
    {
        $location = $appt['Location'];
    }
    $sql = 'UPDATE appointments SET Date="'.$date.'", Time="'.$time.'", Location="'.$location.'" WHERE id='.$id.";";
    $rs = mysql_query($sql, $conn);


    // Notify all of the scheduled students about the update
    $sql = 'SELECT * from students WHERE Appt='.$id.';';
    $rs = mysql_query($sql, $conn);
    while($row = mysql_fetch_assoc($rs)){
        $to = $row['email'];
        $subject = 'Alert: Advising Appointment Rescheduled';
        $message = file_get_contents('../html/appointment_changed_email.html');
        $header = "From: noreply@umbc.edu \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-type: text/html\r\n";
        mail($to, $subject, $message, $header);
    }

    header("Location: view/advisor_view.php");
}
?>
<h1>Edit an appointment </h1>
<html>
<form action="edit_advisor_appointment.php" method="post">
    <?php
    echo("<input type=hidden name='ID' value=".$id." />");
    echo('<p>Date: <input type=date name="date" value="'.$appt['Date'].'"/></p>');
    $times = array("08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "01:00", "01:30", "02:00", "02:30", "03:00", "03:30", "04:00", "04:30");
    $ends = array("am", "am", "am", "am", "am", "am", "am", "am", "pm", "pm", "pm", "pm", "pm", "pm", "pm", "pm", "pm", "pm");
    echo('Time: <select name="time">');
    for($i = 0; $i < count($times); $i++){
        echo('<option value="'.$times[$i].'"');
        if($times[$i] == $appt['Time']){
            echo(" selected");
        }
        echo('>'.$times[$i].$ends[$i].'</option>');
    }
    echo('</select></p>');
    echo('<p>Location: <input type=text name="location" value="'.$appt['Location'].'"/></p>');
    ?>

    <input type="submit" value="Cancel" name="cancelEditAppointment">
    <input type="submit" value="Confirm" name="confirmEditAppointment">
</form>