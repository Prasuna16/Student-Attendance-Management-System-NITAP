<?php
	session_start();
	if(!isset($_SESSION['regNo1'])) { ?>
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
<?php }else{?>
	<?php 
		include 'db_connect.php';
		$reg = $_SESSION['regNo1'];
		$table = $_SESSION['table'];
		$subjects = $_SESSION['subjects']; ?>
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
      <a class="navbar-brand" href="displayCurrent.php">
    <img src="arrowleft.png" style="float: left; margin-left: 20px; " width="40" height="20" alt="Back">
     </a>
    </div>
				<center><h5 style="margin-top: 1%;"><?php echo $_SESSION['dept']?></h5></center>
				<center><h6><?php echo $_SESSION['rollNo'].'-'.$_SESSION['name']; ?></center>
			</body>
			</html>
			<center>
			<table class="table table-bordered" style="width: 60%; margin-top: 3%;">
			  <thead>
			    <tr class="table-primary">
			      <th scope="col">Subject Code</th>
			      <th scope="col">Dates on which you are absent</th>
			    </tr>
			  </thead>
			  <tbody>
							<?php for ($i = 0; $i<count($subjects); $i++) {
						    		$pre = $subjects[$i].'_P';
									$tot = $subjects[$i].'_T';
									$q1 = "SELECT date1 from $table join student on $table.RollNo=student.RollNo where RegNo = '$reg' and date1 is not null and $pre=0 and $tot=1";
									$rq1 = mysqli_query($conn, $q1);
									$fet = mysqli_fetch_all($rq1, MYSQLI_ASSOC);
									if (count($fet) == 0) { ?>
										<tr style="background-color: #eaf6fb";>
										<th scope="row"><?php echo $subjects[$i]; ?></th>
										<td>-</td>
									<?php }else { ?>
										<tr style="background-color: #eaf6fb";>
											<th scope="row"><?php echo $subjects[$i]; ?></th>
										<td><?php for ($j = 0; $j<count($fet); $j++) {
											echo $fet[$j]['date1'].'<br>';
										 } ?></td>
									<?php }}} ?>
			  </tbody>
			</table>