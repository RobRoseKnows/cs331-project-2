<!-- search_advisor.php -->
<!-- This file get the advisors by name and posts to them schedule_by_advisor.php
     this will eventually put them in a dropdown box -->

<!--<?php
include ('../html/header.html'); ?>-->

<html>
<head>
    <title>View Appointments</title>
    <link rel='stylesheet' type='text/css' href='../html/standard.css'/>
    <link rel='icon' type='image/png' href='../html/corner.png'/>
</head>
<div style="overflow:hidden">
    <img src="../html/background1.png" style="margin: 0 auto; height: 230px; overflow:hidden;"/>
</div>
<body id="background">
<left><div id="wrapper" style="margin: 0 auto; position: relative; top:10px; left:0;">
            <h1>CMNS Advising</h1>

            <?php
            // connect to the database
            include ('mysql_connect.php');
            // Show all of the session leaders
            $advisors = array('Ms. Michelle Bulger', 'Ms. Julie Crosby', 'Ms. Christine Powers', 'CMNS Advisors');
            ?>
            <h2>Choose An Advisor</h2>
            <form method=post action='schedule_by_advisor.php'>
                <select name="advisor">
                    <?php
                    // Prints out all the names of the advisors
                    foreach($advisors as $advisor) {
                        echo "<option value='" . $advisor . "'>" . $advisor . "</option>";
                    }
                    ?>
                </select>
                <input type=submit value="Submit"/>
            </form>

            <h3 style='color: #FF0000;'>Copyright umbc.edu</h3>

        </div>
    </left>
</div>
</body>
</html>

<?php include('../html/footer.html'); ?>