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
<?php if (!empty($_SESSION['regNo1'])) {
  $array_sub = array();
        $regNo = $_SESSION['regNo1'];

        include ('db_connect.php');

        $query = "SELECT Name, Semester FROM student WHERE RegNo='$regNo'";

        $res = mysqli_query($conn, $query);

        $year1 = 0;
        $sem1 = 0;

          $fetch = mysqli_fetch_all($res, MYSQLI_ASSOC);
          $name = $fetch[0]['Name'];
          $sem = $fetch[0]['Semester'];
          $yr = ''; $year1='';
          $sm = ''; $sem1='';

           $sem1 = 0;

          if ($sem == 'onesem') {
            $sem1 = 1;
            $sm = "I Semester";
          }else {
            $sem1 = 2;
            $sm = "II Semester";
          }
          $flag = 1;
          if ($sem1 == 1) {
            $table = 'physics';
          }else {
            $table = 'chemistry';
          }
          $q2 = "SELECT * from $table join student s on s.RegNo = $table.RegNo where s.regNo = $regNo";

          $r = mysqli_query($conn, $q2);
          $fetch = mysqli_fetch_all($r, MYSQLI_ASSOC);

          $_SESSION['regNo1'] = $regNo;
          $_SESSION['table'] = $table;
          $_SESSION['name'] = $fetch[0]['Name'];
          $_SESSION['dept'] = strtoupper($table).' CYCLE';

  ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Fill Details</title>
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
  .form-control
{
  height: 30px;
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
	<div class="navigation" >
      <nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  	<ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" style="color: white; padding-left: 30px;" href="stu_advanced1.php">Advanced Search </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" style="color: white; padding-left: 30px;" href="profile.php">My Profile </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" style="color: white; padding-left: 30px;" href="changePass.php">Change Password </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" style="color: white; padding-left: 30px;" href="logout.php">Logout </a>
      </li>
  </ul>
</div>
</nav>
</div>
	<center><h5 style="margin-top: 10px;"><?php echo strtoupper($table)." CYCLE" ?></h5></center>
  <!-- <center><h6><?php echo strtoupper($table)." CYCLE" ?></center> -->
	<center><h6><?php echo $fetch[0]["RegNo"].'-'.$fetch[0]["Name"]; ?></center>
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
			    	$flag = 1;
            global $array_sub;
            array_push($array_sub, $subcode);
            $_SESSION['subjects'] = $array_sub;?>
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
<form> 
        <center><input type="button" value="Print" 
               onclick="window.print()" /></center>
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