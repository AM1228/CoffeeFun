<?php
session_start();
include 'db.php';
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
  <link rel="stylesheet" href="css/login.css" type="text/css" />
  <title>CoffeeFun</title>
</head>

<!-- Redirect to Mobile version  -->
<script type="text/javascript">
  <!--
  if (screen.width <= 800) {
    window.location = "m.index.php";
  }
</script>



<body >

<nav class="navbar navbar-inverse bg-inverse">
  <!-- Navbar content -->
 <div class="container-fluid">
    <div class="navbar-header"><a href="index.php"><img id="logo" src="logofun.png" ></a></div>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
     </ul>
 </div>
</nav>




<!--JUST A MESSAGE -->
<div align="center" class="container">
  <h1 >Log in Now!</h1>
</div>



<div class="container col-lg-12 spacer"></div>
    


    <div class="container col-lg-12 ">
    
        <div id="pan" class="row col-xs-6 block bg-primary center" >   
          <form method="post" action="login.php"  class="form-horizontal" role="form" align="center">
            <div class="form-group" >
		<label class="control-label col-sm-3"  for="email">email<em>*</em></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="text" name="email" id="email" placeholder="email" required="true" class="form-control"/>
                </div>
            </div>  
            <div class="form-group">
                <label class="control-label col-sm-3" for="password">password<em>*</em></label>
                <div class="col-sm-8 col-xs-12">            
                    <input type="password" name="password" id="password" placeholder="password" required="true" class="form-control"/> 
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-8">  
                    <input type="submit" name="Sign In" id="Sign In" value="Sign In" class="btn btn-default"/>
                </div>
            </div>     
	  </form>
        </div>   
    </div> 


  
  
    
  <?php
      /*log in*/
    $email= $_POST['email'];
    $password = $_POST['password'];
    $_SESSION["email"] = $email;


    if(login($email,$password)){
	echo '<script>window.location.href = "welcome.php";</script>';

    }else{
	exit();
    } 



  ?>   
  
  
</body>
</html>

