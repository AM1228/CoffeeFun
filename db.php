<?php

session_start();





// use the following line when using Composer
// require __DIR__ . '/vendor/composer/autoload.php';

// use the following line when using git
require __DIR__ . '/arangodb-php/autoload.php';


// set up some aliases for less typing later
use ArangoDBClient\Collection as ArangoCollection;
use ArangoDBClient\CollectionHandler as ArangoCollectionHandler;
use ArangoDBClient\Connection as ArangoConnection;
use ArangoDBClient\ConnectionOptions as ArangoConnectionOptions;
use ArangoDBClient\DocumentHandler as ArangoDocumentHandler;
use ArangoDBClient\Document as ArangoDocument;
use ArangoDBClient\Exception as ArangoException;
use ArangoDBClient\Export as ArangoExport;
use ArangoDBClient\ConnectException as ArangoConnectException;
use ArangoDBClient\ClientException as ArangoClientException;
use ArangoDBClient\ServerException as ArangoServerException;
use ArangoDBClient\Statement as ArangoStatement;
use ArangoDBClient\UpdatePolicy as ArangoUpdatePolicy;

// set up some basic connection options
$connectionOptions = [
    // database name
    ArangoConnectionOptions::OPTION_DATABASE => 'users',
    // server endpoint to connect to
    ArangoConnectionOptions::OPTION_ENDPOINT => 'tcp://127.0.0.1:8529',
    // authorization type to use (currently supported: 'Basic')
    ArangoConnectionOptions::OPTION_AUTH_TYPE => 'Basic',
    // user for basic authorization
    ArangoConnectionOptions::OPTION_AUTH_USER => 'root',
    // password for basic authorization
    ArangoConnectionOptions::OPTION_AUTH_PASSWD => '',
    // connection persistence on server. can use either 'Close' (one-time connections) or 'Keep-Alive' (re-used connections)
    ArangoConnectionOptions::OPTION_CONNECTION => 'Keep-Alive',
    // connect timeout in seconds
    ArangoConnectionOptions::OPTION_TIMEOUT => 3,
    // whether or not to reconnect when a keep-alive connection has timed out on server
    ArangoConnectionOptions::OPTION_RECONNECT => true,
    // optionally create new collections when inserting documents
    ArangoConnectionOptions::OPTION_CREATE => true,
    // optionally create new collections when inserting documents
    ArangoConnectionOptions::OPTION_UPDATE_POLICY => ArangoUpdatePolicy::LAST,
];


    // turn on exception logging (logs to whatever PHP is configured)
    ArangoException::enableLogging();
   


    $connection = new ArangoConnection($connectionOptions);

 /*
    $collectionHandler = new ArangoCollectionHandler($connection);

    // clean up first
    if ($collectionHandler->has('users')) {
        $collectionHandler->drop('users');
    }
    if ($collectionHandler->has('example')) {
        $collectionHandler->drop('example');
    }

    // create a new collection
    $userCollection = new ArangoCollection();
    $userCollection->setName('users');
    $id = $collectionHandler->create($userCollection);

    // print the collection id created by the server
    var_dump($id);
    // check if the collection exists
    $result = $collectionHandler->has('users');
    var_dump($result);
*/

	// create a new document
 function register($var1_value,$var2_value,$var3_value,$var4_value){	
    global $connection;
	try {
     
   $handler = new ArangoDocumentHandler($connection);
    $user = new ArangoDocument();
    
   

    // use set method to set document properties
    $user->set('firstname', $var1_value);
    $user->set('lastname', $var2_value);
    $user->set('email', $var3_value);
    $user->set('password', $var4_value);

  
      // send the document to the server
    $id = $handler->save('users', $user);
  
      // check if a document exists
    $result = $handler->has('users', $id);
      //var_dump($result);
  
      // print the document id created by the server
      //var_dump($id);
      //var_dump($user->getId());
} catch (ArangoConnectException $e) {
  print 'Connection error: ' . $e->getMessage() . PHP_EOL;
} catch (ArangoClientException $e) {
  print 'Client error: ' . $e->getMessage() . PHP_EOL;
} catch (ArangoServerException $e) {
  print 'Server error: ' . $e->getServerCode() . ':' . $e->getServerMessage() . ' ' . $e->getMessage() . PHP_EOL;
}
  
  }
  
  
  
 function registerEnter($company,$location,$photo,$comment,$fulladdress){	
    global $connection;
	try {
     
   $handler = new ArangoDocumentHandler($connection);
   $user = new ArangoDocument();
    
    

    // use set method to set document properties
    $user->set('company', $company);
    $user->set('Location', $location);
    $user->set('email', $_SESSION["email"] );
    $user->set('photo', $photo);
    $user->set('comment',$comment);
    $user->set('address',$fulladdress);
    $user->set('authenticate',0);
    // send the document to the server
    $id = $handler->save('Company', $user);
  
    // check if a document exists
    $result = $handler->has('Company', $id);
      //echo $id;
  
      // print the document id created by the server
      //var_dump($id);
      //var_dump($user->getId());
} catch (ArangoConnectException $e) {
  print 'Connection error: ' . $e->getMessage() . PHP_EOL;
} catch (ArangoClientException $e) {
  print 'Client error: ' . $e->getMessage() . PHP_EOL;
} catch (ArangoServerException $e) {
  print 'Server error: ' . $e->getServerCode() . ':' . $e->getServerMessage() . ' ' . $e->getMessage() . PHP_EOL;
}
  
  }
  
  
  function login($email,$password){
    global $connection;
  //global $email;
  //global $password;
    $query = 'FOR x IN users  RETURN { email: x.email,password: x.password}'; 

    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	  )
    );

    $cursor = $statement->execute();
    $resultingDocuments = array();

