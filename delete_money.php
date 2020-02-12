<?php
	require_once 'conn.php';

	if (isset($_POST['d_id'])) {
		
		$d_id = $_POST['d_id'];

		$query = "DELETE FROM `accounts` WHERE id='$d_id' ";

		$query_run=$conn->prepare($query);
		$query_run->execute();
	}
?>