<?php 
	session_start();
	if (empty($_SESSION['table21']) || !isset($_SESSION['sub21'])) { ?>
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
<?php if (!empty($_SESSION['table21'])) {
	$table = $_SESSION['table21'];
	$sub = strtoupper($_SESSION['sub21']);
	$dept = $_SESSION['dept21'];
	$yr = $_SESSION['yr21'];
	$sm = $_SESSION['sm21'];
	$name = $_SESSION['name21'];
	$d = '';
	$updated = '';
	$errors = array('sub'=>'');
	if ($dept == 'bio') {$d = "BIOTECHNOLOGY"; }
	elseif ($dept == 'chem') {$d = "CHEMICAL ENGINEERING"; }
	elseif ($dept == 'civil') {$d = "CIVIL ENGINEERING"; }
	elseif ($dept == 'cse') {$d = "COMPUTER SCIENCE AND ENGINEERING"; }
	elseif ($dept == 'eee') {$d = "ELECTRICAL ENGINEERING"; }
	elseif ($dept == 'ece') {$d = "ELECTRONICS AND COMMUNICATION ENGINEERING"; }
	elseif ($dept == 'mech') {$d = "MECHANICAL ENGINEERING"; }
	else {$d = "METTALURGICAL AND MATERIALS ENGINEERING"; }

	if ($yr == 'I Year' && $sm == 'I Semester') {
		$d = 'PHYSICS CYCLE';
	}elseif ($yr == 'I Year' && $sm == 'II Semester') {
		$d = 'CHEMISTRY CYCLE';
	}
	$error = '';
	function isValid() {
		global $error;
		if (empty($_POST['absentees'])) {
			$error = "Please enter '-' in case of no absentees";
			return 0;
		}
		return 0;
	}

	include 'db_connect.php';

	if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: fac_login.php');
  }

	if (isset($_POST['add'])) {
		$tot = $sub.'_T';
		$pre = $sub.'_P';
		$string = $_POST['absentees'];  
		$str_arr = preg_split ("/\,/", $string);  
		if (isValid() == 1 || count($str_arr) == 1) {
			$string = $_POST['absentees'];  
			$str_arr = preg_split ("/\,/", $string);
			$date = date($_POST['date']);
			$query11 = "SELECT * FROM $table WHERE date1 = '$date'";
			$r11 = mysqli_query($conn, $query11);
			$f = mysqli_fetch_all($r11, MYSQLI_ASSOC);
			if ($table == 'physics' || $table == 'chemistry') {
				$q = "SELECT RegNo from $table where date1 is null";
				$rr = mysqli_query($conn, $q);
				$f1 = mysqli_fetch_all($rr, MYSQLI_ASSOC);
			}else {
				$q1 = "SELECT RollNo from $table where date1 is null";
				$rr1 = mysqli_query($conn, $q1);
				$f11 = mysqli_fetch_all($rr1, MYSQLI_ASSOC);
			}

			if (empty($f)) {
				if ($table == 'physics' || $table == 'chemistry') {
					for ($i = 0; $i < count($f1); $i++) {
						$no = $f1[$i]['RegNo'];
						$insert = "INSERT INTO $table (RegNo, $tot, $pre, date1) VALUES ('$no', 1, 1, '$date')";
						//echo $insert;
						$rr11 = mysqli_query($conn, $insert);
						$iqa = "UPDATE $table SET $tot = ($tot)+1, $pre = ($pre)+1 where RegNo = '$no' and date1 is null";
						$ri = mysqli_query($conn, $iqa);
					}
					for ($i = 0; $i < count($str_arr); $i++) {
						$up1 = "UPDATE $table SET $pre = ($pre)-1 WHERE RegNo = '$str_arr[$i]' and date1 = '$date'";
						$upr = mysqli_query($conn, $up1);
						$ui = "UPDATE $table SET $pre = ($pre)-1 where RegNo = '$str_arr[$i]' and date1 is null";
						$uri = mysqli_query($conn, $ui);
					}
				}else {
					for ($i = 0; $i < count($f11); $i++) {
						$no = $f11[$i]['RollNo'];
						$insert = "INSERT INTO $table (RollNo, $tot, $pre, date1) VALUES ('$no', 1, 1, '$date')";
						$rr123 = mysqli_query($conn, $insert);
						$iqwe = "UPDATE $table SET $tot = ($tot)+1, $pre = ($pre)+1 where RollNo = '$no' and date1 is null";
						$ri = mysqli_query($conn, $iqwe);
					}
					for ($i = 0; $i < count($str_arr); $i++) {
						$up1 = "UPDATE $table SET $pre = ($pre)-1 WHERE RollNo = $str_arr[$i] and date1 = '$date'";
						$upr = mysqli_query($conn, $up1);
						$ui = "UPDATE $table SET $pre = ($pre)-1 where RollNo = '$str_arr[$i]' and date1 is null";
						$uri = mysqli_query($conn, $ui);
					}
				}
			}else {
				if ($table == 'physics' || $table == 'chemistry') {
					$noqw = $f1[0]['RegNo'];
					$qwe = "SELECT $tot FROM $table WHERE date1 = '$date' AND RegNo = '$noqw'";
					$rqwe = mysqli_query($conn, $qwe);
					$fetchq = mysqli_fetch_all($rqwe, MYSQLI_ASSOC);
					if (($fetchq[0]["$tot"]) == 1) {
						$same = 1;
					}else {
						$same = 0;
					}
					if ($same == 1) {
						$anoth = "SELECT RegNo from $table WHERE $pre = 0 and date1 = '$date'";
						$rano = mysqli_query($conn, $anoth);
						$fano = mysqli_fetch_all($rano, MYSQLI_ASSOC);

						for ($j = 0; $j < count($fano); $j++) {
							$no123 = $fano[$j]['RegNo'];
							$aqw = "UPDATE $table SET $pre = ($pre)+1 WHERE RegNo = '$no123' AND date1 is null";
							$raqw = mysqli_query($conn, $aqw);
							$aqw1 = "UPDATE $table SET $pre = 1 WHERE RegNo = '$no123' and date1 = '$date'";
							$rqw1 = mysqli_query($conn, $aqw1);
						}
						for ($j = 0; $j < count($str_arr); $j++) {
							$an123 = "UPDATE $table SET $pre = ($pre)-1 WHERE RegNo = $str_arr[$j] and date1 is null";
							$rq123 = mysqli_query($conn, $an123);
							$an1234 = "UPDATE $table set $pre = 0 WHERE RegNo = $str_arr[$j] and date1 = '$date'";
							$rq12 = mysqli_query($conn, $an1234);
						}
					}else {
					for ($i = 0; $i < count($f1); $i++) {
						$no = $f1[$i]['RegNo'];
						$up2 = "UPDATE $table SET $tot = 1, $pre = 1 WHERE date1 = '$date' and RegNo = '$no'";
						$rup2 = mysqli_query($conn, $up2);
						$iqw = "UPDATE $table SET $tot = ($tot)+1, $pre = ($pre)+1 where RegNo = '$no' and date1 is null";
						$ri = mysqli_query($conn, $iqw);
					}
					for ($i = 0; $i < count($str_arr); $i++) {
						$up1 = "UPDATE $table SET $pre = ($pre)-1 WHERE RegNo = $str_arr[$i] and date1 = '$date'";
						$upr = mysqli_query($conn, $up1);
						$ui = "UPDATE $table SET $pre = ($pre)-1 where RegNo = '$str_arr[$i]' and date1 is null";
						$uri = mysqli_query($conn, $ui);
					}
				}
				}else {
					$no11 = $f11[0]['RollNo'];
					$qwe = "SELECT $tot FROM $table WHERE date1 = '$date' AND RollNo = '$no11'";
					$rqwe = mysqli_query($conn, $qwe);
					$fetchq = mysqli_fetch_all($rqwe, MYSQLI_ASSOC);
					if (($fetchq[0]["$tot"]) == 1) {
						$same = 1;
					}else {
						$same = 0;
					}
					if ($same == 1) {
						$anoth = "SELECT RollNo from $table WHERE $pre = 0 and date1 = '$date'";
						$rano = mysqli_query($conn, $anoth);
						$fano = mysqli_fetch_all($rano, MYSQLI_ASSOC);

						for ($j = 0; $j < count($fano); $j++) {
							$no123 = $fano[$j]['RollNo'];
							$aqw = "UPDATE $table SET $pre = ($pre)+1 WHERE RollNo = '$no123' AND date1 is null";
							$raqw = mysqli_query($conn, $aqw);
							$aqw1 = "UPDATE $table SET $pre = 1 WHERE RollNo = '$no123' and date1 = '$date'";
							$rqw1 = mysqli_query($conn, $aqw1);
						}
						for ($j = 0; $j < count($str_arr); $j++) {
							$an123 = "UPDATE $table SET $pre = ($pre)-1 WHERE RollNo = $str_arr[$j] and date1 is null";
							$rq123 = mysqli_query($conn, $an123);
							$an1234 = "UPDATE $table set $pre = 0 WHERE RollNo = $str_arr[$j] and date1 = '$date'";
							$rq12 = mysqli_query($conn, $an1234);
						}
					}else {
						for ($i = 0; $i < count($f11); $i++) {
							$no = $f11[$i]['RollNo'];
							$iw = "UPDATE $table SET $tot = 1, $pre = 1 where RollNo = '$no' and date1 = '$date'";
							$ri = mysqli_query($conn, $iw);
							$iq = "UPDATE $table SET $tot = ($tot)+1, $pre = ($pre)+1 where RollNo = '$no' and date1 is null";
							$riq = mysqli_query($conn, $iq);
						}
						for ($i = 0; $i < count($str_arr); $i++) {
							$up1 = "UPDATE $table SET $pre = ($pre)-1 WHERE RollNo = $str_arr[$i] and date1 = '$date'";
							$upr = mysqli_query($conn, $up1);
							$ui = "UPDATE $table SET $pre = ($pre)-1 where RollNo = '$str_arr[$i]' and date1 is null";
							$uri = mysqli_query($conn, $ui);
						}
					}
				}
			}
			$_SESSION['absen'] = $str_arr;
			$_SESSION['table11'] = $table;
			$_SESSION['sub11'] = $sub;
			$_SESSION['dept11'] = $dept;
			$_SESSION['year11'] = $yr;
			$_SESSION['sem11'] = $sm;
			if ($table == 'physics' || $table == 'chemistry') {
				header('Location: after_atndnce1.php');
			}else {
				header('Location: after_atndnce.php');
			}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Attendance</title>
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
	.wel1 {
		font-size: 25px;
	}
  .form-control
{
  height: 40px;
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
	<div class="p-3 mb-2 bg-secondary text-white wel1" style="text-align: center;">Hello <?php echo $name; ?>, Welcome!</div><br>
	<center><h5 style="margin-top: 3px;"><?php echo $d?></h5></center>
	<center><h6><?php echo $yr . "-" . $sm . "  ($sub)"; ?></h6></center><br>
	<form method="post">
	<center>
		<div class="form-group"> <!-- Date input -->
        <input type="date" style="width: auto; text-align: center;" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD"/>
      </div>
		<div class="form-group wel">
	    <label for="pass" align="left">Enter complete roll no of absentees seperated by comma<strong style="color: #ff5555; font-size: 16px; margin-left: 20px;"><?php echo $errors['sub'] ?></strong>
	    <input  type="text" class="form-control" name="absentees" id="pass" Placeholder="Enter the Absentees rollno.s"size="70">
	    </label>    
	  </div>
	  <button name="add" type="submit" style="color: white; margin-top: 25px; padding-top: 5px; padding-bottom: 5px; background-color: #666699" >Submit &#8680</button><br><br>
	</center>
	<center><button name="logout" type="submit" style="color: white; margin-top: 25px; padding-top: 5px; padding-bottom: 5px; background-color: #ed7878; width: auto;" >&#8678 Logout!</button></center>
</form>
<br><br>
<center>
	<p style="font-size: 12px;">*Enter valid information, invalid entries causes errors in the attendance %. (If absentees are 411863, 411891, then enter: 411863, 411891. If no absentees then enter: - (hyphen)).</p>
</center>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>