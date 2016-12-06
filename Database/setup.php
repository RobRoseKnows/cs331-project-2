<?php
include_once("../php/mysql_connect.php");
    $advisorSql = "CREATE TABLE 'advisors'(
'Email' TEXT,
'id' INT(11) NOT NULL AUTO_INCREMENT,
'fullName' TEXT NOT NULL,
'Office' TEXT NOT NULL,
'Password' TEXT NOT NULL,
'setEndOfSeason' TINYINT(1) DEFAULT '0',
PRIMARY KEY ('id'),
KEY 'id' ('id')
)";

    $appointmentsSql = "CREATE TABLE 'appointments' (
'id' INT(11) NOT NULL AUTO_INCREMENT,
'Advisor' TEXT NOT NULL,
'NumStudents' TINYINT(4) NOT NULL,
'Date' VARCHAR(10) NOT NULL,
'Time' VARCHAR(5) NOT NULL,
'isGroup' TINYINT(1) NOT NULL,
'isFull' TINYINT(1) NOT NULL,
'Location' TEXT NOT NULL,
'AdvisorUsername' TEXT NOT NULL,
PRIMARY KEY ('id')
)";

    $studentsSql = "CREATE TABLE 'appointments'(
'Email' text NOT NULL,
'Major' text NOT NULL,
'Appt' int(11) DEFAULT NULL,
'id' int(11) NOT NULL AUTO_INCREMENT,
'firstName' text NOT NULL,
'lastName' text NOT NULL,
'studentID' varchar(9) NOT NULL,
'Password' text NOT NULL,
PRIMARY KEY ('id'),
KEY 'id' ('id')
)";

    mysql_query($advisorSql, $conn);
    mysql_query($appointmentsSql, $conn);
    mysql_query($studentsSql, $conn);
?>