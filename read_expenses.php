<?php

session_start();
ob_start();
if(!$_SESSION['email']){
        header("location:login.php");
}
require_once 'conn.php';

	$total_amount = 0;	//Total Amount of Expenses
	
	$records_per_page = 5;
	$page = '';
	$output='';
	if (isset($_POST['page'])) {
		$page = $_POST['page'];
	}else{
		$page = 1;
	}

	$start_from = ($page - 1) * $records_per_page;
	$query = "SELECT * FROM `mybudget` ORDER BY id  DESC LIMIT $start_from,$records_per_page";
	$query_run = $conn->prepare($query);
	$query_run->execute();
	$result = $query_run->fetchAll(PDO::FETCH_ASSOC);
  if ($result) {
	$output .= '
		<center>
		<div style="overflow-x:auto;" style="margin: 0px; padding: 0px;" id="tableData">
		<table align="center" class="col-lg-8 table table-boder text-center table-hover table-center" style="margin: 0px; padding: 0px; background: white;">
			<tr style="background:black;color: white">
				<th>SL No.</th>
				<th>Date</th>
				<th>Time</th>
				<th>Expenses</th>
				<th>Amount</th>
				<th>Others</th>
				<th colspan="2">Action</th>
			</tr>
				';
	foreach ($result as $row) {
		$output .= '
			<tr>
				<td>'. $row["id"] .'</td>
				<td>'. $row["date"] .'</td>
				<td>'. $row["time"] .'</td>
				<td>'. $row["expenses"] .'</td>
				<td>'. $row["amount"] .'</td>
				<td>'. $row["others"] .'</td>

				<td> <button type="submit" name="submit" class="btn-sm btn-warning" id="edit" value="'. $row['id'] .'"><span class="fa fa-edit"></span></button></td>

				<td><button type="button" name="delete" id="delete" value="'. $row['id'] .'" class="btn-sm btn-danger"><span class="fa fa-trash"></span></button></td>
			 </tr>
					';
	}
  }else{
		echo "<h1 class='text-danger'>No Record Found...</h1><br>";
  }


  	$query2 = "SELECT * FROM `mybudget` ORDER BY id  DESC";
	$query_run2 = $conn->prepare($query2);
	$query_run2->execute();
	$result2 = $query_run2->fetchAll(PDO::FETCH_ASSOC);
		//Total Amount
	foreach ($result2 as $row2) {
		$total_amount += $row2['amount'];
	}


	$output .= '
			<tr style="background:gray;color: white">
				<td></td>
				<th colspan="3">Total</td>
				<th>'. $total_amount .'</td>
				<td colspan="3"></td>
			</tr>
		</table>
		<div>
		</center>
		<br>
				';

	
	

		//total_records
	$total_records = $query_run2->rowCount();
	$total_pages = ceil($total_records / $records_per_page);

	$output .= '<div align="center">';

  	$class = '';

	for ($i=1; $i <= $total_pages; $i++) { 
		$class = $i;
		if ($page==$i) {
			$class='active';
		}
		$output .= '<span style="cursor:pointer;" class="btn btn-light '.$class.' page_button" id="'.$i.'">'.$i.'</span>';
	}
	$output .= '</div><br>';





	echo $output;
?>