<!-- add_appointment.html -->
<!-- This file is the form for the advisor to create and appointment -->

<?php require('header.html'); ?>
    <h1>Add an appointment </h1>
    <form method=post action="../../php/validate/validate_appointment.php">
    <!-- Gets the necessary information about the appontment, date, time, location, group -->
    <label>Date: <input type="date" name="date" required/></label> <br>
      <!-- Time is restricted to only having the times between 8:00am and 4:30 pm selected in 30 minutes increments -->
    <label>  Time: <select name="time">
		<option value="08:00" selected>8:00am - 8:30am </option>
		<option value="08:30">8:30am - 9:00am</option>
		<option value="09:00">9:00am - 9:30am</option>
		<option value="09:30">9:30am - 10:00am</option>
		<option value="10:00">10:00am - 10:30am</option>
		<option value="10:30">10:30am - 11:00am</option>
		<option value="11:00">11:00am - 11:30am</option>
		<option value="11:30">11:30am - 12:00pm</option>
		<option value="12:00">12:00pm - 12:30pm</option>
		<option value="12:30">12:30pm - 1:00pm</option>
		<option value="13:00">1:00pm - 1:30pm</option>
		<option value="13:30">1:30pm - 2:00pm</option>
		<option value="14:00">2:00pm - 2:30pm</option>
		<option value="14:30">2:30pm - 3:00pm</option>
		<option value="15:00">3:00pm - 3:30pm</option>
		<option value="15:30">3:30pm - 4:00pm</option>
		<option value="16:00">4:00pm - 4:30pm</option>
		<option value="16:30">4:30pm - 5:00pm</option>
	</select></label><br>


    <label>Location: <input type=text name="location" optional/></label><br>
    <label>Group Advising Session? <select name="group" required>
	<option value=1 selected>Yes</option>
	<option value=0>No</option>
      </select></label><br>
    <label>Maximum Number of Attendees: <input type=text name="maxAttend" required></label><br>
    <label>Session Leader: <select name="leader" required>
	<option value='Ms. Michelle Bulger' selected> Ms. Michelle Bulger</option>
	<option value='Ms. Julie Crosby' selected> Ms. Julie Crosby</option>
	<option value='Ms. Christine Powers' selected> Ms. Christine Powers</option>
	<option value='CNMS Advisors' selected> CNMS Advisors</option>
    </select></label><br>

    <p><input type=submit value="Submit"/></p>
    </form>
<?php require('footer.html'); ?>