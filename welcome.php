<?php
session_start();
if(!isset( $_SESSION['email'])){
header("Location: login.php");
}
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
  <script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
  <link rel="icon" href="logofun.png">
  <link rel="stylesheet" href="css/welcome.css" type="text/css" />
  <title>CoffeeFun</title>
</head>






  <script  type="text/javascript" >

    /*Redirect to Mobile version*/
    if (screen.width <= 800) {
    window.location = "m.welcome.php";
     }

     
    /*exei douleia akoma edw*/
    function myFunction(id,name,value) {
    document.cookie = "id = " + id ;
    document.cookie = "name = " + name ;
    document.cookie = "location = " + value ;
    window.location.href = "User.php"; 
      }


      /*images onclick feature*/
    $(document).ready(function(){ 
    $(document).on("click",'#locationss li ',function() {
    var value=$(this).text();
    window.location.href = "welcome.php?loc=" + value; 
    });
    });

 </script> 


  
  
<body>

  <nav class="navbar navbar-inverse bg-inverse">
  <!-- Navbar content -->
<div class="container-fluid" >
    <div class="navbar-header"><a href="welcome.php"><img id="logo" src="logofun.png" ></a>
  </div>
    <ul class="nav navbar-nav navbar-left" style="padding-left:5%;">
           <li><a><span class="glyphicon glyphicon-user"></span><?php echo " User: " .$_SESSION["email"].""; ?></a></li>
           
           <?php 
		if(isadmin($_SESSION["email"])){
		
		echo " <li><a id='admin' href='admin.php'><span class='glyphicon glyphicon-console'></span> administrator</a></li>";
		 
		}
      
		?>
		
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" ><span class="glyphicon glyphicon-filter" aria-hidden="true"></span>Filter By Location
          <span class="caret"></span></a>
          <ul id ="locationss" class="dropdown-menu">
        <li><a id ="locations" href="#">All</a></li> 
            <li class="divider"></li>
	</li>
     </ul>
 <li><a href="Enterprising.php"><span class="glyphicon glyphicon-list-alt"></span> Enterprising</a></li>
      <li><a href="UserSettings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
      <li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Exit</a></li>
    </ul>
  </div>
  </nav>





     





  <?php
    if (!isset($_SESSION['email'])){
      header("Location: login.php");
    }

      /*show companies + filter feature*/

  
    if(isset($_GET['loc'])){
      showcompanies($_GET['loc'],"desktop");
    }else{
      showcompanies("All","desktop");
    }
  ?>

</body>
</html>

