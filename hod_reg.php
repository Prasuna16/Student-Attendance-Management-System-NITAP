<?php 
  session_start();
  if (!isset($_SESSION['amail'])) { ?>
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

<?php if (!empty($_SESSION['amail'])) {
	$errors = array('email'=>'', 'mobile'=>'', 'password'=>'', 'dept'=>'');

	function isValid() {
		global $errors;
		$email = $_POST['email'];
		$mobile = $_POST['mobileNo'];
		$flag = 0;
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Invalid email!';
			$flag = 1;
		}
		if(!preg_match('/^\d{10}$/', $mobile)) {
			$errors['mobile'] = 'Invalid mobile No!';
			$flag = 1;
		}
		if (strlen($_POST['pword']) < 8) {
			$errors['password'] = 'Should contain atleast 8 chars!';
		}
		if($_POST['pword'] != $_POST['pword1']) {
			$errors['password'] = 'Enter same password again!';
			$flag = 1;
		}
		if (empty($_POST['dept'])) {
			echo 'Entered';
			$errors['dept'] = 'Choose your Department!';
			$flag = 1;
		}
		if ($flag == 1) {
			return 'No';
		}else {
			return 'Yes';
		}
	}

	include ('db_connect.php');
	if (isset($_POST['submit'])) {
		if (isValid() == 'Yes') {
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$password = mysqli_real_escape_string($conn, $_POST['pword']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$mobile = mysqli_real_escape_string($conn, $_POST['mobileNo']);
			$dept = mysqli_real_escape_string($conn, $_POST['dept']);

			$query = "INSERT INTO faculty(Name, email, MobileNo, Password, Department, HOD) VALUES ('$name', '$email', '$mobile', '$password', '$dept', 'YES')";

			if (mysqli_query($conn, $query)) {
				header('Location: admin_home.php');
			}else {
				echo 'error: ' . mysqli_error($conn);
			}
		}
	}
?>




<!DOCTYPE html>
<html>
<head>
<title>HOD Register Portal</title>
<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   
<style type="text/css">
form
{
padding-top: 50px;
}
body
{
	color: black;
background-color: #ffffff;
  font-family: Helvetica;
  color:white;
}
form label,button
{
  font-family: Helvetica;
}
  form label b
  {
    color: #4690C6;
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
.welcome {
  float: right;
  position: relative;
  padding-right: 540px;
  font-family: Helvetica;
  font-size: 25px;
}
.form-group {

}

</style>
</head>




<body>
    <div class="container-fluid">
      <a class="navbar-brand" href="admin_home.php">
    <img src="arrowleft.png" style="float: left; margin-left: 20px; " width="30" height="25" alt="back">
     </a>
    </div>
<center class="register" >
<form method="post" action="">
  <div class="form-group">
    <label for="name" align="left"><b>User Name</b>
    <input type="text" class="form-control" id="name" name="name" size="35" placeholder="Enter Username" required>
  </label>
  </div>
  <div class="form-group">
    <label for="umail" align="left"><b>Email</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['email'] ?></strong>
    <input type="email" class="form-control" id="umail" name="email"placeholder="Enter Email" aria-describedby="emailHelp" size="35" required>
    </label>
</div>
  <div class="form-group">
    <label for="dept" align="left"><b>Department</b><strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['dept'] ?></strong><br>
      <select name="dept" required id="dept" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Choose Department--</option>
        <option value="bio">Bio Technology</option>
        <option value="chem">Chemical Engineering</option>
        <option value="civil">Civil Engineering</option>
        <option value="cse">Computer Science and Engineering</option>
        <option value="eee">Electrical and Electronic Engineering</option>
        <option value="ece">Electronics and Communication Engineering</option>
        <option value="mech">Mechanical Engineering</option>
        <option value="mme">Metallurgical and Materials Engineering</option>
      </select></label>
  </div>
  <div class="form-group">
    <label for="no" align="left"><b>Mobile Number</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['mobile'] ?></strong>
    <input type="text" class="form-control" name="mobileNo" id="no" Placeholder="Enter Mobile No"size="35" required>
    </label>
  </div>
  <div class="form-group">
    <label for="pass" align="left"><b>Password</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['password'] ?></strong>
    <input type="password" class="form-control" name="pword" id="pass" Placeholder="Enter Password"size="35" required>
    </label>
  </div>
    <div class="form-group">
    <label for="pass1" align="left"><b>Confirm Password</b>
    <input type="password" class="form-control" id="pass1" name="pword1"placeholder="Enter Password again" size="35" required>
    </label>
  </div>
  <center>
<button value="submit" name="submit" type="submit">Register</button>
</center>

</form>
</center>
</body>
</html>
<?php } ?>