<?php 
	session_start();
	session_unset();
	session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title></title>
</head>
<body>
<center>
	<div style="width: 400px; margin-top: 30px;" class="alert alert-success start" role="alert">
	  Logged Out Successfully!
	</div>
	<a href="index.php">Go to Back Home page.</a>
</center>
</body>
</html>