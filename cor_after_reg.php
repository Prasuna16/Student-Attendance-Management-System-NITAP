<?php 
	session_start();
	if (!isset($_SESSION['email51'])) { ?>
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
<?php if (!empty($_SESSION['email51'])) {
	$email = $_SESSION['email51'];

  include ('db_connect.php');

	$errors = array('year'=>'', 'sem'=>'', 'sub'=>'');
	function isValid() {
		global $table, $errors;
		global $sub;
		global $dept, $section;
		include ('db_connect.php');
		$flag = 0;
		if (empty($_POST['section'])) {
			$flag = 1;
			$errors['sem'] = 'Choose Section!';
		}else {
			$section = $_POST['section'];
		}
		if ($flag == 0) {
			$year1 = 1;
		    $yr = "I Year";

		    $sem1 = 0;

		    switch ($section) {
		    	case 'A':
		    		$table = 'physics';
		    		break;
		    	case 'B':
		    		$table = 'physics';
		    		break;
		    	case 'C':
		    		$table = 'physics';
		    		break;
		    	case 'D':
		    		$table = 'physics';
		    		break;
		    	case 'E':
		    		$table = 'chemistry';
		    		break;
		    	case 'F':
		    		$table = 'chemistry';
		    		break;
		    	case 'G':
		    		$table = 'chemistry';
		    		break;
		    	case 'H':
		    		$table = 'chemistry';
		    		break;
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
			$_SESSION['table51'] = $table;
			$_SESSION['section51'] = $section;
			$_SESSION['sub51'] = $_POST['sub_code'];
			$_SESSION['email51'] = $email;
			header('Location: cor_show.php');
		}
	}

	if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: coordinator_login.php');
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
	<div class="p-3 mb-2 bg-secondary text-white wel1" style="text-align: center;">Hello Coordinator, Welcome!</div>
	<center>
	<div class="alert alert-info start" role="alert">
	  Choose year and semester of the class, and then enter the subject code!
	</div>
</center>

	<center class="register" >
<form method="post">
  <div class="form-group wel">
    <label for="year1" align="left">Section<strong style="color: #ff5555; font-size: 18px; margin-left: 20px;"><?php echo $errors['year']; ?></strong><br>
      <select name = "section" id="year1" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Choose Section--      </option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
        <option value="H">H</option>
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