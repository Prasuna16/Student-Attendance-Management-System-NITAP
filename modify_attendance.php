<?php 

	session_start();
	if (!isset($_SESSION['table5'])) { ?>
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
  <?php if (isset($_SESSION['table5'])) {
	$table = $_SESSION['table5'];
	$sub = strtoupper($_SESSION['sub5']);
	$dept = $_SESSION['dept5'];
	$yr = $_SESSION['yr5'];
	$sm = $_SESSION['sm5'];
	$tot = $sub.'_T';
	$pre = $sub.'_P';
	include ('db_connect.php');
	if ($yr == 'I Year') {
		$query = "SELECT Name, $table.RegNo,$tot, $pre from student s join $table on s.RegNo = $table.RegNo";
	}else {
		$query = "SELECT Name, $table.RollNo,$tot, $pre from student s join $table on s.RollNo = $table.RollNo";
	}

	$res = mysqli_query($conn, $query);

	$fetch = mysqli_fetch_all($res, MYSQLI_ASSOC);

	mysqli_free_result($res);

	mysqli_close($conn);
	$c = count($fetch);

	$d = '';

	if ($dept == 'bio') {$d = "BIOTECHNOLOGY"; }
	elseif ($dept == 'chem') {$d = "CHEMICAL ENGINEERING"; }
	elseif ($dept == 'civil') {$d = "CIVIL ENGINEERING"; }
	elseif ($dept == 'cse') {$d = "COMPUTER SCIENCE AND ENGINEERING"; }
	elseif ($dept == 'eee') {$d = "ELECTRICAL ENGINEERING"; }
	elseif ($dept == 'ece') {$d = "ELECTRONICS AND COMMUNICATION ENGINEERING"; }
	elseif ($dept == 'mech') {$d = "MECHANICAL ENGINEERING"; }
	else {$d = "METTALURGICAL AND MATERIALS ENGINEERING"; }

	$i = 0;
	$updated = '';
	if (count($fetch) > 0){
	$taken = $fetch[$i]["$tot"];}
	include ('db_connect.php');
	if (isset($_POST['submit'])) {
		$taken = $_POST['tot'];
		$sql = "UPDATE $table SET $tot = $taken";
		$res = mysqli_query($conn, $sql);
		for ($i = 0; $i < $c; $i++) {
			$value = $_POST["$i"];
			$roll = $fetch[$i]['RollNo'];
			$sql = "UPDATE $table SET $pre = $value WHERE $table.RollNo='$roll'";

			$res = mysqli_query($conn, $sql);

			if ($res) {
				$updated = "Updated Successfully in the database! But Attendance Percentage here is not yet updated! Please check them in Check Attendance field!";
			}else {
				$updated = "Please enter valid data! If the problem persists please contact domain admin for help";
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body><?php if ($yr == 'I Year' && $sm == 'I Semester')  {?>
      <center><h5 style="margin-top: 1%;">PHYSICS CYCLE</h5></center>
    <?php } ?>
    <?php if ($yr == 'I Year' && $sm == 'II Semester')  {?>
      <center><h5 style="margin-top: 1%;">CHEMISTRY CYCLE</h5></center>
    <?php } ?>
    <?php if ($yr != 'I Year')  {?>
      <center><h5 style="margin-top: 1%;"><?php echo $d?></h5></center>
    <?php } ?>
    
	<center><h6><?php echo $yr . "-" . $sm . "  ($sub)"; ?></h6></center><br>
<form method="post">
	<?php if ($updated != '') { ?>
	<center><div class="form-group alert alert-success" style="font-size: 17px; width: 600px;">
	    <?php echo $updated ?>
	  </div></center>
	<?php } ?>
	<center>
		<label>Total no of Classes taken till now: <?php if (isset($taken)) { echo $taken;} ?></label>
	</center>
<center>
		<label>Total no of Classes taken: </label>
		<input type="text" name="tot" required>
	</center>
	<center>
	<table class="table table-bordered" style="width: 80%; margin-top: 3%;">
  <thead>
    <tr class="table-primary">
      <?php if ($yr == 'I Year') { ?><th scope="col">RegNo<?php } ?></th>
      <?php if ($yr != 'I Year') { ?><th scope="col">RollNo<?php } ?></th>
      <th scope="col">Name</th>
      <th scope="col">No of classes attended</th>
      <th scope="col">Attendance (%)</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
	    	for ($i = 0; $i < count($fetch); $i++) {?>
    <tr style="background-color: #eaf6fb";>
		<?php if ($yr == 'I Year') { ?><th scope="row"><?php echo $fetch[$i]['RegNo'] ?></th> <?php } ?>
		<?php if ($yr != 'I Year') { ?><th scope="row"><?php echo $fetch[$i]['RollNo'] ?></th> <?php } ?>
		    <td><?php echo $fetch[$i]['Name'] ?></td>
		    <td><input type="text" required name=<?php echo $i ?>></td>
		    <td><?php if ($fetch[$i]["$tot"] == 0) {
		    	echo "-";
		    }else {
		    	echo number_format(number_format($fetch[$i]["$pre"])/number_format($fetch[$i]["$tot"]) * 100, 2);
		    } ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<button name='submit' type="submit" style="color: black; margin-top: 25px; padding-top: 5px; padding-bottom: 5px; background-color: #7abaff" ><b>Submit</b></button>
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