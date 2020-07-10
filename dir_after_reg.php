<?php 
	session_start();
	if (!isset($_SESSION['email41'])) { ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>ACCESS DENIED!</title>
    </head>
    <body>
      <div style="text-align: center; margin-top: 50px;">
        <img src="warning_copy.jpg" alt="Warning!" height="100" width="100">
        <center>
          <div style="color: red; font-size: 20px;">ACCESS DENIED!</div>
        </center>
      </div>
    </body>
    </html>
  <?php } ?>
<?php if (isset($_SESSION['email41'])) {
	$email = $_SESSION['email41'];
  include ('db_connect.php');

  $name = 'CSP Rao';
	$errors = array('year'=>'', 'sem'=>'', 'sub'=>'', 'dept'=>'');
	function isValid() {
		global $table, $errors;
		global $sub;
		global $dept, $yr, $sm;
		include ('db_connect.php');
		$flag = 0;
		if(empty($_POST['dept'])) {
			if ($_POST['year'] == 'one') {
				$dept = '';
			}else {
				$flag = 1;
			$error['dept'] = 'Choose Department!';
			}
		}else {
			$dept = $_POST['dept'];
		}
		if (empty($_POST['year'])) {
			$flag = 1;
			$errors['year'] = 'Choose Year!';
		}else {
			$year = $_POST['year'];
		}
		if (empty($_POST['sem'])) {
			$flag = 1;
			$errors['sem'] = 'Choose Semester!';
		}else {
			$sem = $_POST['sem'];
		}
		if ($flag == 0) {
			$year1 = 0;

		    if ($year == 'one') {$year1 = 1;
		    	$yr = "I Year"; }
		    elseif ($year == 'two') {
		      $year1 = 2;
		      $yr = "II Year"; 
            }elseif ($year == 'three') {
		        $year1 = 3;
		        $yr = "III Year"; 
		      }elseif ($year == 'four') {
		        $year1 = 4;
		        $yr = "IV Year"; 
		      }

		      $sem1 = 0;

		      if ($sem == 'onesem') {
		        $sem1 = 1;
		        $sm = "I Semester";
		      }else {
		        $sem1 = 2;
		        $sm = "II Semester";
		      }
		      if ($year1 == 1) {
		      	if ($sem1 == 1) {
		      		$table = 'physics';
		      	}else {
		      		$table = 'chemistry';
		      	}
		      }else {
		      	$table = $dept . $year1 . $sem1;
		      }
		      $sub = $_POST['sub_code'] . '_T';
			$query = "SELECT * FROM $table where $sub = 0";
			if (mysqli_query($conn, $query)) {
				return 'Yes';
			}else {
				$errors['sub'] = "Enter a valid subject code!";
				return 'No';
			}
		}
		return 'No';
	}

	if (isset($_POST['check'])) {
		if (isValid() == 'Yes') {
			global $table;
			global $dept, $yr, $sm;
			$_SESSION['table41'] = $table;
			$_SESSION['sub41'] = $_POST['sub_code'];
			$_SESSION['dept41'] = $_POST['dept'];
			$_SESSION['yr41'] = $yr;
			$_SESSION['sm41'] = $sm;
			$_SESSION['email41'] = $email;
			header('Location: dir_ask.php');
		}
	}

	if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: dir_login.php');
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Fill Details</title>
	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   <style type="text/css">
   	.start {
   		margin-top: 3%;
   		width: 30%;
   		text-align: center;
   	}
	form
{
padding-top: 30px;
}
body
{
background-color: #ffffff;
  font-family: Helvetica;
  color:black;
}
form label,button
{
  font-family: Helvetica;
}
  form label b
  {
    color: #4690C6;
  }
  .wel {
  	color: #4690C6;
		font-size: 20px;
	}
	.wel1 {
		font-size: 25px;
	}
  .form-control
{
  height: 30px;
  background-color: #f7f7f7 ;
}
.reg
{
  padding-top: 10px;
}
button
{
  width: 150px;
}
.btn
{
  font-size: 22px;
}
.dropdown {
  height: 30px;
  width: 340px;
}
.register {
  margin-bottom: 
}
.container-fluid {
  padding-top: 2px;
  background-color: #343a40;
}
   </style>

</head>
<body>
	<div class="p-3 mb-2 bg-secondary text-white wel1" style="text-align: center;">Hello <?php echo $name ?>, Welcome!</div>
	<center>
	<div class="alert alert-info start" role="alert">
	  Choose year and semester of the class, and then enter the subject code!
	</div>
</center>

	<center class="register" >
<form method="post">
	<div class="form-group wel">
    <label for="year1" align="left">Department <strong style="color: #ff5555; font-size: 18px; margin-left: 20px;"><?php echo $errors['dept']; ?></strong><br>
      <select name = "dept" id="year1" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Department--      </option>
        <option value="bio">BioTechnology</option>
        <option value="chem">Chemical Engineering</option>
        <option value="civil">Civil Engineering</option>
        <option value="cse">Computer Science and Engineering</option>
        <option value="eee">Electrical Engineering</option>
        <option value="ece">Electronics and Communication Engineering</option>
        <option value="mech">Mechanical Engineering</option>
        <option value="mme">Mettalurgical and Materials Engineering</option>
      </select></label>
  </div>
  <div class="form-group wel">
    <label for="year1" align="left">Year of Study <strong style="color: #ff5555; font-size: 18px; margin-left: 20px;"><?php echo $errors['year']; ?></strong><br>
      <select name = "year" id="year1" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Year of study--      </option>
        <option value="one">I year</option>
        <option value="two">II year</option>
        <option value="three">III year</option>
        <option value="four">IV year</option>
      </select></label>
  </div>
  <div class="form-group wel">
    <label for="sem" align="left">Semester <strong style="color: #ff5555; font-size: 18px; margin-left: 20px;"><?php echo $errors['sem']; ?></strong><br>
      <select name = "sem" id="year2" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Choose Semester--</option>
        <option value="onesem">I sem</option>
        <option value="twosem">II sem</option>
      </select></label>
  </div>
  <div class="form-group wel">
    <label for="pass" align="left">Subject Code <strong style="color: #ff5555; font-size: 16px; margin-left: 20px;"><?php echo $errors['sub'] ?></strong>
    <input type="text" class="form-control" name="sub_code" id="pass" Placeholder="Enter the Subject Code"size="35">
    </label>    
  </div>
  <center>
  	<button name="logout" type="submit" style="color: white; margin-top: 25px; padding-top: 5px; padding-bottom: 5px; background-color: #ed7878; width: auto;" >&#8678 Logout!</button>
<button name="check" type="submit" style="color: white; margin-left: 20px; margin-top: 25px; padding-top: 5px; padding-bottom: 5px; background-color: #559955; width: auto;" >Proceed! &#8680</button>
</center>

</form>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>