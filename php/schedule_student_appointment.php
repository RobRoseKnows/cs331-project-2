<!-- schedule_student_appointment.php --> 
<!-- This code shows a form to look up advisors by the date --> 

<?php include ('../html/header.html'); ?>

<h1>Schedule an appointment </h1>
    <form method=post action="get_appointments.php">
	<h3>When would you like to schedule the appointment?</h3>
	<p>Choose Week: <select name="week"/>
	<option value = 0 selected>this week</option>
	<option value = 1> next week</option>

	<!-- THIS CODE GETS THE NEXT TWO WEEK OPTIONS -->
	<?php  
        // Set time zone to the east coast
	date_default_timezone_set('America/New_York');
	$date = date_create(); // Today
	$daysToSunday = (7 - date_format($date, 'w')) % 7;
	$nextSunday = date_modify($date, "+$daysToSunday day");
	$newSunday = date_modify($nextSunday, '+7 day');
	echo "<option value = 2>week of ";
	$string = date_format($newSunday, 'l, M. j');
        echo $string;
	echo " </option> ";
	$newSunday2 = date_modify($newSunday, '+7 day');
	echo "<option value = 3>week of ";
        $string2 = date_format($newSunday2, 'l, M. j');
        echo $string2;
	echo " </option> ";
	?>
	<!-- END PHP -->
	</select>
	</p>
	
    <p>Group? 
	<select name="group">
	  <option value=1>Yes</option>
	  <option value=0>No</option>
	  <option value=2 selected>Don't care</option>
		</select>
	</p>
    <p><input type=submit value="Submit"/></p>
    </form>
    <!-- HyperLink to search appointments by advisor --> 
    <p><a href = "search_advisor.php"> Or Look Up By Advisor </a></p>
	
<?php include ('../html/footer.html'); ?>