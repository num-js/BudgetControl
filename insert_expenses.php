<?php
	include 'conn.php';

	if (isset($_POST['expenses'])) {
		
		$date=$_POST['date'];
		$time=$_POST['time'];
		$expenses=$_POST['expenses'];
		$amount=$_POST['amount'];
		$others=$_POST['others'];

			date_default_timezone_set("Asia/Kolkata");
		if ($date=='') {
			$date=date("Y/m/d");
		}
		if ($time=='') {
			$time=date("h:i:s A");
		}
		if ($others=='') {
			$others="---";
		}

		
		$query="INSERT INTO `mybudget`(`date`, `time`, `expenses`, `amount`, `others`) VALUES ('$date','$time','$expenses','$amount','$others')";
		$query_run = $conn->prepare($query);
		$query_run->execute();
		
		/*
		$result = $query_run->execute();
		if($result) {
			echo "Data Inserted";
		}else{
			echo "Data Not Inserted";
		}*/
	}
?>
