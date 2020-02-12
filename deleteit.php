<?php
					$money = 0;
					$query="SELECT * FROM `accounts`";
					$query_run = $conn1->prepare($query);
					$query_run->execute();
					$result = $query_run->fetchALL(PDO::FETCH_ASSOC);
					if ($result) {
						foreach ($result as $row) {
				 			$money= $money + $row['money'];
						}
					}
		#PDO //Money Left
$query = " SELECT * FROM `mybudget`";
$query_run = $conn1->prepare($query);
$query_run->execute();
$result = $query_run->fetchALL(PDO::FETCH_ASSOC);
$total_records = count($result);
	$total_amount = 0;
foreach ($result as $rows) {
	$total_amount = $total_amount + $rows['amount'];
}
	$total_amount;
	$money_left = $money - $total_amount;
	$money_left = number_format($money_left); #in , format
				?>
		

			<button class="btn btn-dark">Money Left :  <i class='fa fa-inr'></i><?php echo " ".$money_left ?> </button>
























			<!-- Table -->
<div style="overflow-x:auto;" style="margin: 0px; padding: 0px;">
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
<?php
			//Pagination

	$per_page = 5;
	//$total_records;
	$pagi = ceil($total_records/$per_page);
	$start = 0;
	$_SESSION['startn'] = 0;

	$current_page = 1;
	if (isset($_GET['start'])) {
		$_SESSION['startn'] = $start = $_GET['start'];
		$current_page = $start;
		$start--;
		$start = $start * $per_page;
		//$start;
	}

		$start_limit = $_SESSION['startn'];

		

	$query = " SELECT * FROM `mybudget` ORDER BY `mybudget`.`id` DESC LIMIT $start,$per_page ";
	$query_run = $conn1->prepare($query);
	$query_run->execute();
	$result = $query_run->fetchALL(PDO::FETCH_ASSOC);

	
	if (count($result) > 0 ) {
		foreach ($result as $row) {
?>
			  <tr>
				<td> <?php echo $row['id'] ?> </td>
				<td> <?php echo $row['date'] ?> </td>
				<td> <?php echo $row['time'] ?> </td>
				<td> <?php echo $row['particular'] ?> </td>
				<td> <?php echo $row['amount'] ?> </td>
				<td> <?php echo $row['reason'] ?> </td>

			  <form action="update_particular.php" method="post">
			  	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
				<td> <button type="submit" name="submit" class="btn-sm btn-warning"><span class="fa fa-edit"></span></button></td>
			  </form>

			  <form action="delete_particular.php" method="post">
			  	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
				<td><button type="submit" name="delete" class="btn-sm btn-danger"><span class="fa fa-trash"></span></button></td>
			  </form>
			 </tr>		
			
<?php		
		}
		
	}else{
		echo "<h1 class='text-danger'>No Record Found</h1><br>";
	}
	
?>
			<tr style="background:gray;color: white">
				<td></td>
				<th colspan="3">Total</td>
				<th colspan=""><?php echo $total_amount; ?></td>
				<td colspan="3"></td>
			</tr>
</table>








<br>	<!-- Pages -->
	  <ul class="pagination justify-content-center">
		<?php 
			for($i=1;$i<=$pagi;$i++){
				$class='';
				if ($current_page==$i) {
					$class='active';
				}
		?>
		<li class="page-item <?php echo $class;?>"><a class="page-link" href="?start=<?php echo $i;?>"><?php echo $i; ?> </a></li>
		<?php } ?>
	  </ul>
	














