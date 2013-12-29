<? require ("functions.php"); $userId = get_user_id();  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>So map us!</title>
    <style>
      body,html {height:100%}
      #map {width:100%;height:100%;}
    </style>
	<script src="https://www.google.com/jsapi"></script>
  <script src="mapstyle.js"></script>
	<script>
    google.load('jquery', '1.3.1');
	</script>
  <script src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
	<script src="js/geolocationmarker-compiled.js"></script>
  <script>
    var userId = "<? echo $userId ?>"
    var map; 
	  var markersArray = [];
	  var currPosition;
    
    function initGeolocation() {
      if (navigator && navigator.geolocation) {
        var watchId = navigator.geolocation.watchPosition(successCallback, errorCallback,
          {
            enableHighAccuracy:true,
            timeout:60000,
            maximumAge:0
          });
          
          
          
          setInterval(function(){ clearOverlays(); updateMarkers(); },5000);
          
      } else {
          console.log('Geolocation is not supported');
      }
    }
    
    function clearOverlays() {
      for (var i = 0; i < markersArray.length; i++ ) {
        markersArray[i].setMap(null);
      }
      markersArray.length = 0;
    }

	  function updateMarkers() {
      var data = {
          SomeID: "18",
          Utc: null,
          Flags: "324"
      };
	    $.getJSON( "show_room.php", data, function(data) {
			  var items = [];
			  var i = 0;
			  $.each( data, function(key, val) {
				var myLatlng = new google.maps.LatLng(val.X, val.Y);
        if(map == undefined) {
                var myOptions = {
                  zoom: 15,
                  styles: mapStyles,
                  center: myLatlng,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById("map"), myOptions);
                      var GeoMarker = new GeolocationMarker(map);
              }
        
        
        var marker = new google.maps.Marker({
				      position: myLatlng,
				      map: map,
				      title: key
				  });
				markersArray[i++] = marker;
				});	 
			});	
	  }
     
    function errorCallback() {}

	  function updatePosition( position ){
	    currPosition = position;
	  }
	  
    function sendUpdates() {
			var lat = currPosition.coords.latitude;
	    var lng = currPosition.coords.longitude;
      
      $.ajax({
        type: "GET",
        url: "update_room.php",
        data: { userId: userId, lat: lat, lng: lng }
      });
    }

    function successCallback(position) {
	    updatePosition(position);
      var myLatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		  sendUpdates();
		
      if(map == undefined) {
        var myOptions = {
          zoom: 15,
          styles: mapStyles,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("map"), myOptions);
	      var GeoMarker = new GeolocationMarker(map);
      }
    }


    </script>
  </head>
  <body onload="javascript:initGeolocation()">
    Welcome  <? echo get_user_id(); ?>!
    <div id="map">
    </div>
  </body>
</html>
