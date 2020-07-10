<?php 

	session_start();
	if (!isset($_SESSION['table11'])) { ?>
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
   <?php //if (!empty($_SESSION['table'])) {
//     if (isset($_SESSION['LAST_ACTIVIT2']) && (time() - $_SESSION['LAST_ACTIVIT2'])>40) {
//       session_unset();
//       session_destroy();
//     }
//     $_SESSION['LAST_ACTIVIT2'] = time();
    //if (empty($_SESSION['table'])) {?>
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
    <?php if (!empty($_SESSION['table11'])) {
	$table = $_SESSION['table11'];
	$sub = strtoupper($_SESSION['sub11']);
	$dept = $_SESSION['dept11'];
	$yr = $_SESSION['year11'];
	$sm = $_SESSION['sem11'];
  $str_arr = $_SESSION['absen'];
	$tot = $sub.'_T';
	$pre = $sub.'_P';
  //echo $sm;
	include ('db_connect.php');
  if ($yr == 'I Year') {
    $query = "SELECT Name, $table.RegNo,$tot, $pre from student s join $table on s.RegNo = $table.RegNo where date1 is null order by $table.RegNo";
  }else {
    $query = "SELECT Name, $table.RollNo,$tot, $pre from student s join $table on s.RollNo = $table.RollNo where date1 is null order by $table.RollNo";
  }
	//echo $query;

	$res = mysqli_query($conn, $query);

	$fetch = mysqli_fetch_all($res, MYSQLI_ASSOC);

	$d = '';

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
	<title></title>
	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
  <div class="container-fluid">
      <a class="navbar-brand" href="fac_after_reg.php">
    <img src="arrowleft.png" style="float: left; margin-left: 20px; " width="40" height="20" alt="Back">
     </a>
    </div>
  <?php if ($yr == 'I Year' && $sm == 'I Semester')  {?>
      <center><h5 style="margin-top: 1%;">PHYSICS CYCLE</h5></center>
    <?php } ?>
    <?php if ($yr == 'I Year' && $sm == 'II Semester')  {?>
      <center><h5 style="margin-top: 1%;">CHEMISTRY CYCLE</h5></center>
    <?php } ?>
    <?php if ($yr != 'I Year')  {?>
      <center><h5 style="margin-top: 1%;"><?php echo $d?></h5></center>
    <?php } ?>
	<center><h6><?php echo $yr . "-" . $sm . "  ($sub)"; ?></h6></center>
  <br>
  <center> <p style="font-size: 13px; color: #ff5555">*Today's absentees are marked red</p></center>
	<center>
	<table class="table table-bordered" style="width: 80%; margin-top: 3%;">
  <thead>
    <tr class="table-primary">
      <th scope="col">RegNo</th>
      <th scope="col">Name</th>
      <th scope="col">Total no of classes</th>
      <th scope="col">No of classes attended</th>
      <th scope="col">Attendance (%)</th>
    </tr>
  </thead>
  <tbody>
  	<?php
	    	for ($i = 0; $i < count($fetch); $i++) {
          $flag = 0;
          for ($j = 0; $j < count($str_arr); $j++) {
            if ($fetch[$i]['RegNo'] == $str_arr[$j]) {
              $flag = 1;
              break;
            }
          }
          if ($flag == 1) {?>
    <tr style="background-color: #ff7777";>
		<th scope="row"><?php echo $fetch[$i]['RegNo'] ?></th>
		    <td><?php echo $fetch[$i]['Name'] ?></td>
		    <td><?php echo $fetch[$i]["$tot"] ?></td>
		    <td><?php echo $fetch[$i]["$pre"] ?></td>
		    <td><?php if ($fetch[$i]["$tot"] == 0) {
		    	echo "-";
		    }else {
		    	echo number_format(number_format($fetch[$i]["$pre"])/number_format($fetch[$i]["$tot"]) * 100, 2);
		    } ?></td>
    </tr>
  <?php }else {?>
    <tr style="background-color: #eaf6fb";>
    <th scope="row"><?php echo $fetch[$i]['RegNo'] ?></th>
        <td><?php echo $fetch[$i]['Name'] ?></td>
        <td><?php echo $fetch[$i]["$tot"] ?></td>
        <td><?php echo $fetch[$i]["$pre"] ?></td>
        <td><?php if ($fetch[$i]["$tot"] == 0) {
          echo "-";
        }else {
          echo number_format(number_format($fetch[$i]["$pre"])/number_format($fetch[$i]["$tot"]) * 100, 2);
        } ?></td>
    </tr>
    <?php }} ?>
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
<?php } ?>