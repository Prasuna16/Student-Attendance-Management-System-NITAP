<?php 
	session_start();
	if (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];

  include ('db_connect.php');

  $query = "SELECT Name, Department FROM faculty WHERE email='$email'";

  $res = mysqli_query($conn, $query);

  $fetch = mysqli_fetch_all($res, MYSQLI_ASSOC);
  $_SESSION['dept'] = $fetch[0]['Department'];
  $_SESSION['name'] = $fetch[0]['Name'];
}else {
	echo "Not working";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<center><div class="form-group alert alert-success" style="font-size: 17px; width: 600px;">
		<a href="fac_after_reg.php">Continue as <?php echo $_SESSION['name'] ?></a>
	</div></center>
	<?php include 'fac_login.php'; ?>
</body>
</html>