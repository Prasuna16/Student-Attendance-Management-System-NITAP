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
  $errors = array('email'=>'', 'mobile'=>'', 'password'=>'', 'dept'=>'', 'year'=>'', 'reg'=>'', 'roll'=>'', 'semester'=>'', 'sec'=>'');

  function isValid() {
    global $errors;
    $email = $_POST['email'];
    $mobile = $_POST['mobileNo'];
    $flag = 0;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Invalid email!';
      $flag = 1;
      echo "Entered";
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
      $errors['dept'] = 'Choose your Department!';
      $flag = 1;
    }
    if (empty($_POST['sem'])) {
      $errors['semester'] = 'Choose your semester!';
      $flag = 1;
    }
    if (empty($_POST['year'])) {
      $errors['year'] = 'Choose Year of study!';
      $flag = 1;
    }elseif ($_POST['year'] != 'one' && (!preg_match('/^\d{6}$/', $_POST['rollno']))) {
      $errors['roll'] = 'Enter a valid rollNo!';
      $flag = 1;
    }
    if (!preg_match('/^\d{6}$/', $_POST['regno'])) {
      $errors['reg'] = 'Enter a valid regNo!';
      $flag = 1;
    }
    if (empty($_POST['section'])) {
      $errors['sec'] = 'Select your section!';
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
      $sec = mysqli_real_escape_string($conn, $_POST['section']);
      $password = mysqli_real_escape_string($conn, $_POST['pword']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $mobile = mysqli_real_escape_string($conn, $_POST['mobileNo']);
      $dept = mysqli_real_escape_string($conn, $_POST['dept']);
      $rollno = mysqli_real_escape_string($conn, $_POST['rollno']);
      $regno = mysqli_real_escape_string($conn, $_POST['regno']);
      $year = mysqli_real_escape_string($conn, $_POST['year']);
      $sem = mysqli_real_escape_string($conn, $_POST['sem']);

      $year1 = 0;

      if ($year == 'one') {$year1 = 1;}
      elseif ($year == 'two') {
        $year1 = 2;
      }elseif ($year == 'three') {
        $year1 = 3;
      }elseif ($year == 'four') {
        $year1 = 4;
      }

      $sem1 = 0;

      if ($sem == 'onesem') {
        $sem1 = 1;
      }else {
        $sem1 = 2;
      }
      if ($year1 != 1) {
  }else {
    if ($sem1 == 1) {
      $query = "INSERT INTO physics(RegNo) VALUES ('$regno')";
      $r1 = mysqli_query($conn, $query);
    }else {
      $query = "INSERT INTO chemistry(RegNo) VALUES ('$regno')";
      $r1 = mysqli_query($conn, $query);
    }
  }
    $table = $dept . $year1 . $sem1;
    $query2 = "INSERT INTO $table(RollNo) VALUES ('$rollno')";
    $r = mysqli_query($conn, $query2);

    if ($year1 == 1) {
      $query = "INSERT INTO student(Name, email, MobileNo, Password, Department, Year, RegNo, Section, Semester) VALUES ('$name', '$email', '$mobile', '$password', '$dept', '$year', $regno, '$sec', '$sem')";
    }else {
      $query = "INSERT INTO student(Name, email, MobileNo, Password, Department, Year, RollNo, RegNo, Section, Semester) VALUES ('$name', '$email', '$mobile', '$password', '$dept', '$year', $rollno, $regno, '$sec', '$sem')";

    }

      if (mysqli_query($conn, $query)) {
          $_SESSION['regNo1'] = $regno;
          if ($year == 'one') {
            header('Location: displayOne.php');
          }else {
          header('Location: displayCurrent.php');
        }
      }else {
          echo 'error: ' . mysqli_error($conn);
      }
    }
  } 
 ?>

 
<!DOCTYPE html>
<html>
<head>
<title>Student Register Portal</title>
<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   
<style type="text/css">
form
{
padding-top: 30px;
}
body
{
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
    <img src="arrowleft.png" style="float: left; margin-left: 20px; " width="40" height="30" alt="Back">
     </a>
      <div class="welcome">Student Register Portal</div>
    </div>
<center class="register" >
<form method="post">
  <div class="form-group">
    <label for="name" align="left"><b>User Name</b>
    <input type="text" class="form-control" id="name" name="name" size="35" placeholder="Enter Your Username" required>
  </label>
  </div>
  <div class="form-group">
    <label for="rollno" align="left"><b>RollNo</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['roll'] ?></strong>
    <input type="text" class="form-control" id="no" name="rollno" size="35" placeholder="Enter Your RollNo">
  </label>
  </div>
  <div class="form-group">
    <label for="regno" align="left"><b>RegNo</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['reg'] ?></strong>
    <input type="text" class="form-control" id="no1" name="regno" size="35" placeholder="Enter Your RegNo" required>
  </label>
  </div>
  <div class="form-group">
    <label for="umail" align="left"><b>Email</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['email'] ?></strong>
    <input type="email" class="form-control" id="umail" name="email"placeholder="Enter your Email" aria-describedby="emailHelp" size="35" required>
    </label>
  </div>
  <div class="form-group">
    <label for="year1" align="left"><b>Year of Study</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['year'] ?></strong><br>
      <select name = "year" id="year1" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Select Year of study--      </option>
        <option value="one">I year</option>
        <option value="two">II year</option>
        <option value="three">III year</option>
        <option value="four">IV year</option>
      </select></label>
  </div>
  <div class="form-group">
    <label for="sem" align="left"><b>Choose your semester</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['semester'] ?></strong><br>
      <select name = "sem" id="year2" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Choose your Semester--</option>
        <option value="onesem">I sem</option>
        <option value="twosem">II sem</option>
      </select></label>
  </div>
  <div class="form-group">
    <label for="dept" align="left"><b>Department</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['dept'] ?></strong><br>
      <select name="dept" id="dept" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Select your Department--</option>
        <option value="bio">Bio Technology</option>
        <option value="chem">Chemical Engineering</option>
        <option value="civil">Civil Engineering</option>
        <option value="cse">Computer Science and Engineering</option>
        <option value="eee">Electrical and Electronic Engineering</option>
        <option value="ece">Electronics and Communication Engineering</option>
        <option value="mech">Mechanical Engineering</option>
        <option value="mme">Metallurgy and Materials Engineering</option>
      </select></label>
  </div>
  <div class="form-group">
    <label for="sec" align="left"><b>Section</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['sec'] ?></strong><br>
      <select name="section" id="dept" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Select your Section--</option>
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
  <div class="form-group">
    <label for="no" align="left"><b>Mobile Number</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['mobile'] ?></strong>
    <input type="text" class="form-control" name="mobileNo" id="no2" Placeholder="Enter your Mobile No"size="35" required>
    </label>
  </div>
  <div class="form-group">
    <label for="pass" align="left"><b>Password</b> <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['password'] ?></strong>
    <input type="password" class="form-control" name="pword" id="pass" Placeholder="Enter your Password"size="35" required>
    </label>
  </div>
    <div class="form-group">
    <label for="pass1" align="left"><b>Confirm Password</b>
    <input type="password" class="form-control" id="pass1" name="pword1"placeholder="Enter Password again"size="35" required>
    </label>
  </div>
  <center>
<button name="submit" type="submit" style="color: white; background-color: #343a40" >Register</button><br><br>
</center>

</form>

</center>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>