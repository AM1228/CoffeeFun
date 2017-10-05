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
  <link rel="stylesheet" href="css/UserSettings.css" type="text/css" />
  <title>CoffeeFun</title>
</head>



    

<script type="text/javascript">

  
  
  $(document).ready(function(){
      $(document).on('click', "#infocompany1", function (){
	var text=$(this).text();
	var val=$(this).attr('val');
	var companyid=$(this).attr('cid');
  //var value=document.getElementById("fun").text(); 
 //alert(companyid);

	var dummy = '<span>Edit: <input id="txt1" type="text" placeholder=' +text+ '><small>-</small></span><button id="btn1"  type="button" class="btn btn-default" >done</button>\r\n';
	document.getElementById('smt1').innerHTML = dummy;  

	   $( "#btn1" ).click(function() {
  
	      var txt1=$('#txt1').val(); 

	  jQuery.ajax({
		type: "POST",
		url: 'editsettings.php',
		data: {'function': 'editenter',txt1,val,text,companyid}, 
		success:function(data) {
	      alert('successfully changed !'); 
	    window.location.href = "UserSettings.php"; 
	      }
	  });
 
	  });

      });


    $(document).on('click', "#infocompany2", function (){
	var text=$(this).text();
 
 
	var val=$(this).attr('val');
	var companyid=$(this).attr('cid');
  //var value=document.getElementById("fun").text(); 
 //alert(companyid);

	var dummy = '<span>Edit: <input id="txt1" type="text" style="width: 250px;height:50px;"  placeholder="' +text+ '"><small>-</small></span><button id="btn1"  type="button" class="btn btn-default" >done</button>\r\n';
	document.getElementById('smt1').innerHTML = dummy;  

		$( "#btn1" ).click(function() {
  
		    var txt1=$('#txt1').val(); 
  
  
    
		  jQuery.ajax({
		      type: "POST",
		      url: 'editsettings.php',
		      data: {'function': 'editenter',txt1,val,text,companyid}, 
		      success:function(data) {
		      alert('successfully changed !'); 
		      window.location.href = "UserSettings.php"; 
		      }
		  });
		  
		});
		
     });





  

    $(document).on('click', "#infocompany3", function (){
	 var companyid=$(this).attr('cid');
	    $(document).on('click', "#aff", function (){
		var preview = document.querySelector('img'); //selects the query named img
		var file    = document.querySelector('input[type=file]').files[0]; //sames as here
		var reader  = new FileReader();

		  reader.onloadend = function () {
		  preview.src = reader.result;
		  }

	      if (file) {
		reader.readAsDataURL(file); //reads the data as a URL
	      } else {
	      preview.src = "";
	      }
  
  
		var fullPath = document.getElementById('infocompany3').value;
		
		if (fullPath) {
		    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
		    var filename = fullPath.substring(startIndex);
		    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
			filename = filename.substring(1);
		    }
    //alert(companyid);
    
    
    
		    var txt1=filename;
		    var text="";
		    var val="photo";
    
		    jQuery.ajax({
			type: "POST",
			url: 'editsettings.php',
			data: {'function': 'editenter',txt1,val,text,companyid},  
			success:function(data) {
			alert('successfully changed !'); 
			window.location.href = "UserSettings.php"; 
			}
		    });
    
		}
  
	 });

      });

 

    $(document).on('click', "#infocompany4", function (){
	var text=$(this).text();
	var val=$(this).attr('val');
	var companyid=$(this).attr('cid');
  //var value=document.getElementById("fun").text(); 
 //alert(companyid);

	var dummy = '<span>Edit: <input id="txt1" type="text"  placeholder=' +text+ '><small>-</small></span><button id="btn1"  type="button" class="btn btn-default" >done</button>\r\n';
	document.getElementById('smt1').innerHTML = dummy;  

	    $( "#btn1" ).click(function() {
  
	      var txt1=$('#txt1').val(); 
  
  
    
	      jQuery.ajax({
		    type: "POST",
		    url: 'editsettings.php',
		    data: {'function': 'editenter',txt1,val,text,companyid}, 
		    success:function(data) {
		    alert('successfully changed !'); 
		    window.location.href = "UserSettings.php"; 
		    }
	     });
 
	  });
    });

    
  });

  
  
  function InfoFunction(companyname) {
	var mode="desktop";
  
    jQuery.ajax({
        type: "POST",
        url: 'editsettings.php',
        data: {'function': 'infoenter',companyname,mode}, 
         success:function(data) {
        $("#parent_div_2").html( data);
       // sleep(1);
      // window.location.href = "UserSettings.php"; 
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
       window.location.href = "UserSettings.php"; 
         }
    });
  
  }
 
  
    $(document).ready(function(){
	$( "#info1" ).click(function() {
	   var text=$(this).text();
	   var val=$(this).attr('val');
  //var value=document.getElementById("fun").text(); 
// alert(val);

	  var dummy = '<span>Edit: <input id="txt1" type="text" placeholder=' +text+ '><small>-</small></span><button id="btn"  type="button" class="btn btn-default" >done</button>\r\n';
	  document.getElementById('smt').innerHTML = dummy;  

	      $( "#btn" ).click(function() {
  
		  var txt1=$('#txt1').val(); 
  
  
    
		jQuery.ajax({
		  type: "POST",
		  url: 'editsettings.php',
		  data: {'function': 'editsettings',txt1,val}, 
		  success:function(data) {
		  alert('successfully changed !'); 
		  window.location.href = "UserSettings.php"; 
		  }
		});
 
	      });

    });

    $( "#info2" ).click(function() {
      var text=$(this).text();
      var val=$(this).attr('val');
  //var value=document.getElementById("fun").text(); 
// alert(val);

      var dummy = '<span >Edit: <input id="txt1" type="text" " placeholder=' +text+ '><small>-</small></span><button id="btn"  type="button" class="btn btn-default" >done</button>\r\n';
      document.getElementById('smt').innerHTML = dummy;  

	$( "#btn" ).click(function() {
  
	    var txt1=$('#txt1').val(); 
	    jQuery.ajax({
		  type: "POST",
		  url: 'editsettings.php',
		  data: {'function': 'editsettings',txt1,val}, 
		  success:function(data) {
		  alert('successfully changed !'); 
		  window.location.href = "UserSettings.php"; 
		  }
	   });
	});
    });
    
 /*
 $( "#info3" ).click(function() {
 var text=$(this).text();
var val=$(this).attr('val');
  //var value=document.getElementById("fun").text(); 
// alert(val);

var dummy = '<span>Edit: <input id="txt1" type="text" placeholder=' +text+ '><small>-</small></span><button id="btn"  type="button" class="btn btn-default" >done</button>\r\n';
document.getElementById('smt').innerHTML = dummy;  

 $( "#btn" ).click(function() {
  
 var txt1=$('#txt1').val(); 
    jQuery.ajax({
        type: "POST",
        url: 'editsettings.php',
        data: {'function': 'editsettings',txt1,val}, 
         success:function(data) {
        alert('successfully changed !'); 
       window.location.href = "UserSettings.php"; 
         }
    });
 });

});
*/

    $( "#info4" ).click(function() {
      var text=$(this).text();
      var val=$(this).attr('val');
  //var value=document.getElementById("fun").text(); 
// alert(val);

      var dummy = '<span>Edit: <input id="txt1" type="text" placeholder=' +text+ '><small>-</small></span><button id="btn"  type="button" class="btn btn-default" >done</button>\r\n';
      document.getElementById('smt').innerHTML = dummy;  
  
	  $( "#btn" ).click(function() {
	      var txt1=$('#txt1').val(); 
	      jQuery.ajax({
		    type: "POST",
		    url: 'editsettings.php',
		    data: {'function': 'editsettings',txt1,val}, 
		    success:function(data) {
		    alert('successfully changed !'); 
		    window.location.href = "UserSettings.php";  
		    }
	      });
	 });

    });






 });



