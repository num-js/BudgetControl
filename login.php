<?php
    session_start();   //Session
    ob_start();

    if(isset($_SESSION['email'])){
        header("location:index.php");
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
  <link rel="stylesheet" type="text/css" href="assets/mystyle.css">
</head>
<body>

<br>
<br>
<br>
<div class="container col-lg-4">

      <!--Login Form-->
   <div class="jumbotron" style="padding-top: 15px; background: linear-gradient(132deg,orange,orange,orange,white,green,green,green);
	    
      background-size: 400% 400%;
      
      animation: btnchange 15s linear infinite;
}
@keyframes btnchange{
      0%{
          background-position: 0% 50%;
      }
      25%{
          background-position: 50% 50%;
      }
      50%{
          background-position: 100% 50%;
      }
      75%{
          background-position: 75% 50%;
      }
      100%{
          background-position: 0% 50%;
      }
}"> 
	<div  align="center"> <button class="btn" style="background: linear-gradient(140deg,orange,green); color: white;font-family: chiller;"><h3 style="font-family: cursive;">Budget Control</h3> </button></div>
	<br>
    <div id="sform">
        <h4 class="text-center text-danger">LogIn</h4>
        <div class="form-content">
          <form action="" method="post">
              
              <input type="email" name="email" class="form-control" required placeholder="Email"><br>
              
              <input type="Password" name="password" class="form-control" required placeholder="Password"><br>
              
              <center> <button class="btn btn-info" type="login" name="login">LogIn </button></center>
          </form>
      </div>
    </div>
  
      
   </div>
</div> <!--Container div-->
<br><br>

<?php
    require_once "conn.php";     
          //Fetching LogIn Data---
  if (isset($_POST['login'])) {
     $email=mysqli_real_escape_string($conn1,$_POST['email']);
     $password=mysqli_real_escape_string($conn1,$_POST['password']);
              
     $query="SELECT * FROM register WHERE email='$email' && password='$password'";
     $data=mysqli_query($conn1, $query);    
     $total=mysqli_num_rows($data);
   
     if ($total) {
        while ($row = mysqli_fetch_array($data)) {
          $_SESSION['name']=$row['name'];
          $_SESSION['email']=$row['email'];
          $_SESSION['password']=$row['password'];
        }
          header("Location:index.php");
      }
     else{
        echo "<script>
                 alert('Wrong user Name or Password... Please Try again...');
              </script>
        <p align='center' style='color:red;'>Wrong user Name or Password<br>please Try again</p>";
      }
   }
?>

</body>
</html>