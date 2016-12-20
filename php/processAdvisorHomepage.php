<?php
session_start();

$value1 = "Schedule appointment";
$value2 = "Print schedule";
$value3 = "Search appointments";

$value = isset($_POST['next']) ? $_POST['next'] : "";
echo $value;

if($value == $value1) {
  header('Location: ../html/forms/add_appointment.php');
} 

if($value == $value2) {
  header('Location: print_appts.php');
}

if($value == $value3) {
  $_SESSION['search'] = "";
  header('Location: search_appts.php');
}
?>
