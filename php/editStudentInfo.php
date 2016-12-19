<?php
session_start();
include('../CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

$sql = "select * from `students`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

//Fetch student info for session use
while($row = mysql_fetch_row($rs)){
	if($row[0] == $_SESSION["email"]){
		
		$_SESSION["firstName"] = $row[4];
		$_SESSION["lastName"] = $row[5];
		$_SESSION["major"] = $row[1];
		$_SESSION["studEmail"]=$row[0];
		$_SESSION["SIDNumber"]=$row[6];
	}
}

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Student Information</title>
    	<link rel='stylesheet' type='text/css' href='../html/standard.css'/>
        <link rel="icon" type="image/png" href="../html/corner.png" />
  </head>
  <body>
  <div id="background">
  <left><div id="wrapper">
    <div id="login">
      <div id="form">
	<!--Displays previously parsed information--------------------------------->
	<!--Will Pass to procesStudentEdit.php to apply any and all changes---------->
			<div class="top">
			<h2>Edit Student Information<span class="login-create"></span></h2>
			<form action="processStudentEdit.php" method="post" name="Edit">
			<div class="field">
				<label for="firstName">First Name</label>
				<input id="firstName" size="30" maxlength="50" type="text" name="firstName" required value=<?php echo $_SESSION["firstName"]?>>
			</div>
			<div class="field">
			  <label for="lastName">Last Name</label>
			  <input id="lastName" size="30" maxlength="50" type="text" name="lastName" required value=<?php echo $_SESSION["lastName"]?>>
			</div>
			<div class="field">
				<label for="studEmail">E-mail</label>
				<input id="studEmail" size="30" maxlength="255" type="text" name="studEmail" required value=<?php echo $_SESSION["studEmail"]?>>
			</div>
			<div class="field">
				  <label for="major">Major</label>
				  <select id="major" name = "major">
					<option <?php if($_SESSION["major"] == 'Biochemistry & Molecular Biology BS'){echo("selected");}?> value='Biochemistry & Molecular Biology BS'>Biochemistry & Molecular Biology BS</option>
					<option <?php if($_SESSION["major"] == 'Bioinformatics & Computational Biology BS'){echo("selected");}?> value='Bioinformatics & Computational Biology BS'>Bioinformatics & Computational Biology BS</option>
					<option <?php if($_SESSION["major"] == 'Biological Sciences BA'){echo("selected");}?> value='Biological Sciences BA'>Biological Sciences BA</option>
					<option <?php if($_SESSION["major"] == 'Bioinformatics & Computational Biology BS'){echo("selected");}?> value='Biological Sciences BS'>Biological Sciences BS</option>
					<option <?php if($_SESSION["major"] == 'Biology Education BA'){echo("selected");}?> value='Biology Education BA'>Biology Education BA</option>

					<option <?php if($_SESSION["major"] == 'Chemistry BA'){echo("selected");}?> value='Chemistry BA'>Chemistry BA</option>
					<option <?php if($_SESSION["major"] == 'Chemistry BS'){echo("selected");}?> value='Chemistry BS'>Chemistry BS</option>
					<option <?php if($_SESSION["major"] == 'Chemistry Education BA'){echo("selected");}?> value='Chemistry Education BA'>Chemistry Education BA</option>

				  </select>
			</div>
			<!----------Go ahead and apply button----->
			<div class="nextButton">
				<input type="submit" name="save" class="button large go" value="Save">
			</div>
  </div>
  </left>
  </div>
			</div>
		</form>
  </body>
  
</html>
