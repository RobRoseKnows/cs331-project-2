<?php
    
require('mysql_connect.php');
require('error_codes.php');

session_start();

// Grab the username and the requested action
$email = $_SESSION['username'];
$do = $_POST['do'];

// This query checks to see if the person on the page is an advisor.
$verifySQL = "SELECT id FROM advisors WHERE `Email` = $email";
$sqlResult = mysql_query($verifySQL, $conn);
$numRows = mysql_num_rows($sqlResult);

$resultCode = ErrorCode::$DISEN_DEFAULT_CODE;

if($do == 'disable') {

    if($numRows > 0) {
        $updateSQL = "UPDATE advisors SET setEndOfSession=TRUE WHERE `Email` = '$email'";
        mysql_query($updateSQL, $conn);
        $resultCode = ErrorCode::$SUCCESS_DISABLE_ADVISING;
    } else {
        $resultCode = ErrorCode::$FAILURE_DISABLE_ADVISING_NOT_ADVISOR;
    }

} else if($_POST['do'] == 'enable') {
    

    if($numRows > 0) {
        $updateSQL = "UPDATE advisors SET setEndOfSession=FALSE WHERE 1=1";
        mysql_query($updateSQL, $conn);
        $resultCode = ErrorCode::$SUCCESS_ENABLE_ADVISING;
    } else {
        $resultCode = ErrorCode::$FAILURE_ENABLE_ADVISING_NOT_ADVISOR;
    }
}

if($resultCode != ErrorCode::$FAILURE_DISABLE_ADVISING_NOT_ADVISOR && $resultCode != ErrorCode::$FAILURE_ENABLE_ADVISING_NOT_ADVISOR) {
    header("Location: view/advisor_view.php?done=$resultCode");    
} else {
    header("Location: view/student_view.php?done=$resultCode");
}

?>
