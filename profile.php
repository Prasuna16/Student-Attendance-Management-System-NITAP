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
  <?php 
  	include 'db_connect.php';
  	$reg = $_SESSION['regNo1'];
  	$q = "SELECT * FROM student WHERE RegNo = '$reg'";
  	$r = mysqli_query($conn, $q);
  	$fetch = mysqli_fetch_all($r, MYSQLI_ASSOC);
  	//print_r($fetch);
  	$d = '';
  	$dept = $fetch[0]['Department'];
	if ($dept == 'bio') {$d = "BIOTECHNOLOGY"; }
	elseif ($dept == 'chem') {$d = "CHEMICAL ENGINEERING"; }
	elseif ($dept == 'civil') {$d = "CIVIL ENGINEERING"; }
	elseif ($dept == 'cse') {$d = "COMPUTER SCIENCE AND ENGINEERING"; }
	elseif ($dept == 'eee') {$d = "ELECTRICAL ENGINEERING"; }
	elseif ($dept == 'ece') {$d = "ELECTRONICS AND COMMUNICATION ENGINEERING"; }
	elseif ($dept == 'mech') {$d = "MECHANICAL ENGINEERING"; }
	else {$d = "METTALURGICAL AND MATERIALS ENGINEERING"; }
?>
<!DOCTYPE html>
<html>
<head>
   <style type="text/css">
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
  </style>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Profile</title>
</head>
<body>
  <?php if($fetch[0]['Year'] == 'one') {?>
    <div class="container-fluid">
      <a class="navbar-brand" href="displayOne.php">
    <img src="arrowleft.png" style="float: left; margin-left: 20px; " width="40" height="20" alt="Back">
     </a>
    </div>
  <?php }else {?>
    <div class="container-fluid">
      <a class="navbar-brand" href="displayCurrent.php">
    <img src="arrowleft.png" style="float: left; margin-left: 20px; " width="40" height="20" alt="Back">
     </a>
    </div>
  <?php } ?>
	<center><h5 style="margin-top: 2%;"><?php echo $fetch[0]['Name'] ?></h5></center>
<center>
<table class="table table-bordered" style="width: 50%; margin-top: 3%;">
  <thead>
    <tr class="table-primary">
      <th style="text-align: center;" scope="col" colspan="2">Details</th>
      <!-- <th scope="col">Details</th> -->
    </tr>
  </thead>
  <tbody>
  	<?php { ?>
  		<tr style="background-color: #eaf6fb";>
		<td><b>RegNo</b></td>
		<td><?php echo $fetch[0]['RegNo'] ?></td>
	</tr>
	<?php } ?>
	<?php if ($fetch[0]['Year'] != 'one'){ ?>
  		<tr style="background-color: #eaf6fb";>
		<td><b>RollNo</b></td>
		<td><?php echo $fetch[0]['RollNo'] ?></td>
	</tr>
	<?php } ?>
	<?php { ?>
  		<tr style="background-color: #eaf6fb";>
		<td><b>Email</b></td>
		<td><?php echo $fetch[0]['email'] ?></td>
	</tr>
	<?php } ?>
	<?php { ?>
  		<tr style="background-color: #eaf6fb";>
		<td><b>Department</b></td>
		<td><?php echo $d ?></td>
	</tr>
	<?php } ?>
	<?php { ?>
  		<tr style="background-color: #eaf6fb";>
		<td><b>Mobile Number</b></td>
		<td><?php echo $fetch[0]['MobileNo'] ?></td>
	</tr>
	<?php } ?>
  </tbody>
</table>
</center>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>