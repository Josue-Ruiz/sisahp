var map;
var markerCluster, marker, i;
var allMarkers = [];
var boxOptions;
var boxText;
var clusterStyles = [{
        url: '',
        height: 40,
        width: 40
    }];

var markerIcon = {
    anchor: new google.maps.Point(22, 16),
    url: 'images/marker.png',
}

var markerIcon2 = {
    anchor: new google.maps.Point(22, 16),
    url: 'images/marker2.png',
}

var markerIcon3 = {
    anchor: new google.maps.Point(22, 16),
    url: 'images/marker3.png',
}

var locations = [
    
];

$(document).ready(function(){
    
    function singleMap() {
        
     
           var lng=  $('#singleMap').data('longitude');
           var  lat =$('#singleMap').data('latitude');

        var single_map = new google.maps.Map(document.getElementById('singleMap'), {
            zoom: 14,
            center: new google.maps.LatLng(lat, lng),
            scrollwheel: false,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            navigationControl: false,
            streetViewControl: false,
            styles: [{
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{
                    "color": "#f2f2f2"
                }]
            }]
        });
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            map: single_map,
            title: 'Ubicacion',
			icon: "/../images/icono_obras.png"
        });
        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, single_map);
        function ZoomControl(controlDiv, single_map) {
            zoomControlDiv.index = 1;
            single_map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
            controlDiv.style.padding = '5px';
            var controlWrapper = document.createElement('div');
            controlDiv.appendChild(controlWrapper);
            var zoomInButton = document.createElement('div');
            zoomInButton.className = "mapzoom-in";
            controlWrapper.appendChild(zoomInButton);
            var zoomOutButton = document.createElement('div');
            zoomOutButton.className = "mapzoom-out";
            controlWrapper.appendChild(zoomOutButton);
            google.maps.event.addDomListener(zoomInButton, 'click', function () {
                single_map.setZoom(single_map.getZoom() + 1);
            });
            google.maps.event.addDomListener(zoomOutButton, 'click', function () {
                single_map.setZoom(single_map.getZoom() - 1);
            });
        }
    }
 

singleMap();


});