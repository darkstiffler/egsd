var map;
var brooklyn = new google.maps.LatLng(40.6743890, -73.9455);

function initialize() {

  var stylez = [
  {
      "stylers": [
        { "hue": "#ff0900" },
        { "saturation": -100 }
      ]
    },{
    }
  ];

  var mapOptions = {
    zoom: 11,
    center: brooklyn,
    mapTypeControlOptions: {
       mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'hiphop']
    }
  };
  map = new google.maps.Map(document.getElementById("map_canvas"),
      mapOptions);

  var styledMapOptions = {
      name: "Hip-Hop"
  }

  var jayzMapType = new google.maps.StyledMapType(
      stylez, styledMapOptions);

  map.mapTypes.set('hiphop', jayzMapType);
  map.setMapTypeId('hiphop');
}