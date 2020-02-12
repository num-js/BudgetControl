<?php
	require_once 'conn.php';

if ($_POST['nnn']) {
		//Getting Total Money
	$output = '';
	$total_money = 0;
	$query="SELECT * FROM `accounts`";
	$query_run = $conn->prepare($query);
	$query_run->execute();
	$result = $query_run->fetchAll(PDO::FETCH_ASSOC);
	if ($result) {
		foreach ($result as $row) {
 			$total_money= $total_money + $row['money'];
		}
	}

		//Calculating Money Left
	$query = " SELECT * FROM `mybudget`";
	$query_run = $conn->prepare($query);
	$query_run->execute();
	$result = $query_run->fetchAll(PDO::FETCH_ASSOC);
	$total_records = count($result);
		$total_amount = 0;
	foreach ($result as $rows) {
		$total_amount = $total_amount + $rows['amount'];
	}
		$total_amount;
		$money_left = $total_money - $total_amount;
		$money_left = number_format($money_left); #in , format
					



	$output .='
		<button class="btn btn-dark"><div>Money Left : <i class="fa fa-inr">'.$money_left.'</i></div> 
		</button>
		  ';

	echo $output;
}
?>
