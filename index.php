<?php 
		session_start();
		ob_start();
		if(!$_SESSION['email']){
			header("location:login.php");
		}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>My Budget Control</title>
    <link rel="icon" href="images/nlogo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/mystyle.css">
</head>
<body>
<center>
	<br>
	<div class="container" style="padding-bottom:0px;margin-bottom:0px;">
		<div class="jumbotron" style="padding: 15px; background: linear-gradient(132deg,orange,green);">
			<button class="btn" style="background: black;color: white;font-family: chiller;"><h1 style="font-family: cursive;">Budget Control</h1></button>
			
			<div align="right" style="margin-top: 5px;margin-bottom: 0px;">
				<a title="LogOut" href="logout.php" class="btn btn-danger"><span class="fa fa-sign-out"> </span> </i> </a>
			</div>
			<hr>
			<div class="col-sm">
				<a title="Show Accounts" style="margin-bottom: 3px;" href="accounts.php" class="btn btn-warning float-left"><i class="fa fa-user"></i></a>
		
					<!-- Modal Start -->
						<!-- Add Expenses Modal -->
		<a type="button" title="Add Expenses" style="margin-bottom: 3px;" class="btn btn-info float-right" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span></a>

		<div align="center" class="modal" id="myModal">
			<br>
			<br>
			<div align="center" class="col-lg-4 col-sm-10 jumbotron" style="padding:10px; background: linear-gradient(132deg,orange,green);">
				<button class="close" data-dismiss="modal"> &times;</button>

				<h3 align="center"><u>Add Expenses</u></h3>
				<hr>
				<form method="POST" class="form" id="fupForm">
					<div align="left"><label>Date</label></div>
					<input class="form-control" type="date" name="date" id="date">

					<div align="left"><label>Time</label></div>
					<input class="form-control" type="time" name="time" id="time" id="time">

					<div align="left"><label>Expenses</label></div>
					<input class="form-control" type="text" name="expenses" id="expenses" placeholder="Expenses" required>

					<div align="left"><label>Amount</label></div>
					<input class="form-control" type="number" name="amount" id="amount" placeholder="Amount" required>

					<div align="left"><label>Others</label></div>
					<input class="form-control" type="text" name="others" id="others" placeholder="Others">

					<br>
					<div align="right">
						<button class="btn btn-info" type="button" id="insert">Save</button>
						<button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>

					<!-- Edit Modal -->
      <div class="modal fade" id="" role="dialog">
         
      </div>

      <div align="center" class="modal" id="editModal">
			<br>
			<br>
			<div align="center" class="col-lg-4 col-sm-10 jumbotron" style="padding:10px; background: linear-gradient(132deg,orange,green);">
				<button class="close" data-dismiss="modal"> &times;</button>

				<h3 align="center"><u>Edit Expenses</u></h3>
				<hr>
				<div id="editModal_body">
         		<!--Edit Data Here -->
         	</div>
			</div>
		</div>


					<!-- Modal End -->
			</div>
			
				<!-- Money Left -->
			<div id="moneyleft">
				<!-- Money Left Here -->
			</div>
			
		</div>
	</div>
</center>
		<!-- Table -->
<div id="tableData">
		<!-- Table Data Here -->
</div>

<script>
	$(document).ready(function(){
		

		function loadData(page){
			$.ajax({
				url: "read_expenses.php",
				method: "POST",
				data: {page:page},
				success:function(data){
					$('#tableData').html(data);
				}
			});
		}

		$(document).on('click', '.page_button', function(){
			var page = $(this).attr("id");
			loadData(page);
		});

		function moneyleft(){
			let nnn = 1;
			$.ajax({
				url: "moneyleft.php",
				method: "POST",
				data: {nnn:nnn},
				success:function(data){
					$('#moneyleft').html(data);
				}
			});
		}

loadData();
moneyleft();

			//Insertion
		$('#insert').on('click', function(){
			let date = $('#date').val();
			let time = $('#time').val();
			let expenses = $('#expenses').val();
			let amount = $('#amount').val();
			let others = $('#others').val();

			if (expenses!="" && amount!="") {
				$('#insert').attr("disabled", "disabled");

				$.ajax({
					url: "insert_expenses.php",
					type: "POST",
					data: {
						date: date,
						time: time,
						expenses: expenses,
						amount: amount,
						others: others
					},
					success:function(data,status){
						loadData();
						moneyleft();
						$('#insert').removeAttr("disabled");
						$('#myModal').modal('hide');
						$('#fupForm').find('input').val('');
					}
				});
			}else{
				alert("Please fill all Fields");
			}
		});


			//Edit
		$(document).on('click', '#edit', function(){
			var edit_id = $(this).attr("value");
			$.ajax({
				url: "edit_expenses.php",
				method: "POSt",
				data:{
					edit_id : edit_id
				},
				success:function(data,status){
               $('#editModal_body').html(data); 
               $('#editModal').modal('show'); 
				}
			});
		});


			//Update
		$(document).on('click', '#update', function(){
			let id = $('#id_edit').val();
			let date = $('#date_edit').val();
			let time = $('#time_edit').val();
			let expenses = $('#expenses_edit').val();
			let amount = $('#amount_edit').val();
			let others = $('#others_edit').val();
			
			if (expenses!="" && amount!="") {
				$('#insert').attr("disabled", "disabled");

				$.ajax({
					url: "update_expenses.php",
					type: "POST",
					data: {
						id: id,
						date: date,
						time: time,
						expenses: expenses,
						amount: amount,
						others: others
					},
					success:function(data,status){
						loadData();
						moneyleft();
						$('#insert').removeAttr("disabled");
						$('#editModal').modal('hide');
						$('#fupForm').find('input').val('');
					}
				});
			}else{
				alert("Please fill required Fields");
			}
		});

			//Delete
		$(document).on('click', '#delete', function(){
			var delete_id = $(this).attr("value");
			
			let alrt = confirm("Are u Sure?");
			
			if (alrt == true) {
				$.ajax({
					url: "delete_expenses.php",
					type: "POST",
					data: {
						d_id: delete_id
					},
					success:function(data,status){
						loadData();
						moneyleft();
					}
				});
			}
			
		});
	});
</script>
</body>
</html>