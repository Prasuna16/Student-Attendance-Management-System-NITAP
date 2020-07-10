<?php 
	$conn = mysqli_connect('localhost', 'Prasuna', 'suna16', 'attendancemanagement');

	if ($conn) {
		$sql = "SELECT * FROM STUDENT WHERE RegNo = '981111'";
		$chk = mysqli_query($conn, $sql);
		$info = mysqli_fetch_all($chk, MYSQLI_ASSOC);

		print_r($info);
		// [RegNo] => 981111 [RollNo] => 111801 [Name] => Ramu [email] => rani2000@gmail.com [Password] => rani123 [Department] => bio [MobileNo] => 9632581471 [Year] => two ) 

		$sql2 = "UPDATE `STUDENT` SET RegNo = 981111, RollNo = 111801, Name = 'Rani', email = 'rani2000@gmail.com', Password = 'rani123', Department = 'bio', MobileNo = '9632581471', Year = 'two' WHERE RegNo = '981111'";
		$chk1 = mysqli_query($conn, $sql2);

		//$info1 = mysqli_fetch_all($chk1, MYSQLI_ASSOC);
		//$comments_query_result = mysqli_query($conn, $sql2);
		//$comments = mysqli_fetch_assoc($comments_query_result);
// 		if(!$comments_query_result) {
//  echo("Error description: " . mysqli_error($conn));
// }else {
// 	echo "Yes";


		$sql = "SELECT * FROM STUDENT WHERE RegNo = '981111'";

		$chk = mysqli_query($conn, $sql);
		$info = mysqli_fetch_all($chk, MYSQLI_ASSOC);

		print_r($info);

	}
?>