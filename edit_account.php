<?php
	session_start();
	require_once 'conn.php';
	
	$output ='';

	$eid = $_POST['edit_id'];

	$_SESSION['eid'] = $eid;


	$query = " SELECT * FROM `accounts` WHERE id=$eid ";
	$query_run = $conn->prepare($query);
	$query_run->execute();
	$result = $query_run->fetchAll(PDO::FETCH_ASSOC);

	foreach ($result as $row) {
		$output .= '
			<form method="POST" class="form" id="fupForm">
				<div align="left"><label>ID</label></div>
				<input class="form-control" type="number" name="id" id="id_edit" value="'.$row["id"].'">
				
				<div align="left"><label>Date</label></div>
				<input class="form-control" type="date" name="date" id="date_edit" value="'.$row["date"].'">

				<div align="left"><label>Time</label></div>
				<input class="form-control" type="time" name="time" id="time_edit" value="'.$row["time"].'">

				<div align="left"><label>Month</label></div>
				<input class="form-control" type="text" name="month" id="month_edit" placeholder="Month" value="'.$row["month"].'" required>

				<div align="left"><label>Money</label></div>
				<input class="form-control" type="number" name="money" id="money_edit" placeholder="Money" value="'.$row["money"].'" required>

				<div align="left"><label>Others</label></div>
				<input class="form-control" type="text" name="others" id="others_edit" value="'.$row["others"].'"placeholder="Others">

				<div align="left"><label>Money Left</label></div>
				<input class="form-control" type="text" name="money_left" id="money_left_edit" value="'.$row["money_left"].'"placeholder="Money Left">

				<br>
				<div align="right">
					<button class="btn btn-info" type="button" id="update">Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
				</div>
			</form>
			';
	}

	echo $output;
?>