<?php 
  session_start();
  if (empty($_SESSION['email41'])) { ?>
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
<?php if (!empty($_SESSION['email41'])) {
  $table = $_SESSION['table41'];

  include ('db_connect.php');

  if (isset($_SESSION['thres122'])) {
    unset($_SESSION['thres122']);
  }

  include ('db_connect.php');
  $qu = "SELECT max(date1) as dtm from $table where date1 is not null";
  $rqy = mysqli_query($conn, $qu);
  $fet = mysqli_fetch_all($rqy, MYSQLI_ASSOC);

  if(isset($_SESSION['date122'])) {
    unset($_SESSION['date122']);
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
  <title>Attendance</title>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style type="text/css">
  body {
    background-color: #f7f7f7;
  }
  .welcome {
    margin-top: 40px;
    margin-left: 50%;
    margin-right: 50%;
    width: 50%;
    height: 50%
  }
  b {
    font-size: 20px;
  }
</style>

</head>
<body>
<div class="p-3 mb-2 bg-secondary text-white" style="text-align: center; font-size: 25px;">Hello Dr CSP Rao, Welcome!</div>
<div class="card mb-3" style="width: 80%; margin-left: 10%; margin-top: 2.5%;">
  <img src="bluebg.png" class="card-img-top" height="10" alt="">
  <div class="card-body">
    <h5 class="card-title"><a href="ddisplayAll.php">Check Attendance</a></h5>
    <p class="card-text">Click the above link to check the attendance of the entire class.</p>
    <p class="card-text"><small class="text-muted">Last updated on <?php echo $fet[0]['dtm'];?></small></p>
  </div>
</div>
<div class="card mb-3" style="width: 80%; margin-left: 10%; margin-top: 1.5%;">
  <img src="bluebg.png" class="card-img-top" height="10" alt="">
  <div class="card-body">
    <h5 class="card-title"><a href="ddanger_zone.php">Danger Zone</a></h5>
    <p class="card-text">Click the above link to check the students who are in danger zone (less than threshold attendance percentage) of a class.</p>
    <p class="card-text"><small class="text-muted"> Last updated on <?php echo $fet[0]['dtm'];?></small></p>
  </div>
</div>
<div class="card mb-3" style="width: 80%; margin-left: 10%; margin-top: 1.5%;">
  <img src="bluebg.png" class="card-img-top" height="10" alt="">
  <div class="card-body">
    <h5 class="card-title"><a href="ddate_wise.php">Advanced Search</a></h5>
    <p class="card-text">Click the above link to check the students attendance date wise</p>
    <p class="card-text"><small class="text-muted"> Last updated on <?php echo $fet[0]['dtm'];?></small></p>
  </div>
</div>
  <center>
  <form method="post">
    <button name='logout' type="submit" style="color: white; margin-top: 15px; padding-top: 5px; padding-bottom: 5px; background-color: #ed7878" >&#8678 Logout</button>
  </form>
  <button name='logout' type="submit" style="color: white; margin-top: 15px; padding-top: 5px; padding-bottom: 5px; background-color: #343a40; text-decoration: none;" ><a style="color: white; text-decoration: none;" href="dir_after_reg.php">&#8678 Check attendance of another class</a></button>
  <br><br><br>
</center>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>