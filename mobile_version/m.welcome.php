<?php
session_start();
    if(!isset( $_SESSION['email'])){
      header("Location: m.index.php");
    }
include '../db.php';
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
  <link rel="stylesheet" href="css/m.welcome.css" type="text/css" />
</head>






  <script  type="text/javascript" >
    $("footer a[href='#top']").on('click', function(event) {
      $('html, body').animate({
	scrollTop: $(hash).offset().top
	}, 900, function(){

	// Add hash (#) to URL when done scrolling (default click behavior)
	window.location.hash = hash;
      });
    });

    

  function myFunction(id,name,value) {
   //document.getElementById(id).innerHTML = '<button >details</button>';
   //document.getElementById(id).innerHTML = id;
  // window.location.href = "User.php"; 
//$.post('User.php', {id: id});
 //window.location = "User.php?id=" + id + "&lol=" +123;
  
  //alert(name);

  
    document.cookie = "id = " + id ;
    document.cookie = "name = " + name ;
    document.cookie = "location = " + value ;
    window.location.href = "m.User.php"; 


   
  }


/*images onclick feature*/

  $(document).ready(function(){
    $(document).on("click",'#locationss li ',function() {
      var value=$(this).text();

 
 
      window.location.href = "m.welcome.php?loc=" + value; 

    });
  });


  </script> 


<body  id="top" data-spy="scroll"  data-offset="50">

  <nav class="navbar navbar-inverse bg-inverse">
  <!-- Navbar content -->


  <div class="container-fluid">
      <div class="navbar-header" >
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
        <div class="navbar-header"><a href="m.welcome.php"><img id="logo" src="../logofun.png" ></a></div>
    <ul class="nav navbar-nav navbar-left">
           <li><a><span class="glyphicon glyphicon-user"></span><?php echo "User: " .$_SESSION["email"].""; ?></a></li>
            <?php 
		if(isadmin($_SESSION["email"])){
		
		echo " <li><a id='admin' href='m.admin.php'><span class='glyphicon glyphicon-console'></span> administrator</a></li>";
		 
		}
      
		?>
      </ul>
     
     <div class="collapse navbar-collapse" id="myNavbar">
	<ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" >Filter By Location
          <span class="caret"></span></a>
          <ul id ="locationss" class="dropdown-menu">
            <li><a id ="locations" href="#">All</a></li> 
            <li class="divider"></li>
        </ul>
        <li><a href="m.Enterprising.php"><span class="glyphicon glyphicon-list-alt"></span> Enterprising</a></li>
      <li><a href="m.UserSettings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
      <li><a href="m.index.php"><span class="glyphicon glyphicon-log-out"></span> Exit</a></li>
    </li>
      </ul>
    </div>
  </div>
  </div>
</nav>





     





<?php


  if (!isset($_SESSION['email'])){
      header("Location: m.index.php");
  }

  /*show companies + filter feature*/

  if(isset($_GET['loc'])){

    showcompanies($_GET['loc'],"mobile");
    //echo '<p style="clear: both;">';
  }else{

  showcompanies("All","mobile");
  }


?>

<footer class="text-center">
  <a class="up-arrow" href="#top" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Bootstrap Theme Made By <a href="https://www.w3schools.com" data-toggle="tooltip" title="Visit w3schools">www.w3schools.com</a></p> 
</footer>
  
 
    

  
  
</body>
</html>

