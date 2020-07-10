<?php 
 //connect to db
	$conn = mysqli_connect('localhost', '****', '****', '****');

	//check connection
	if (!$conn) {
		echo "Connection Failed: " . mysqli_connect_error();
	}
?>