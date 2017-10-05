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
  <script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
  <script type="text/javascript" src="chat.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/m.User.css" type="text/css" />
</head>



<script>


// When the user clicks on div, open the popup
function pop() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}

</script>








<body onload="setInterval('chat.update()', 1000)" >




<nav class="navbar navbar-inverse bg-inverse">
  <!-- Navbar content -->


 <div class="container-fluid" >
    <div class="navbar-header" >
    <a class="navbar-brand" href="m.welcome.php"><span class="glyphicon glyphicon-chevron-left"></span></a>
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    
    <ul class="nav navbar-nav navbar-left">
    <div class="dropdown container" >
  <button  id="btn" class="btn btn-primary dropdown-toggle"  type="button" data-toggle="dropdown" >Your Vote
  <span class="caret" ></span></button>
  
  <ul id="edw2" class="dropdown-menu" >
    <li><a   rating=1 >1 star<img src="../stars/1star.jpg"  height="50" width="100"></a></li>
    <li><a   rating=2 >2 star<img src="../stars/2star.jpg"  height="50" width="100"></a></li>
    <li><a   rating=3 >3 star<img src="../stars/3star.jpg"  height="50" width="100"></a></li>
    <li><a   rating=4 >4 star<img src="../stars/4star.jpg"  height="50" width="100"></a></li>
    <li><a   rating=5 >5 star<img src="../stars/5star.jpg"  height="50" width="100"></a></li>
  </ul>
</div>
      </ul>
      
      <div class="collapse navbar-collapse" id="myNavbar">
     <ul class="nav navbar-nav navbar-right">
        <li><a><span class="glyphicon glyphicon-map-marker"></span> <?php echo "Location: " .returnaddress($_COOKIE["id"]).""; ?></a></li>
      <li><a><span class="glyphicon glyphicon-list-alt"></span> <?php echo "Company: " .$_COOKIE['name'].""; ?></a></li>
     <li><a><span class="glyphicon glyphicon-user"></span> <?php echo "User: " .$_SESSION["email"].""; ?></a></li> 
     
    <li><a> <div  class="glyphicon glyphicon-triangle-right popup" onclick="pop()">Details
 <span class="popuptext" id="myPopup">
 <?php echo returncomment($_COOKIE["id"]);?>
 </span>
</div></a></li> 






      <li><a href="m.index.php"><span class="glyphicon glyphicon-log-out"></span> Exit</a></li>
    
      </ul>
      
    </div>
  </div>
 
</nav>




<!--xreiastei meta-->
 <?php

    if(isset( $_COOKIE['id'])){
    $uid =  $_COOKIE['id'];
    $uname =  $_COOKIE['name'];
    $uvalue =  $_COOKIE['location'];
    

//echo "<script type='text/javascript'>alert('$uid');</script>";
//echo '<h1>'.$uid.'</h1>';
    // Do whatever you want with the $uid
    }else{
    echo "<script type='text/javascript'>alert('not set');</script>";
    }
?>
    









 <script type="text/javascript">
    
        // ask user for name with popup prompt    
       // var name = prompt("Enter your chat name:", "Guest");
        var name= "<?php echo $_SESSION['email'] ?>";
        // default name is 'Guest'
    	if (!name || name === ' ') {
    	   name = "Guest";	
    	}
    	
    	// strip tags
    	name = name.replace(/(<([^>]+)>)/ig,"");
    	
    	// display name on page
    	$("#name-area").html("You are: <span>" + name + "</span>");
    	
    	// kick off chat
        var chat =  new Chat();
    	$(function() {
    	
    		 chat.getState(); 
    		 
    		 // watch textarea for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
    		 																																																});
    		 // watch textarea for release of key press
    		 $('#sendie').keyup(function(e) {	
    		 					 
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    					
    				}	
    				
    				
    			  }
             });
            
    	});
    </script>

</head>



    <div id="page-wrap" class="new" >
    
        <h2 >Live Chat</h2>
        
        <p id="name-area"></p>
        
        <div id="chat-wrap"><div id="chat-area"></div></div>
        
        <form id="send-message-area" class="input-group">
        <span class="input-group-addon" id="basic-addon1" style="color:black">Your message:</span>            
            <textarea id="sendie" maxlength = '100'  ></textarea>
        </form>
    
    </div>

<script>


  $(document).ready(function(){
    $('#edw2 li a').click(function() {
      var value=$(this).attr("rating");
      // alert(value);
      window.location.href = "m.User.php?rating=" +value; 

    });
  });


</script>
  
  <?php



//include '../db.php';
  

// echo '<div  class="new popup" style="position: absolute; text-shadow: 0 0 3px #FF0000;" onclick="pop()">Enterprise details:';
 //echo '<span class="popuptext" id="myPopup"><font  size="4" color="white" face="verdana">';
 //echo returncomment($_COOKIE["id"]);
// echo '</font></span>';
 //echo '</div>';




 //google map location
  echo '<iframe id="mapcss"
  frameborder="1" style="border-style: outset;"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDiPkBv_WTSC0u3oNzYaRvdjGrNHBPelP4&q=';
  echo returnaddress($_COOKIE["id"]);
  echo ' " allowfullscreen></iframe>';
 
 
  if(!checkvote($_SESSION["email"],$_COOKIE['name'])){
    if(isset($_GET['rating']) ){
      insertvote($uname); 
      vote($_GET['rating']);
      echo "<script type='text/javascript'>alert('Submitted successfully! \\n Click to proceed')</script>";
      //echo "<script type='text/javascript'>window.location = 'welcome.php' </script>";
      echo "<script type='text/javascript'> document.getElementById('btn').innerHTML = 'Thanks for voting';</script> ";
      echo "<script type='text/javascript'> document.getElementById('btn').className = 'btn btn-danger';</script> ";
      echo "<script type='text/javascript'> document.getElementById('btn').disabled = true;</script> ";
    }


//echo "<script type='text/javascript'>alert('Already voted for this company! \\n Click to proceed')</script>";



  }else{

    echo "<script type='text/javascript'> document.getElementById('btn').innerHTML = 'Already Voted';</script> ";
    echo "<script type='text/javascript'> document.getElementById('btn').className = 'btn btn-danger';</script> ";
    echo "<script type='text/javascript'> document.getElementById('btn').disabled = true;</script> ";
 
    //echo "<script type='text/javascript'>alert('Already voted! \\n Click to proceed')</script>";
    //echo "<script type='text/javascript'>window.location = 'welcome.php' </script>";

    //echo "<script type='text/javascript'>window.location = 'welcome.php' </script>";
  }

?>













    

  
  
</body>
</html>

