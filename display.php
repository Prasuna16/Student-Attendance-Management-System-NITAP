<?php 
	session_start();
	if (!isset($_SESSION['name2'])) { ?>
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
<?php //if (!empty($_SESSION['name'])) {
//     if (isset($_SESSION['LAST_ACTIVIT']) && (time() - $_SESSION['LAST_ACTIVIT'])>40) {
//       session_unset();
//       session_destroy();
//     }
//     $_SESSION['LAST_ACTIVIT'] = time();
    //if (empty($_SESSION['name'])) {?>
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
    <?php if (!empty($_SESSION['name2'])) {
	$name = $_SESSION['name2'];
	$dept = $_SESSION['dept2'];
	$rollNo = $_SESSION['rollNo2'];
	$year = $_SESSION['year2'];
	$sem = $_SESSION['sem2'];
	//echo $name. " " . $dept. " ". $rollNo. " ". $year. " ". $sem." ";
	include ('db_connect.php');
	$flag = 1;

	$table = $dept . $year . $sem;

	$query = "SELECT * from $table join student s on s.RollNo = $table.RollNo where s.RollNo = $rollNo";
	//echo $query;
	
	$res = mysqli_query($conn, $query);
	if ($res) {
	$fetch = mysqli_fetch_all($res, MYSQLI_ASSOC);
}else {
	//echo "Not worked";
}
//print_r($fetch);

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
	<title></title>
	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<center><h5 style="margin-top: 1%;"><?php echo $d?></h5></center>
	<center><h6><?php echo $fetch[0]["RollNo"].'-'.$fetch[0]["Name"]; ?></center>
	<center>
	<table class="table table-bordered" style="width: 80%; margin-top: 3%;">
  <thead>
    <tr class="table-primary">
      <th scope="col">Subject Code</th>
      <th scope="col">Total no of classes</th>
      <th scope="col">No of classes attended</th>
      <th scope="col">Attendance (%)</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
	    	foreach ($fetch[0] as $key => $value) {
	    		$subcode = substr($key, 0, 5);
	    		if ($flag == 1) {
	    			$flag = 0;
	    		}
			    elseif (strtoupper($subcode) == $subcode) {
			    	$flag = 1;?>
			    	<tr style="background-color: #eaf6fb";>
					<th scope="row"><?php echo $subcode ?></th>
					    <td><?php echo $fetch[0][$subcode.'_T'] ?></td>
					    <td><?php echo $fetch[0][$subcode.'_P'] ?></td>
					    <td><?php if ($fetch[0][$subcode.'_T'] == 0) {
					    	echo "-";
					    }else {
					    	echo number_format(number_format($fetch[0][$subcode.'_P'])/number_format($fetch[0][$subcode.'_T']) * 100, 2).'%';
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