<?php
	include 'conn.php';

	if (isset($_POST['month'])) {
		
		$date=$_POST['date'];
		$time=$_POST['time'];
		$month=$_POST['month'];
		$money=$_POST['money'];
		$others=$_POST['others'];
		$money_left=$_POST['money_left'];

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
		if ($money_left=='') {
			$money_left="---";
		}

		
		$query="INSERT INTO `accounts`(`date`, `time`, `month`, `money`, `others`, `money_left`) VALUES ('$date','$time','$month','$money','$others','$money_left')";
		$query_run = $conn->prepare($query);
		$result = $query_run->execute();
	}
?>