//$str ="{\"email\":\"{$email}\",\"password\":\"{$password}\"}";
//echo $asd;
 
  foreach ($cursor as $check => $value) {
     //if (strcmp($value, $str) == 0){
     if (strcmp(json_decode($value)->email, $email) == 0 && strcmp(json_decode($value)->password, $password) == 0){
     //echo 'exists';
      $exists=$exists+1;
      //echo '<script>window.location.href = "welcome.php";</script>';     
     //echo $email;    
   }else{
      //echo $firstname;
      $exists=$exists+0;
     //echo $value;
     //echo '<br>OMG<br>';
    }
    //$resultingDocuments[$firstname] = $value;
   // echo $value;
  }
return $exists;
//var_dump($resultingDocuments);
}



  function checkmail($email){
    global $connection;
  //global $email;
  //global $password;
    $query = 'FOR x IN users  RETURN x.email'; 

    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );

    $cursor = $statement->execute();
    $resultingDocuments = array();

//$str ="{\"email\":\"{$email}\",\"password\":\"{$password}\"}";
    $sum=0;
 
  foreach ($cursor as $check => $value) {
     if (strcmp($email, $value) == 0){
	$sum=1;
      
      //echo '<script>window.location.href = "welcome.php";</script>';
     //echo $email;   
     
     
     }else{
      //echo $firstname;    
     // echo 'non-exists';
     //echo $value;
     //echo '<br>OMG<br>';
 
     }

    //$resultingDocuments[$firstname] = $value;
   // echo $value;
}

