<?php
session_start();
if(!isset( $_SESSION['email'])){
header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <meta charset="utf-8">
    <title>Places Searchbox</title>
   <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 90%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
        
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
        
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }
      


      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }

   </style>
    
  </head>
  
  
    <body>

      <div id="map"></div>
      
	<div class="row">
        <div class="col-sm-6 col-sm-offset-3">
             
		    
                    <input id ="pac-input" type="text" class="controls"  placeholder="Search" name="in">
                    <span class="input-group-addon">
                        <button id="submit" type="submit" class="btn btn-primary btn-block" onclick="ok();" style="background-size: 100%">Confirm
                            <span class="glyphicon glyphicon-ok"></span>
                        </button>  
                    </span>
                
           
        </div>
	</div>

      
      
      
      
    
      
    <script>
    function geocodeLatLng(geocoder, map, infowindow,lat,lng) {
        var input =lat+","+lng;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
           
    

              /*
             document.cookie = "addre = " + results[0].formatted_address ;
             */
             
             //alert(results[0].formatted_address);
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
              
              
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
           
        
        });
        
        
      }
      
    </script>
    
    
  
    
     <script>
    	      function ok(){
    	      window.location = "Enterprising.php";
}

/*
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
*/
    </script>
    
    
 
    
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  
      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 39.074208, lng: 21.824311999999964},
          zoom: 7,
          mapTypeId: 'roadmap'
        });
        
                 
  /*   
   google.maps.event.addListener(map, "rightclick", function(event) {
              
               var lat = event.latLng.lat();
	      var lng = event.latLng.lng();
    
            var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;   
         geocodeLatLng(geocoder, map, infowindow,lat,lng);
       // alert( geocodeLatLng(geocoder, map, infowindow,lat,lng));
                 
   
     //document.cookie = "lat = " + lat ;
                 //document.cookie = "lng = " + lng ;
    //var st='http://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+lng+'&sensor=true';
    //document.cookie = "st = " + st ;
    //document.cookie = "lat = " + lat;
    //document.cookie = "lng = " + lng ;
    
    //document.cookie = "city = " + '.$address.' 
    //alert(readCookie('addre'));
    $('input[name="in"]').val(readCookie('addre'));
    }); 
   
 */   
    

 

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        
        map.controls[google.maps.ControlPosition.TOP].push(input);
         
	
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
	  
          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
         
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));
             
	  
	  
	   
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
           
  
            var address_array = place.formatted_address.split(",");
             var city = address_array[1].split(" ");
             document.cookie = "city = " + city[1] ;
             document.cookie = "faddress = " + address_array;
             
	     //alert( city[1]);
	       doneTheStuff = true;
	       

	    
  
          });
          map.fitBounds(bounds);
          
      
          
        });
        

      }

      

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiPkBv_WTSC0u3oNzYaRvdjGrNHBPelP4&libraries=places&callback=initAutocomplete" async defer></script>
         
  </body>
</html>