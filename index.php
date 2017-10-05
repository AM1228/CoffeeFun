<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="icon" href="logofun.png">
  <link rel="stylesheet" href="css/index.css" type="text/css" />
  <title>CoffeeFun</title>
</head>

<!-- Redirect to Mobile version  -->
<script type="text/javascript">
  <!--
  if (screen.width <= 800) {
    window.location = "mobile_version/m.index.php";
  }
</script>



<body>
  <nav class="navbar navbar-inverse bg-inverse">
  <!-- Navbar content -->


    <div class="container-fluid">
	<div class="navbar-header"><a href="index.php"><img id="logo" src="logofun.png" ></a>
	</div>
	<ul class="nav navbar-nav navbar-right">
	  <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
	  <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	</ul>
    </div>
  </nav>






  <div align="center" class="container">
    <img id="mainlogo" src="logofun.png">
  </div>




     

  
  
    
  <?php
// remove all session variables
  session_unset(); 

// destroy the session 
  session_destroy(); 


  ?>
  
  
  
</body>
</html>

