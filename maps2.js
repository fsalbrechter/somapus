Places = new Meteor.Collection("places");
if (Meteor.isClient) {
  Deps.autorun(function() {
    gmaps.clearMarker();
    var pos = Places.find({},{sort: {date: -1}});
    pos.forEach(function (position) {
      console.log("add " + position.lat + position.lng);
      gmaps.addMarker(position.lat, position.lng);
    });
  
    
  });
  
  Template.map.rendered = function() {
      if(!this.rendered){
        console.log("init");
        gmaps.initialize();
        gmaps.clearMarker();
        var pos = Places.find({},{sort: {date: -1}, /*limit:1*/});
        pos.forEach(function (position) {
          gmaps.addMarker(position.lat, position.lng);
        });
        this.rendered = true;
      }
  }
  
}

if (Meteor.isServer) {
  Meteor.startup(function () {
    // code to run on server at startup
  });
}
