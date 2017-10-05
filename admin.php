<?php
session_start();
include 'db.php';
if(!isadmin($_SESSION["email"])){
header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
  <link rel="icon" href="logofun.png">
  <link rel="stylesheet" href="css/admin.css" type="text/css" />
  <title>CoffeeFun</title>
</head>

<script>

function AcceptFunction(companyname) {
  //alert(companyname);
  
   jQuery.ajax({
        type: "POST",
        url: 'editsettings.php',
        data: {'function': 'acceptenter',companyname}, 
         success:function(data) {
        //alert('gg'); 
       window.location.href = "admin.php"; 
         }
    });
  
  } 

function RemoveFunction(companyname) {
  //alert(companyname);
  
   jQuery.ajax({
        type: "POST",
        url: 'editsettings.php',
        data: {'function': 'removeenter',companyname}, 
         success:function(data) {
        //alert(); 
       window.location.href = "admin.php"; 
         }
    });
  
  }
  
 
</script>


<body >

<nav class="navbar navbar-inverse bg-inverse">
  <!-- Navbar content -->
 <div class="container-fluid">
     <ul class="nav navbar-nav navbar-left">
       <li><a class="navbar-brand" href="welcome.php"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
     </ul>
      <ul class="nav navbar-nav navbar-right">
       <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Exit</a></li>
     </ul>
 </div>
</nav>



<?php
waitforauthentication("desktop");

?>
    



  
  
 
  
  
</body>
</html>

