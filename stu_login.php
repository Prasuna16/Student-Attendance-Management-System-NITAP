<?php  
  
  session_start();
  $errors = array('email'=>'', 'password'=>'');
  $pass = '';

  function isValid() {
    include ('db_connect.php');
    global $errors, $pass;
    if (!empty($_POST['reg']) && !empty($_POST['pword'])){
    $regno = $_POST['reg'];
    $password = $_POST['pword'];

    $query = "SELECT Password, Name, Year from student where RegNo='$regno'";

    $res = mysqli_query($conn, $query);

    $pass = mysqli_fetch_all($res, MYSQLI_ASSOC);

    mysqli_free_result($res);

    if (empty($pass)) {
      $errors['email'] = "Account doesn't exist with this RegNo!";
      return 'No';
    }elseif ($pass[0]['Password'] != $password) {
      $errors['password'] = 'Invalid Credentials!';
      return 'No';
    }else {
      return 'Yes';
    }
  }else {
    return 'No';
    $errors = "Fill Details!";
  }
}

  if (isset($_POST['submit'])) {
    global $pass;
    if (isValid() == 'Yes') {
      $_SESSION['regNo1'] = $_POST['reg'];
      if ($pass[0]['Year'] == 'one') {
        header('Location: displayOne.php');
      }else {
      header("Location: displayCurrent.php");
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
  width: 345px;
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
      <a class="navbar-brand" href="index.php">
    <img src="arrowleft.png" style="float: left; margin-left: 20px; " width="40" height="30" alt="Back">
     </a>
      <div class="welcome">Student Login Portal</div>
    </div>
    <!-- <?php //if (!empty($name)) {  -->?>
<center><div class="form-group alert alert-success" style=" text-align: center; font-size: px; width: 300px; height: 50px; margin-top: 30px;">
    <a style="padding-top: 40px;" href="stu_after_reg.php">Continue as <?php //echo $name; ?></a>
  </div></center> 
<?php //} ?> -->
<center class="register" >
<form method="post">
  <div style="color: #ff5555";>
    <?php echo $errors['email']; ?>
    <?php echo $errors['password']; ?>
  </div>
  <br>
  <div class="form-group">
    <label for="roll" align="left"><b>RegNo</b>
    <input type="text" class="form-control" id="roll" name="reg" placeholder="Enter your RegNo" size="35" required>
    </label>
  </div>
  <div class="form-group">
    <label for="pass" align="left"><b>Password</b>
    <input type="password" class="form-control" name="pword" id="pass" Placeholder="Enter your Password"size="35" required>
    </label>
  <center>
<button name="submit" type="submit" style="color: white; margin-top: 25px; padding-top: 5px; padding-bottom: 5px; background-color: #343a40" >Login</button>
</center>

</form>
<a href="forgot_pass.php" style="font-family: Comic Sans MS; color: #343a40; font-size: 15px;">Forgot Password?</a>
<p style="font-family: Comic Sans MS; color: #343a40; padding-top: 20px; font-size: 21px;">Don't have account?<a href="stu_reg.php"> Register</a></p>
</center>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>