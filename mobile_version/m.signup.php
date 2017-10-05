<?php
session_start();
include '../db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/m.signup.css" type="text/css" />
</head>




<body >



<nav class="navbar navbar-inverse bg-inverse">
  <!-- Navbar content -->


 <div class="container-fluid">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="m.index.php">CoffeeFun</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
	<ul class="nav navbar-nav navbar-right">
      <li><a href="m.index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
    </div>
</nav>





<!--JUST A MESSAGE -->
<div align="center" class="container">
  <h1>Create new account!</h1>
  <p>We will send you email with your password soon</p> 
</div>

<div class="container col-lg-12 spacer"></div>
    


    <div class="container col-lg-12 ">
    
    
      
      
        <div class="row col-xs-6 block bg-primary center">
            
            <form method="post" action="signup.php"  class="form-horizontal" role="form" align="center">
            <div class="form-group" >
                <label class="control-label col-sm-3"  for="firstname">FirstName<em>*</em></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="text" name="firstname" id="firstname" placeholder="FirstName" required="true" class="form-control"/>
                </div>
            </div>  
            <div class="form-group">
                <label class="control-label col-sm-3" for="lastname">LastName<em>*</em></label>
                <div class="col-sm-8 col-xs-12">            
                    <input type="text" name="lastname" id="lastname" placeholder="LastName" required="true" class="form-control"/> 
                </div>
            </div>
             <div class="form-group">
                <label class="control-label col-sm-3" for="email">E-mail<em>*</em></label>
                <div class="col-sm-8 col-xs-12">            
                    <input type="text" name="email" id="email" placeholder="E-mail" required="true" class="form-control"/> 
                </div>
            </div>
       
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-8">  
                    <input type="submit" name="SignUp" id="SignUp" value="Sign Up" class="btn btn-default"/>
                </div>
            </div>     
        </form>
        </div>
            
    </div>


 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  



<?php

  /*register new user*/

  $var1_value = $_POST['firstname'];
  $var2_value = $_POST['lastname'];
  $var3_value = $_POST['email'];
  //$var4_value = $_POST['password'];



 function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
      return $randomString;
}

 if(checkmail($var3_value)==1){
    $message = "E-mail already exists !Please try with different E-mail ";
    echo "<script type='text/javascript'>alert('$message');</script>"; 
    }

  $stri=generateRandomString();
  
 if($var1_value==NULL || $var2_value==NULL || $var3_value==NULL || checkmail($var3_value)==1){
  //echo checkmail($var3_value);

    exit();
    
    }else{
    
   
    mail($var3_value, 'password', $stri); 

    register($var1_value,$var2_value,$var3_value,$stri);


    header("Location:login.php"); /* Redirect browser */
    //exit();
 }




?>



  
  
</body>
</html>

