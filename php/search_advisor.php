<!-- search_advisor.php --> 
<!-- This file get the advisors by name and posts to them schedule_by_advisor.php
     this will eventually put them in a dropdown box -->

<?php
include ('../html/header.html');
// connect to the database
include ('mysql_connect.php');

// make a query that will select all rows from the advisors table
$sql = "SELECT * FROM advisors";
$rs = mysql_query($sql, $conn);


?>
<h2>Choose An Advisor</h2>
<form method=post action='schedule_by_advisor.php'>
  <select name="advisor">
<?php
  // Prints out all the names of the advisors
  while ($advisor = mysql_fetch_array($rs)) {
  echo "<option value=\"" . $advisor['Username'] . "\">" . $advisor['fullName'] . " - " . $advisor['Username'] . "</option>";
}
?>  
</select>
  <input type=submit value="Submit"/>
</form>

</body>
</html>
