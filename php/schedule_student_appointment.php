<!-- schedule_student_appointment.php --> 
<!-- This code shows a form to look up advisors by the date --> 

<?php include ('../html/header.html'); ?>

<html lang="en">
   <head>
   <link rel='stylesheet' type='text/css' href='../html/standard.css'/>
   <link rel='icon' type='image/png' href='../html/standard.css'/>
   </head>
<body>
<div id="background">

<left><div id="wrapper">
<h1>Welcome to CMNS Advising</h1>
<h2>Schedule an appointment </h2>
    <form method=post action="get_appointments.php">
        <!--<center><pre><h2>When would you like to schedule the appointment?</h2></p\
re></center>-->
        <pre><h4>Choose Week: <select name="week">
        <option value = 0 selected>This Week</option>
        <option value = 1> Next Week</option>

        <!-- THIS CODE GETS THE NEXT TWO WEEK OPTIONS -->
        <?php
        // Set time zone to the east coast                                            
        date_default_timezone_set('America/New_York');
        $date = date_create(); // Today                                               
        $daysToSunday = (7 - date_format($date, 'w')) % 7;
        $nextSunday = date_modify($date, "+$daysToSunday day");
        $newSunday = date_modify($nextSunday, '+7 day');
        echo "<option value = 2>Week of ";
        $string = date_format($newSunday, 'l, M. j');
        echo $string;
        echo " </option> ";
        $newSunday2 = date_modify($newSunday, '+7 day');
        echo "<option value = 3>Week of ";
        $string2 = date_format($newSunday2, 'l, M. j');
        echo $string2;
        echo " </option> ";
        ?>
        <!-- END PHP -->
        </select>
        </h4></pre>
	
    <pre><h4>Group? <select name="group">
          <option value=1>Yes</option>
          <option value=0>No</option>
          <option value=2 selected>Do not care</option>
                </select>
        </h4></pre>
    <p><input type=submit value="Submit"/></p>
    </form>
    <!-- HyperLink to search appointments by advisor -->
    <p><a href = "search_advisor.php"> Or Look Up By Advisor </a></p>

	<h3 style='color: #FF0000;'>Copyright umbc.edu</h3>

</div>
</left>
</div>
</body>
</html>
<?php include ('../html/footer.html'); ?>