return $sum;

}

  function showcompanies($loc,$mode){
      global $connection;
  

     
  //global $email;
  //global $password;
      if(strcmp($loc, "All") !== 0){
      $stri=" x.Location == '$loc' ";
      $query = 'FOR x IN Company  FILTER '.$stri.'  RETURN {"photo" : x.photo,"company" :x.company,"location":x.Location,"res":x.res,"id":x._key,"authenticate":x.authenticate}';
      }else{
      $query = 'FOR x IN Company  RETURN {"photo" : x.photo,"company" :x.company,"location":x.Location,"res":x.res,"id":x._key,"authenticate":x.authenticate}'; 
      }
      $statement = new  ArangoStatement(
      $connection,
      array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
      );
      
     

     
     
  
       $cursor = $statement->execute();
     
      $resultingDocuments = array();

//$str ="{\"email\":\"{$email}\",\"password\":\"{$password}\"}";
      $a=array();
 
  foreach ($cursor as $check => $value) {
// $pieces = explode("\"", $value);
   //$temp='uploads/'.(string)$pieces[3];
// $newpiece=explode("}", $pieces[14]);
 //$gktemp=substr($newpiece[0], 1);
 
    $pieces = json_decode($value);
  if($pieces->authenticate==1){
    
  if(strcmp($mode,"desktop")==0){
    $temp='uploads/'.$pieces->photo;
  }else{
    $temp='../uploads/'.$pieces->photo;
  }
 
    $gk=floor($pieces->res);
 
    echo '<div class="buttn" style="float: left;width: auto;    " >';

  if($gk==0){
  
    if(strcmp($mode,"desktop")==0){
      echo '<img src="stars/0star.jpg"   class="img-rounded">';
    }else{
      echo '<img src="../stars/0star.jpg"   class="img-rounded">';
    }

  }elseif($gk==1 ){
  
    if(strcmp($mode,"desktop")==0){
      echo '<img src="stars/1star.jpg"   class="img-rounded">';
    }else{
      echo '<img src="../stars/1star.jpg"   class="img-rounded">';
    }
    
   }elseif($gk==2 ){
   
	if(strcmp($mode,"desktop")==0){
	    echo '<img src="stars/2star.jpg"   class="img-rounded">';
	}else{
	    echo '<img src="../stars/2star.jpg"   class="img-rounded">';
	}
	
    }elseif($gk==3 ){
    
	if(strcmp($mode,"desktop")==0){
	    echo '<img src="stars/3star.jpg"   class="img-rounded">';
	}else{
	    echo '<img src="../stars/3star.jpg"   class="img-rounded">';
	}
	
    }elseif($gk==4 ){
    
	if(strcmp($mode,"desktop")==0){
	    echo '<img src="stars/4star.jpg"   class="img-rounded">';
	}else{
	    echo '<img src="../stars/4star.jpg"   class="img-rounded">';
	}
    }
    else{
    
	if(strcmp($mode,"desktop")==0){
	    echo '<img src="stars/5star.jpg"   class="img-rounded">';
	}else{
	    echo '<img src="../stars/5star.jpg"   class="img-rounded">';
	}

    }

    echo '<div>';
  if(strcmp($mode,"desktop")==0){
    echo '<button id="'.$pieces->id.'"   value="'.$pieces->location.'" name="'.$pieces->company.'" class="buttn" onclick="myFunction(id,name,value)" ><img src="'.$temp.'" alt="HTML5 Icon" class="companyimages"></button>';
  }else{
    echo '<button id="'.$pieces->id.'"   value="'.$pieces->location.'" name="'.$pieces->company.'" class="buttn" onclick="myFunction(id,name,value)" ><img src="'.$temp.'" alt="HTML5 Icon" class="companyimages"></button>';
  }
 //echo '<button id="'.$pieces->id.'"   value="'.$pieces->location.'" name="'.$pieces->company.'" class="buttn" onclick="myFunction(id,name,value)" ><font size="5"></font><img src="'.$temp.'" alt="HTML5 Icon" class="img-rounded" style="width: 200px; float: left; height: 200px;margin-bottom: 30px;"></button>';
    echo '</div>';
 
    echo '<p id="buttnimage" class="buttn">'.$pieces->company.'</p>';
    echo '</div>';
 

    $a[$check] = $pieces->location;
   
 //$a1=array_fill(3,4,"blue"); 
//print_r( $a);

 }
 }





  $a1 = array_unique($a);
 

//print_r($a1);
  if(strcmp($loc, "All") == 0){


    foreach ($a1 as $key => $value) {
    
  
    echo "<script>";
    echo "$(document).ready(function(){ ";
    echo "$(function() {";
    echo "var change = function( txt ) {";
    echo " $('#locationss').append( '<li><a id =locations  href=#  >' + txt + '</a></li> <li class=divider></li>' );";
    // echo "$('<li><a id =\"locations\"  href=\"#\"  >' + txt + '</a></li> <li class=\"divider\"></li>').appendTo('#locationss');";
    echo " };";
    echo " change('$value'); ";   
    echo " });";
    echo " }); ";
    echo "</script>";
    }
  
  }
  
  
}



