var stationList = [
  {"latlng":[35.681382,139.766084],name:"Tokyo Station",adress:"1"},
  {"latlng":[35.630152,139.74044],name:"Shinagawa Station",adress:"2"},
  {"latlng":[35.507456,139.617585],name:"Shin-Yokohama Station",adress:"3"},
  {"latlng":[35.25642,139.154904],name:"Odawara Station",adress:"4"},
];
var infoWnd, mapCanvas;
function initialize() {
  //Creates a map object.
  var mapDiv = document.getElementById("map_canvas");
  mapCanvas = new google.maps.Map(mapDiv);
  mapCanvas.setMapTypeId(google.maps.MapTypeId.ROADMAP);

  //Creates a infowindow object.
  infoWnd = new google.maps.InfoWindow();

  //Mapping markers on the map
  var bounds = new google.maps.LatLngBounds();
  var station, i, latlng;
  for (i in stationList) {
    //Creates a marker
    station = stationList[i];
    latlng = new google.maps.LatLng(station.latlng[0], station.latlng[1]);
    bounds.extend(latlng);
    var marker = createMarker(
      mapCanvas, latlng, station.name, station.adress
    );

    //Creates a sidebar button for the marker
    createMarkerButton(marker);
  }
  //Fits the map bounds
  mapCanvas.fitBounds(bounds);
}
function createMarker(map, latlng, title, direction) {
  //Creates a marker
  var marker = new google.maps.Marker({
    position : latlng,
    map : map,
    title : title,
    direction : direction
  });

  //The infoWindow is opened when the sidebar button is clicked
  google.maps.event.addListener(marker, "click", function(){
    infoWnd.setContent("<strong>" + title + "<br/>" + "</strong>" + direction);
    infoWnd.open(map, marker);
  });
  return marker;
}


function createMarkerButton(marker) {
  //Creates a sidebar button
  var ul = document.getElementById("marker_list");
  var li = document.createElement("li");
  var a = document.createElement("a");
  var title = marker.getTitle();
  li.a.innerHTML = title;
  ul.appendChild(li);


  //Trigger a click event to marker when the button is clicked.
  google.maps.event.addDomListener(li, "click", function(){
    google.maps.event.trigger(marker, "click");
  });
}
google.maps.event.addDomListener(window, "load", initialize);
