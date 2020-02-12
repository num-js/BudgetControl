<?php 
	session_start();
	include 'conn.php';

	
	
	if (isset($_POST['expenses'])) {
		$uid = $_SESSION['eid'];

		$id=$_POST['id'];
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

		$query="UPDATE `mybudget` SET `id`='$id', `date`='$date', `time`='$time', expenses='$expenses', amount='$amount', others='$others' WHERE id='$uid' ";
		$query_run=$conn->prepare($query);
		$query_run->execute();
	}

?>