function vote($value){
    global $connection;
	
    $handler = new ArangoDocumentHandler($connection);
  
   // update a document
    $stars = $handler->get('Company', $_COOKIE['id']);
    $stars->star =$stars->star + (int) $value;
    $result = $handler->update($stars);
   

    $counter = $handler->get('Company', $_COOKIE['id']);
    $counter->sum =$counter->sum + 1;
    $result = $handler->update($counter);
 
    $total = $handler->get('Company', $_COOKIE['id']);
    $total->res =$stars->star / $counter->sum;
    $result = $handler->update($total);

     //$users = $handler->get('users',85320);
    //$users->vote = 1;
    //$result = $handler->update($users);
}



function insertvote($company){	
    global $connection;
	try {
     
   $handler = new ArangoDocumentHandler($connection);

    
   $user = new ArangoDocument();
    
    

    // use set method to set document properties
   $user->set('email', $_SESSION["email"] );
   
   $user->set('company', $company);
    
    
    
   

  

 
    
  
      // send the document to the server
    $id = $handler->save('vote', $user);
  
      // check if a document exists
    $result = $handler->has('vote', $id);
      //echo $id;
  
      // print the document id created by the server
      //var_dump($id);
      //var_dump($user->getId());
} catch (ArangoConnectException $e) {
  print 'Connection error: ' . $e->getMessage() . PHP_EOL;
} catch (ArangoClientException $e) {
  print 'Client error: ' . $e->getMessage() . PHP_EOL;
} catch (ArangoServerException $e) {
  print 'Server error: ' . $e->getServerCode() . ':' . $e->getServerMessage() . ' ' . $e->getMessage() . PHP_EOL;
  }
}

function checkvote($email,$company){
    global $connection;
  //global $email;
  //global $password;
    $query = 'FOR x IN vote  RETURN {email:x.email,company:x.company}'; 

    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );

    $cursor = $statement->execute();
    $resultingDocuments = array();


    $sum=0;
 
  foreach ($cursor as $check => $value) {
     
     if (strcmp($email, json_decode($value)->email) == 0 && strcmp($company, json_decode($value)->company) == 0){
	$sum=1;
 
      //echo '<script>window.location.href = "m.index.php";</script>';
     //echo $email;   
    
     
     }else{
    
      //echo $firstname;
      
     // echo 'non-exists';
     //echo $value;
     //echo '<br>OMG<br>';
 
     }

    //$resultingDocuments[$firstname] = $value;
   // echo $value;
  }

return  $sum;

}

function dropvote(){

  global $connection;
  $collectionHandler = new ArangoCollectionHandler($connection);
  $collectionHandler->drop('vote');

  $voteCollection = new ArangoCollection();
  $voteCollection->setName('vote');
  $collectionHandler->create($voteCollection);

}






 function returncomment($id){
    global $connection;
  //global $email;
  //global $password;
    $query = 'FOR x IN Company  RETURN {"id":x._key,"comment":x.comment}'; 

    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );

    $cursor = $statement->execute();
    $resultingDocuments = array();



 
 foreach ($cursor as $check => $value) {
     
     if (strcmp($id, json_decode($value)->id) == 0){
	$sum=json_decode($value)->comment;
 
      //echo '<script>window.location.href = "m.index.php";</script>';
     //echo $email;   
	return  $sum;
     
     }else{
    
      //echo $firstname;
      
     // echo 'non-exists';
     //echo $value;
     //echo '<br>OMG<br>';
     }

    //$resultingDocuments[$firstname] = $value;
   // echo $value;
 }

