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
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="icon" href="logofun.png">
  <link rel="stylesheet" href="css/Enterprising.css" type="text/css" />
</head>



  <script>
  $(document).ready(function(){
    $("#city").click(function(){
  window.location = "test.php";
    });
  });

  
  $(document).ready(function(){
    $("#submit").click(function(){
      var x = document.getElementById("comm").value;
      document.cookie = "comment = " + x ;
    });
  });
  
</script>

<!-- Upload image to /uploads  -->
<?php
// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("uploads/" . $_FILES["photo"]["name"])){
                //echo $_FILES["photo"]["name"] . " is already exists.";
                 $message = $_FILES["photo"]["name"] . " is already exists.Please change the name of the photo!";
		 echo "<script type='text/javascript'>alert('$message');</script>";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $_FILES["photo"]["name"]);
               
                //echo "Your file was uploaded successfully.";
                $message = "Your file was uploaded successfully.";
		echo "<script type='text/javascript'>alert('$message');</script>"; 
                
            } 
        } else{
            //echo "Error: There was a problem uploading your file. Please try again."; 
		$message = "Error: There was a problem uploading your file. Please try again.";
		echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else{
       // echo "Error: " . $_FILES["photo"]["error"];
        $message = "Error: " . $_FILES["photo"]["error"];
	echo "<script type='text/javascript'>alert('you forgot to upload an image!');</script>";
        
    }
}
?>



<body >
  <nav class="navbar navbar-inverse bg-inverse">
  <!-- Navbar content -->


    <div class="container-fluid">
	<div class="navbar-header">
	  <a class="navbar-brand" href="welcome.php"><span class="glyphicon glyphicon-chevron-left"></span></a>
	</div>
	<ul class="nav navbar-nav navbar-right">
	  <li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Exit</a></li>
	</ul>
    </div>
  </nav>




 <div class="container col-lg-12 spacer "></div>

    <div class="container col-lg-12 ">

        <div class="row col-xs-6 block bg-primary center ">
            <form method="post" action=" "  class="form-horizontal" role="form" align="center" enctype="multipart/form-data">
            
            
	      <div class="form-group">
	       <label class="control-label col-sm-4" for="city" >Location:<em>*</em></label> 
	        <div class="col-sm-8 col-xs-12">
		<button id="city" class="btn btn-primary dropdown-toggle" type="button" ><?php if(isset($_COOKIE['city'])){echo $_COOKIE['city'];}else{echo "click to open map";}  ?>
		<span class="caret"></span></button>
	      </div>
	       </div>
	      
	      
	      <div class="form-group">
		  <label class="control-label col-sm-4"  for="company">Company:<em>*</em></label>
		  <div class="col-sm-8 col-xs-12">
                    <input type="text" name="company" id="company" placeholder="company name" required="true" class="form-control"/>
		  </div>
		 </div> 

		 
	    <div class="form-group">
	     <label  class="control-label col-sm-4" >Select image :<em>*</em></label>
	     <div class="col-sm-8 col-xs-12" >
		 
		  <input type="file" name="photo" id="fileToUpload">
	     </div>
	   </div>

	   <div class="form-group">
	      <label  class="control-label col-sm-4" >Details :<em>*</em></label>
	       <div class="col-sm-7 col-xs-11"  >
	      <textarea class="form-control" rows="10" cols="40" id="comm" name="varname"></textarea>
	    </div>
	    </div>
	    
	       
	      
	      <input id="submit" type="submit" value="Register my enterprise" name="submit" class="btn btn-default" >
	      
	      
	    </div>
	  </div>	
	  </form>	
        </div>       
    </div>
  
 <div class="container" >
  
     


   
  <?php
 /*register new enterprise*/
  $val_company = $_POST['company'];
  //$val_location = $_POST['location'];
  $val_city=$_COOKIE['city'];
  $val_fulladdress=$_COOKIE['faddress'];
  $filename = $_FILES["photo"]["name"];

  $mode="desktop";
  
  if(is_null($val_company) || is_null($val_city) || empty($filename) ){
  //echo '<script>alert("something is missing..");</script>';
    exit();
  
  }else{
    registerEnter($val_company,$val_city,$filename,$_COOKIE["comment"],$val_fulladdress);
  }
  
 if(strcmp($mode,"desktop")==0){
    header("Location:welcome.php"); /* Redirect browser */
  }else{
    header("Location:mobile_version/m.welcome.php"); /* Redirect browser */
  }
  
  ?>


  
</body>
</html>

