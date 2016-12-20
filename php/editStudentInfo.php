<?php
session_start();
include('mysql_connect.php');


<<<<<<< HEAD
$email = $_SESSION['email'];

$sql = "select * from `students` WHERE Email='$email'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

if(mysql_num_rows($rs) == 1) {
		$res_obj =$rs->fetch_object();
		$_SESSION["firstName"] = $res_obj->firstName;
		$_SESSION["lastName"] = $res_obj->lastName;
		$_SESSION["major"] = $res_obj->Major;
		$_SESSION["studEmail"]=$res_obj->Email;
		$_SESSION["SIDNumber"]=$res_obj->studentID;
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
	<!--Displays previously parsed information -->
	<!--Will Pass to procesStudentEdit.php to apply any and all changes -->
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
=======
$email = $_SESSION['studentEmail'];

$sql = "select * from `students` WHERE Email='$email'";
$rs = mysql_query($sql, $conn);

//Fetch student info for session use

if (mysql_num_rows($rs) == 1) {
    $res_obj = mysql_fetch_array($rs);
    $firstName = $res_obj["firstName"];
    $lastName = $res_obj["lastName"];
    $prefName = $res_obj["prefName"];
    $major = $res_obj["Major"];
    $studEmail = $res_obj["Email"];
    $SIDNumber = $res_obj["studentID"];
}

?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Edit Account Information</title>
    <link rel='stylesheet' type='text/css' href='../html/standard.css'/>
    <link rel='icon' type='image/png' href='../html/standard.css'/>
    <style>
        table, th, td {
            border: 1px solid black;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        form {
            position: relative;
            top: 8px;
        }
    </style>
</head>
<div style="overflow:hidden">
    <img src="../html/dogw_logo.jpg" style="overflow:hidden;"/>
</div>
<body id="background">
<left>
    <div id="wrapper">
        <!--Displays previously parsed information -->
        <!--Will Pass to procesStudentEdit.php to apply any and all changes -->
        <h2>Edit Student Information<span class="login-create"></span></h2>
        <form action="processStudentEdit.php" method="post" name="Edit"
              style="font-family: monospace; font-size: 15px; padding: 1%; color: #FF0000; text-align: left;">
            <?php
            echo '<h4>Preferred Name: <input type="text" name="prefName" value="'.$prefName.'"/></h4>';
            echo '<h4>Major: <br><select name="major">';

            $majors = array(
                "Biological Sciences BA",
                "Biological Sciences BS",
                "Biological Sciences BS",
                "Biochemistry & Molecular Biology BS",
                "Bioinformatics & Computational Biology BS",
                "Biology Education BA",
                "Chemistry BA",
                "Chemistry BS",
                "Chemistry Education BA"
            );
            foreach ($majors as $currentMajor) {
                echo "<option value='" . $currentMajor . "'";
                if ($major == $currentMajor) {
                    echo " selected";
                }
                echo ">" . $currentMajor . "</option>";
            }
            ?>
            <!-- This creates a drop down box of the possible major choices -->
            </select></h4>
            <pre><h4>Select the major that you intend to pursue
NEXT SEMESTER (this may be different from your
current officially declared major).
The major selected can be either your
primary or secondary major. If you are only
planning to pursue ONE major, and your
major of choice is not listed, please choose Other</h4></pre>

            <p><input type=submit value="Submit"/></p>

>>>>>>> master

        </form>
    </div>
</left>
</body>

<<<<<<< HEAD
				  </select>
			</div>
			<!--Go ahead and apply button-->
			<div class="nextButton">
				<input type="submit" name="save" class="button large go" value="Save">
			</div>
  </div>
  </left>
  </div>
			</div>
		</form>
  </body>
  
=======
>>>>>>> master
</html>
