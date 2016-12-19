<?php

$value1 = "Schedule appointment";
$value2 = "Print schedule";
$value3 = "Seach appointments";
$value4 = "Log Out";

$value = isset($_POST['next']) ? $_POST['next'] : "";
echo $value;

if($value == $value1) {
  header('Location: ../html/forms/add_appointment.php');
} 

if($value == $value2) {
  header('Location: print_appts.php');
}

if($value == $value3) {
  header('Location: schedule_');
}
if($value == $value4) {
    header('Location: ../html/forms/first_page.html');
}
?>