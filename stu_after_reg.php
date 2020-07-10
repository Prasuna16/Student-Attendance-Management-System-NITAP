<?php 
  session_start();
  if (!isset($_SESSION['regNo1'])) { ?>
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
<?php //if (!empty($_SESSION['regNo'])) {
   // if (isset($_SESSION['LAST_ACTIVIT']) && (time() - $_SESSION['LAST_ACTIVIT'])>5) {
     // session_unset();
     // session_destroy();
    //}
    //$_SESSION['LAST_ACTIVIT'] = time();
    //if (empty($_SESSION['regNo'])) {?>
    <!-- <!DOCTYPE html>
    <html>
    <head>
      <title>ACCESS TIMED OUT!</title>
    </head>
    <body>
      <div style="text-align: center;">
        <img src="warning_copy.jpg" alt="Warning!" height="100" width="100">
        <center>
          <div style="color: red; font-size: 20px;">REQUEST TIMED OUT!</div>
        </center>
      </div>
    </body>
    </html> -->
  <?php //} ?>
    <?php if (!empty($_SESSION['regNo1'])) {
    $regNo = $_SESSION['regNo1'];

  include ('db_connect.php');

  $query = "SELECT RollNo, Name, Department FROM student WHERE RegNo='$regNo'";

  $res = mysqli_query($conn, $query);

  $year1 = 0;
  $sem1 = 0;

  $fetch = mysqli_fetch_all($res, MYSQLI_ASSOC);
  $dept = $fetch[0]['Department'];
  $name = $fetch[0]['Name'];
  $rollNo = $fetch[0]['RollNo'];
  $table = '';
  $yr = ''; $year1='';
  $sm = ''; $sem1='';
  $errors = array('year'=>'', 'sem'=>'', 'sub'=>'');
  function isValid() {
    global $table, $errors;
    global $dept, $yr, $sm, $year1, $sem1;
    include ('db_connect.php');
    $flag = 0;
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
        return 'Yes';
      }else {
        return 'No';
      }
  }

  if (isset($_POST['go'])) {
    if (isValid() == 'Yes') {
      global $dept, $name, $rollNo, $year1, $sem1;
      $_SESSION['year2'] = $year1;
      $_SESSION['sem2'] = $sem1;
      $_SESSION['dept2'] = $dept;
      $_SESSION['name2'] = $name;
      $_SESSION['rollNo2'] = $rollNo;
      header('Location: display.php');
    }
  }

  if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
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
	<div class="p-3 mb-2 bg-secondary text-white wel1" style="text-align: center;">Hello <?php echo $name; ?>, Welcome!</div>
	<center>
	<div class="alert alert-info start" role="alert">
	  Choose your year and semester!
	</div>
</center>

	<center class="register" >
<form method="post">
  <div class="form-group wel">
    <label for="year1" align="left">Year of Study <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['year'] ?></strong><br>
      <select name = "year" id="year1" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Select Year of study--      </option>
        <option value="two">II year</option>
        <option value="three">III year</option>
        <option value="four">IV year</option>
      </select></label>
  </div>
  <div class="form-group wel">
    <label for="sem" align="left">Choose your semester <strong style="color: #ff5555; margin-left: 20px;"><?php echo $errors['sem'] ?></strong><br>
      <select name = "sem" id="year2" class="form-control dropdown">
        <option value="none" selected disabled hidden>--Choose your Semester--</option>
        <option value="onesem">I sem</option>
        <option value="twosem">II sem</option>
      </select></label>
  </div>
  <!-- <div class="form-group wel">
    <label for="pass" align="left">Subject Code <strong style="color: #ff5555; font-size: 16px; margin-left: 20px;"><?php echo $errors['sub'] ?></strong>
    <input type="text" class="form-control" name="sub_code" id="pass" Placeholder="Enter the Subject Code"size="35">
    </label>    
  </div> -->
  <center>
<button name="go" type="submit" style="color: white; margin-top: 25px; padding-top: 5px; padding-bottom: 5px; background-color: #559955" >Get the info!</button>
</center>

<center>
<button name="logout" type="submit" style="color: white; margin-top: 45px; padding-top: 5px; padding-bottom: 5px; background-color: #343a40; width: 100px;" >Logout</button>
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