return $sum;

}



function showsettings($email){
    global $connection;
  //global $email;
  //global $password;
    $query = 'FOR x IN users  RETURN {"email":x.email,"firstname":x.firstname,"lastname":x.lastname,"password":x.password,"id":x._key}'; 
    $query1 = 'FOR y IN Company RETURN {"company":y.company,"email":y.email}'; 

    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );

    $statement1 = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query1,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );
    $cursor = $statement->execute();
    $cursor1 = $statement1->execute();
    $resultingDocuments = array();



 
 
foreach ($cursor as $check => $value) {
     
     if (strcmp($email, json_decode($value)->email) == 0){
	$_SESSION["userid"] = json_decode($value)->id;
     //$email=json_decode($value)->email;
     //$id=json_decode($value)->id;
     //$firstname=json_decode($value)->firstname;
     //$lastname=json_decode($value)->lastname;
	$temp=0;
            foreach ($cursor1 as $check1 => $value1) {
	      if(strcmp($email,json_decode($value1)->email) == 0){
		$val = json_encode($value1->company);  //$json={"var1":"value1","var2":"value2"} 
            //echo $value;
		$value =substr($value ,0,-1);
		$value .=',"company'.$temp.'":'.$val.'}';
		$temp=$temp+1;
             }
            }
    

      //echo '<script>window.location.href = "m.index.php";</script>';
      
    return  $value;
     
     }else{
    
     
 
     }

}


return $value;

}


function editsettings($txt1,$val){

    global $connection;
    $handler = new ArangoDocumentHandler($connection);

 if(strcmp($val,"fname")==0){
 
    $id = $handler->get('users', $_SESSION['userid']);
    $id->firstname =$txt1;
    $result = $handler->update($id);
 }elseif(strcmp($val,"lname")==0){
    $lname= $handler->get('users', $_SESSION['userid']);
    $lname->lastname =$txt1;
    $result = $handler->update($lname);
    
    }
   // elseif(strcmp($val,"email")==0){
    //$email= $handler->get('users', $_SESSION['userid']);
    //$email->email =$txt1;
    //$result = $handler->update($email);
    
    
    //}
 else{
    $password= $handler->get('users', $_SESSION['userid']);
    $password->password =$txt1;
    $result = $handler->update($password);
    
    
    
    }




}


function RemoveEnter($company){
    global $connection;
    $query = 'FOR y IN Company RETURN {"company":y.company,"id":y._key,"email":y.email}';

 
    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );

    $cursor = $statement->execute();

    $handler = new ArangoDocumentHandler($connection);

 
 
foreach ($cursor as $check => $value) {

  if(strcmp($company,json_decode($value)->company)==0 && (strcmp($_SESSION['email'],json_decode($value)->email)==0 || isadmin($_SESSION["email"]))){
    $theId=json_decode($value)->id;
   
   
 
 
  
  }

 
}


     try {
        $result = $handler->removeById('Company', $theId);
    } catch (\ArangoDBClient\ServerException $e) {
        $e->getMessage();
    }  
    
    

}


function InfoEnter($company,$mode){

    global $connection;

    $query = 'FOR y IN Company RETURN {"Location":y.Location,"comment":y.comment,"company":y.company,"id":y._key,"email":y.email,"photo":y.photo}';

 
    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );

  $cursor = $statement->execute();

  $handler = new ArangoDocumentHandler($connection);

 
 
