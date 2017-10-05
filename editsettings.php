<?php
session_start();
if(!isset( $_SESSION['email'])){
header("Location: login.php");
}

include 'db.php';

  switch($_POST['function']){
    
    	 case('editsettings'):

    editsettings($_POST["txt1"],$_POST["val"]);
    break;

    
    	 case('removeenter'):
    RemoveEnter($_POST["companyname"]);
    break;


	case('infoenter'):
    InfoEnter($_POST["companyname"],$_POST["mode"]);
    break;



	case('editenter'):
    EditEnter($_POST["txt1"],$_POST["val"],$_POST["text"],$_POST["companyid"]);
    break;
    
    
    
    
	case('acceptenter'):
    AcceptEnter($_POST["companyname"]);
    break;
	

  }


?>