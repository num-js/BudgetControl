<?php
    session_start();           //Session
	unset($_SESSION['email']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>My Budget Control</title>
    <link rel="icon" href="images/nlogo.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background: linear-gradient(132deg,orange,green);">
<center>
	<div class="container text-center">
		<H1 style="color:red;font-family:cursive">Logging Out...</H1>
		<H1 style="color:green;font-family:papyrus"></H1>
		<H3 style="color:blue;font-family:cursive">See You soon...</H3>
	</div>
</center>
</body>
</html>

<?php
	header('refresh:1;index.php');
?>