foreach ($cursor as $check => $value) {

  if(strcmp($company,json_decode($value)->company)==0 && strcmp($_SESSION['email'],json_decode($value)->email)==0){
  
   $location1=json_decode($value)->Location;
   $companyid=json_decode($value)->id;
   $comment1=json_decode($value)->comment;
   $company1=json_decode($value)->company;
   $email1=json_decode($value)->email;
   $photo=json_decode($value)->photo;
   
   
 
 
  
  }

 
}

  

     try {
        $result = $handler->removeById('Company', $theId);
    } catch (\ArangoDBClient\ServerException $e) {
        $e->getMessage();
    }  
    
    echo '<div id="parent_div_3">';
    echo '<div class="panel-group" >';
    echo ' <div class="panel panel-primary" >';
 if(strcmp($mode,"desktop")==0){
    echo '<button type="button"  style="color:red" class="close"  aria-label="Close" onClick="window.location=\'UserSettings.php\';" ><span aria-hidden="true">&times;</span></button>';
 }else{
    echo '<button type="button"  style="color:red" class="close"  aria-label="Close" onClick="window.location=\'m.UserSettings.php\';" ><span aria-hidden="true">&times;</span></button>';
 }
    echo '  <div id="smt1" class="panel-body"><h1><u>Company Info</u></h1><h5><span class="glyphicon glyphicon-edit"></span> click on the values to change them </h5></div>';
    echo '<h3 id ="infocompany"  ><u>Location: </u></h3><h3 id="infocompany1"  val="location" cid="'.$companyid.'" style="color:#6897bb;display: inline-block;margin-right: 100px; ">'.$location1.'</h3 >';
    echo '<h3 id ="infocompany"  ><u>Details: </u></h3><h3 id="infocompany2"  val="comment" cid="'.$companyid.'" style="color:#6897bb;display: inline-block;margin-right: 100px; ">'.$comment1.'</h3 > ';
 if(strcmp($mode,"desktop")==0){
    echo '<h3 id ="infocompany" ><u>Photo: </u><form action="upload.php" method="post" enctype="multipart/form-data"><h4>';
 }else{
    echo '<h3 id ="infocompany" ><u>Photo: </u><form action="../upload.php" method="post" enctype="multipart/form-data"><h4>';
 }
    echo 'Select image to upload: 
    <input id="infocompany3" type="file" name="fileToUpload" cid="'.$companyid.'">
    <input id="aff" type="submit" value="Change Photo" name="submit"></h4>
</form><br>';
  if(strcmp($mode,"desktop")==0){
    echo '<img  src="uploads/'.$photo.'" height="200px" alt="Image preview...">';
  }else{
    echo '<img  src="../uploads/'.$photo.'" height="100px" alt="Image preview...">';
 }
    echo '<h3 id ="infocompany"  ><u>Company: </u></h3><h3 id="infocompany4" val="company" cid="'.$companyid.'" style="color:#6897bb;display: inline-block;margin-right: 100px; ">'.$company1.'</h3 >';     
   
   
 //</h3><input id="infocompany3"  type="file" cid="'.$companyid.'">    
      
    echo ' </div>';
    echo ' </div>';
    echo ' </div>';
 


}

    
    
    
    
  
    
function EditEnter($txt1,$val,$text,$companyid){

    global $connection;
    $handler = new ArangoDocumentHandler($connection);

 if(strcmp($val,"location")==0){
 
    $location = $handler->get('Company', $companyid);
    $location->Location =$txt1;
    $result = $handler->update($location);
 }elseif(strcmp($val,"comment")==0){
    $comment= $handler->get('Company', $companyid);
    $comment->comment =$txt1;
    $result = $handler->update($comment);
   
    }
 elseif(strcmp($val,"company")==0){
    $company= $handler->get('Company', $companyid);
    $company->company =$txt1;
    $result = $handler->update($company);
    
    
 }elseif(strcmp($val,"photo")==0){
    $photo= $handler->get('Company', $companyid);
    $photo->photo =$txt1;
    $result = $handler->update($photo);
    }
 else{
    //$password= $handler->get('Company', $companyid);
    //$password->password =$txt1;
    //$result = $handler->update($password);
    
    
    
    }
 


}


