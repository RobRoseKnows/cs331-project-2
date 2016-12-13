<?php

$value1 = "Schedule appointment";
$value2 = "Print schedule";
$value3 = "Seach appointments";

$value = isset($_POST['next']) ? $_POST['next'] : "";
echo $value;

if($value == $value1) {
  header('Location: view/advisor_view.php');
} 

if($value == $value2) {
  header('Location: print_appts.php');
}

if($value == $value3) {
  header('Location: schedule_');
}
?>