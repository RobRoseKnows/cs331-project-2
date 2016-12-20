<?php
if (!defined('ADVISOR_LOGIN_PHP')) {
    define('ADVISOR_LOGIN_PHP', true);
    include("AdvisorSQL.php");
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['advisorID'])) {
        include("createAppointment.php");
    } else {
        if (isset($_POST['advisorSubmit'])) {
            if (isset($_POST['advisorEmail']) && isset($_POST['advisorPassword'])) {
                $advisorEmail = $_POST['advisorEmail'];
                $advisorPassword = $_POST['advisorPassword'];

                $hashedPassword = hash("sha256", $advisorPassword);

                $id = getAdvisorID($advisorEmail, $hashedPassword);
                if ($id != NULL) {
                    $_SESSION['advisorID'] = $id;
                    include_once("createAppointment.php");
                } else {
                    include("head.html");
                    echo('<p align="center"> <font color="red"> Login failed </font> </p>');
                    include("advisorLogin.html");

                    include("tail.html");

                }
            } else {
                include("head.html");
                echo('<p align="center"> <font color="red"> Login failed </font> </p>');
                include("advi