<?php
session_start();
include '../db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mobile version</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/m.index.css" type="text/css" />
</head>
<body >





<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header"><a href="index.php"><img id="logo" src="../logofun.png"></a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
	<ul class="nav navbar-nav navbar-right">
        <li><a href="m.signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      </ul>
    </div>
  </div>
</nav>


<div class="container col-lg-12 spacer"></div>
    


    <div class="container col-lg-12 ">
    
    
       
        <div class="row col-xs-6 block bg-primary center">
            
            <form method="post" action=" "  class="form-horizontal" role="form" align="center">
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
    echo '<script>window.location.href = "m.welcome.php";</script>';

  }else{
  // remove all session variables
    session_unset(); 

  // destroy the session 
    session_destroy(); 
    exit();
  }  






?>   

</body>
</html>