</script>



<body >


<nav class="navbar navbar-inverse bg-inverse">
  <!-- Navbar content -->


  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="welcome.php"><span class="glyphicon glyphicon-chevron-left"></span></a>
    </div>
     <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Exit</a></li>
     </ul>
  </div>
</nav>






    <?php
    
    $item=showsettings($_SESSION['email']);
    
     $email=json_decode($item)->email;
     //$id=json_decode($item)->id;
     $firstname=json_decode($item)->firstname;
     $lastname=json_decode($item)->lastname;
     $password=json_decode($item)->password;
     //$company=json_decode($item)->company1;
     
     
     
     
    echo '<div id="parent_div_1">';
    echo '<div class="panel-group" >';
    echo ' <div class="panel panel-primary" >';
    echo '  <div id="smt"class="panel-body"><h1><u>User Info</u></h1><h5><span class="glyphicon glyphicon-edit"></span> click on the values to change them </h5></div>';
    echo '<h3 id ="info"  ><u>Firstname: </u></h3><h3 id="info1"  val="fname" style="color:#6897bb;display: inline-block;margin-right: 100px; ">'.$firstname.'</h3 >';
    echo '<h3 id ="info"  ><u>Lastname: </u></h3><h3 id="info2"  val="lname" style="color:#6897bb;margin-right: 100px; ">'.$lastname.'</h3 > ';
    //echo '<h3 id ="info" ><u>Email: </u></h3><h3 id="info3" val="email" style="color:#6897bb;display: inline-block;margin-right: 100px; ">'.$email.'</h3 >';      
    echo '<h3 id ="info"  ><u>Password: </u></h3><h3 id="info4" val="password" style="color:#6897bb;display: inline-block;margin-right: 100px; ">'.$password.'</h3 >';     
      
    echo ' </div>';
    echo ' </div>';
    echo ' </div>';
    echo ' <div id="parent_div_2">';
    echo '<div class="panel panel-primary" >';
    echo '  <div class="panel-body"><h1><u>Companies</u></h1></div>';
	$data = json_decode($item, true);
    for($i = 0; $i <= count($data)-6; $i++){
	$str="company".$i;
	$company=json_decode($item)->$str;
    echo '<font style="display: inline;color:#6897bb;" size="6" ><u>'.$company.'</u></font> <button type="button" value="'.$company.'" class="btn btn-info" onclick="InfoFunction(value)">Info</button> <button  type="button" value='.$company.' class="btn btn-danger" onclick="RemoveFunction(value)">Remove</button>';
    echo '<br>';
    }
    echo '</div>';
    echo '</div>';
     
?>

  
 
    


  
  
</body>
</html>

