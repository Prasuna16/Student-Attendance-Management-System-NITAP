<?php 
	session_start();
	$dr1 = '';
	include ('db_connect.php');
	$sub = $_SESSION['sub51'];
	$pre = $sub.'_P';
	$tot = $sub.'_T';
	$yr = 'I Year';
	$table = $_SESSION['table51'];

  if ($table == 'physics') {
    $d = 'PHYSICS CYCLE';
  }elseif ($table == 'chemistry') {
    $d = 'CHEMISTRY CYCLE';
  }
	if(!isset($_SESSION['table51'])){ ?>
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
<?php if (!empty($_SESSION['table51'])) { ?>
	<?php if(!isset($_SESSION['date142'])) {?>
		<?php 
			if(isset($_POST['appl'])) {
				if ($table == 'physics' || $table == 'chemistry') {
					$req = 'RegNo';
				}else {
					$req = 'RollNo';
				}
				$dr1 = date($_POST['date1234']);
				$absent = "SELECT $req FROM $table WHERE date1 = '$dr1' and $pre = 0";
				//echo $absent;
				$rabs = mysqli_query($conn, $absent);
				$fabs = mysqli_fetch_all($rabs, MYSQLI_ASSOC);
				$present = "SELECT $req FROM $table WHERE date1 = '$dr1' and $pre = 1";
				//echo $present;
				$rpre = mysqli_query($conn, $present);
				$fpre = mysqli_fetch_all($rpre, MYSQLI_ASSOC);
			}
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
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
			<title></title>
		</head>
		<body>
			<div class="container-fluid">
      <a class="navbar-brand" href="cor_show.php">
    <img src="arrowleft.png" style="float: left; margin-left: 20px; " width="40" height="20" alt="Back">
     </a>
    </div>
			<?php if ($table == 'physics')  {?>
      <center><h5 style="margin-top: 1%;">PHYSICS CYCLE</h5></center>
    <?php } ?>
    <?php if ($table == 'chemistry')  {?>
      <center><h5 style="margin-top: 1%;">CHEMISTRY CYCLE</h5></center>
    <?php } ?>
    <?php if ($yr != 'I Year')  {?>
      <center><h5 style="margin-top: 1%;"><?php echo $d?></h5></center>
    <?php } ?>
	<center><h6><?php echo $yr . "-" . "  (". strtoupper($sub).")"; ?></h6></center>
	<center><br>
			<form method="post">
			<center>
				<div  style="font-family: Verdana;">
					<label>Please select a date:</label>
					<input type="date" name="date1234">
					<button type="submit" name="appl">Show!</button>
				</div>
			</center></form>
			<br>
			<?php if ($dr1 != '') {?>
			<?php if(count($fabs) == 0 && count($fpre) == 0) {?>
				<b>Attendance is not taken on <?php echo $dr1; ?></b>
			<?php }else {?>
			<b>Date: <?php echo $dr1; ?></b><br>
				<table class="table table-bordered" style=" float: left; margin-left: 25%; width: 20%; margin-top: 3%;">
				  <thead>
				    <tr class="table-primary" style="background-color: #f54e5f">
				      <th scope="col" style="background-color: #f5666f">RollNos-Absent</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
					    	for ($i = 0; $i < count($fabs); $i++) {?>
				    <tr style="background-color: #f799a3";>
						<th scope="row"><?php echo $fabs[$i][$req] ?></th>
				    </tr>
				    <?php } ?>
				  </tbody>
				</table>
				<table class="table table-bordered" style="margin-right:25% ;float: right; width: 20%; margin-top: 3%;">
				  <thead>
				    <tr class="table-primary">
				      <th scope="col">RollNos-Present</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
					    	for ($i = 0; $i < count($fpre); $i++) {?>
				    <tr style="background-color: #eaf6fb";>
						<th scope="row"><?php echo $fpre[$i][$req] ?></th>
				    </tr>
				    <?php } ?>
				  </tbody>
				</table>
			<?php }} ?>
		</body>
		</html>
	<?php } ?>
<?php } ?>