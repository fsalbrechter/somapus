gmaps = {
    // map object
    map: null,
 
    // google markers objects
    marker: null,
    markersArray: [],
    
    
    errorCallback: function (e) {
        console.log(e)

    }, 
    successCallback: function (position) {
      console.log(position);
      gmaps.map.panTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
      var place = Places.findOne({name:localStorage.user_id});
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;
      if (place) {
        Places.update({_id:place._id}, {lat: lat, lng: lng, date : new Date(), name:localStorage.user_id});
      } else {
        Places.insert({lat: lat, lng: lng, date : new Date(), name:localStorage.user_id})
      }
    }, 
    
    initialize: function () {
      var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
      var mapOptions = {
        zoom: 20,
        center: myLatlng
      }
      gmaps.map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

      gmaps.marker = new google.maps.Marker({
          //position: myLatlng,
          map: gmaps.map,
      });
      var GeoMarker = new GeolocationMarker(gmaps.map);
      
      document.getElementById("result").innerHTML="Hi " + localStorage.user_id;
      if (navigator && navigator.geolocation) {
        var watchId = navigator.geolocation.watchPosition(this.successCallback, 
                                                          this.errorCallback,
                          {enableHighAccuracy:true,timeout:60000,maximumAge:0});

        } else {
          console.log('Geolocation is not supported');
        }
    },
    addMarker: function(lat, lng) {
      if (gmaps.map) {
            var gMarker = new google.maps.Marker({
                position: new google.maps.LatLng(lat,lng),
                map: gmaps.map,
            });
            gmaps.markersArray.push(gMarker);
          }
    },
    clearMarker: function() {
      for (var i = 0; i < gmaps.markersArray.length; i++ ) {
        gmaps.markersArray[i].setMap(null);
      }
      gmaps.markersArray.length = 0;
      
    },
 
    moveMarker: function(event) {
      gmaps.marker.setPosition(event.latLng);
    },
    
    moveMarker2: function(lat, lng) {
      if (gmaps.map) {
        gmaps.marker.setPosition(new google.maps.LatLng(lat,lng));
        console.log("moveMarker2" + lat + " " + lng);
      }
    }
}