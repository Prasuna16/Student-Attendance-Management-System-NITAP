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
    $amail = $_SESSION['amail'];

  include ('db_connect.php');
  $_SESSION['amail1'] = $amail;

  if (isset($_POST['logout'])) {
    session_destroy();
    session_unset();
    header('Location: admin_login.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Home Page</title>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="p-3 mb-2 bg-secondary text-white" style="text-align: center; font-size: 25px;">Hello <?php echo $amail ?>, Welcome!</div>
<div class="card mb-3" style="width: 80%; margin-left: 10%; margin-top: 3%;">
  <img src="bluebg.png" class="card-img-top" height="10" alt="">
  <div class="card-body">
    <h5 class="card-title"><a href="hod_reg.php">HOD'S (Head of the Department)</a></h5>
    <p class="card-text">Click the above link to add HOD details of any branch.</p>
    <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
  </div>
</div>
<div class="card mb-3" style="width: 80%; margin-left: 10%; margin-top: 2.5%;">
  <img src="bluebg.png" class="card-img-top" height="10" alt="">
  <div class="card-body">
    <h5 class="card-title"><a href="fac_reg.php">Faculty Details</a></h5>
    <p class="card-text">Click the above link to add Faculty details.</p>
    <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
  </div>
</div>
<div class="card mb-3" style="width: 80%; margin-left: 10%; margin-top: 2.5%;">
  <img src="bluebg.png" class="card-img-top" height="10" alt="">
  <div class="card-body">
    <h5 class="card-title"><a href="astu_reg.php">Students Details</a></h5>
    <p class="card-text">Click the above link to add students' details.</p>
    <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
  </div>
</div>
<form method="post">
<center>
  <button type="submit" name="logout" style="color: white; margin-top: 15px; padding-top: 5px; padding-bottom: 5px; background-color: #343a40">Logout</button>
</center>
</form>
</body>
</html>

<?php } ?>