function returnaddress($companyid){

    global $connection;
  //global $email;
  //global $password;
    $query = 'FOR x IN Company  RETURN {"id":x._key,"faddress":x.address}'; 

    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );

    $cursor = $statement->execute();
    $resultingDocuments = array();



 
foreach ($cursor as $check => $value) {
     
     if (strcmp($companyid, json_decode($value)->id) == 0){
	$sum=json_decode($value)->faddress;
 
      //echo '<script>window.location.href = "m.index.php";</script>';
     //echo $email;   
	return  $sum;
     
     }else{
    
      //echo $firstname;
      
     // echo 'non-exists';
     //echo $value;
     //echo '<br>OMG<br>';
     
 
     }

    //$resultingDocuments[$firstname] = $value;
   // echo $value;
}

return $sum;



}

function isadmin($email){


    global $connection;
  //global $email;
  //global $password;
    $query = 'FOR x IN users  RETURN {"id":x._key,"admin":x.admin,"email":x.email}'; 

    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );

    $cursor = $statement->execute();
    $resultingDocuments = array();



 
foreach ($cursor as $check => $value) {
     
     if (strcmp($email, json_decode($value)->email) == 0){
	$sum=json_decode($value)->admin;
 
      //echo '<script>window.location.href = "m.index.php";</script>';
     //echo $email;   
	return  $sum;
     
     }

    //$resultingDocuments[$firstname] = $value;
   // echo $value;
}


}

function  waitforauthentication($mode){

    global $connection;

    $query = 'FOR x IN Company  RETURN {"id":x._key,"authenticate":x.authenticate,"company":x.company,"photo":x.photo,"comment":x.comment}'; 

    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );

    $cursor = $statement->execute();
    $resultingDocuments = array();



 
  foreach ($cursor as $check => $value) {
     
      $pieces = json_decode($value);
      if(strcmp($mode,"desktop")==0){
      $temp='uploads/'.$pieces->photo;
      }else{
      $temp='../uploads/'.$pieces->photo;
      }
     if ($pieces->authenticate==0){
     
     
      echo '<div id="parent_div_1">';
      echo '<div class="panel-group" >';
      echo ' <div class="panel panel-primary" >';
   
      echo '<h2><u>photo:</u></h2><img id="authimg" src='.$temp.'  ></img>';
      echo '<h2><u>name:</u></h2><h3 >'.$pieces->company.'</h3>';
      echo '<h2><u>details:</u></h2><h3 >'.$pieces->comment.'</h3>';
      
      echo ' </div>';
      echo '<button type="button" value="'.$pieces->company.'" class="btn btn-info" onclick="AcceptFunction(value)">Accept</button> <button  type="button" value='.$pieces->company.' class="btn btn-danger" onclick="RemoveFunction(value)">Reject</button>';

      echo ' </div>';
      echo ' </div>';

     }

  
  }


}




function AcceptEnter($company){
 
 
 
  global $connection;
    $query = 'FOR y IN Company RETURN {"company":y.company,"id":y._key,"email":y.email,"authenticate":y.authenticate}';

 
    $statement = new  ArangoStatement(
    $connection,
    array(
        "query"     => $query,
        "count"     => true,
        "batchSize" => 10,
        "sanitize"  => true
	)
    );

    $cursor = $statement->execute();

    $handler = new ArangoDocumentHandler($connection);

 
 
  foreach ($cursor as $check => $value) {

    if(strcmp($company,json_decode($value)->company)==0 && isadmin($_SESSION["email"])){
      $theId=json_decode($value)->id;
    }
  }

   $ok = $handler->get('Company', $theId);
   $ok->authenticate =1;
   $result = $handler->update($ok);

}


?>
