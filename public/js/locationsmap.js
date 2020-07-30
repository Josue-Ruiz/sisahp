$(document).ready(function(){
var marker;          
var coords = {};   


initMap = function () 
{
  coords = {lng: -93.1081669, lat: 16.7544356};
  setMapa(coords);           
}

initMapEdit = function(){
    
  coords = {lng: document.getElementById("longitud").value, lat: document.getElementById("latitud").value};
  setMapa(coords);
}


function setMapa (coords)
{   
      var map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 13,
        center:new google.maps.LatLng(coords.lat,coords.lng),

      });

      marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(coords.lat,coords.lng),

      });

      marker.addListener('click', toggleBounce);
      
      marker.addListener( 'dragend', function (event)
      {
        document.getElementById("latitud").value = this.getPosition().lat();
        document.getElementById("longitud").value = this.getPosition().lng();
      });
}

function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
});