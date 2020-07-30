
var map;
var myLatLng;
var locations=  [];
$(document).ready(function(){
  
   
   searchGirls();
   createMap();
   function locationData(locationURL, locationCategory, locationImg1,locationImg2,locationImg3,locationVid1, locationTitle, locationAddress, locationPhone, locationStarRating, locationRevievsCounter) {
    return ('<div class="map-popup-wrap"><div class="map-popup"><div class="infoBox-close"><i class="fa fa-times"></i></div><div class="map-popup-category">' + locationCategory + '</div>     <div id="destinoGaleria"><div class="slideshow-container" style=" height: 230px; background-image: url('+locationImg1+'); background-size: 100% 100%"><div class="mySlides fade"><div class="numbertext">1 / 4</div><img src="'+locationImg1+'" style="width:100%"><div class="text">Caption Text</div></div><div class="mySlides fade"><div class="numbertext">2 / 4</div><img src="'+locationImg2+'" style="width:100%"><div class="text">Caption Two</div></div><div class="mySlides fade"><div class="numbertext">3 / 4</div><a href="index.html"><img src="'+locationImg3+'" style="width:100%"></a><div class="text">Caption Three</div></div><div class="mySlides fade"><div class="numbertext">4 / 4</div><video controls><source src="'+locationVid1+'" type="video/mp4"></video></div> <a class="prev" onclick="plusSlides(-1)">&#10094;</a><a class="next" onclick="plusSlides(1)">&#10095;</a></div><br></div></div>                  <div class="listing-content fl-wrap"><div style="text-align:center"><span id="dot1" onclick="currentSlide(1)" class="dot"></span> <span id="dot2" onclick="currentSlide(2)" class="dot"></span><span id="dot3" onclick="currentSlide(3)" class="dot"></span><span id="dot4" onclick="currentSlide(4)" class="dot"></span><div class="listing-title fl-wrap"><h4><a href=' + locationURL + '>' + locationTitle + '</a></h4><span class="map-popup-location-info"><i class="fa fa-map-marker"></i>' + locationAddress + '</span><span class="map-popup-location-phone"><i class="fa fa-phone"></i>' + locationPhone + '</span></div></div></div></div>');
    }

   var mapZoomAttr = $('#map-main').attr('data-map-zoom');
   var mapScrollAttr = $('#map-main').attr('data-map-scroll');
   if (typeof mapZoomAttr !== typeof undefined && mapZoomAttr !== false) {
       var zoomLevel = parseInt(mapZoomAttr);
   }
   else {
       var zoomLevel = 10;
   }
   if (typeof mapScrollAttr !== typeof undefined && mapScrollAttr !== false) {
       var scrollEnabled = parseInt(mapScrollAttr);
   }
   else {
       var scrollEnabled = false;
   }
$('.nextmap-nav').on("click", function (e) {
    console.log("Desde next"+locations.length);
            e.preventDefault();
            map.setZoom(14);
            var index = currentInfobox;
            if (index + 1 < allMarkers.length) {
                google.maps.event.trigger(allMarkers[index + 1], 'click');
            }
            else {
                google.maps.event.trigger(allMarkers[0], 'click');
            }

        });
        $('.prevmap-nav').on("click", function (e) {

            e.preventDefault();
            map.setZoom(14);
            if (typeof (currentInfobox) == "undefined") {
                google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
            }
            else {
                var index = currentInfobox;
                if (index - 1 < 0) {
                    google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
                }
                else {
                    google.maps.event.trigger(allMarkers[index - 1], 'click');
                }
            }
        });
        var boxText = document.createElement("div");
        boxText.className = 'map-box'
        var currentInfobox;
        var boxOptions = {
            content: boxText,
            disableAutoPan: true,
            alignBottom: true,
            maxWidth: 300,
            pixelOffset: new google.maps.Size(-140, -45),
            zIndex: null,
            boxStyle: {
                width: "260px"
            },
            closeBoxMargin: "0",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: false,
        };
        var markerCluster, marker, i;
        var allMarkers = [];
        var clusterStyles = [{
            url: '',
            height: 40,
            width: 40
        }];
    function createMap()
    {
         map = new google.maps.Map(document.getElementById('map-main'),{
            zoom: 12,
            center: new google.maps.LatLng(40.7, -73.87),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            panControl: true,
            navigationControl: true,
            streetViewControl: true,
            animation: google.maps.Animation.BOUNCE,
            styles: [{
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#444444"
                    }]
                }
            ]

        
        });

         marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
        });
    }
    var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, map);
        function ZoomControl(controlDiv, map) {
            zoomControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
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
                map.setZoom(map.getZoom() + 1);
            });
            google.maps.event.addDomListener(zoomOutButton, 'click', function () {
                map.setZoom(map.getZoom() - 1);
            });
        }




var single_map = new google.maps.Map(document.getElementById('singleMap'), {
            zoom: 14,
            center: myLatLng,
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
       
    function createMarker(latlng,icn,name){
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: icn,
            title: name
        });
    }
  
    function nearbySearch(myLatLng,type){
        var request = {
            location: myLatLng,
            radius: '1500',
            types: [type]
          };
    
    }

    function searchGirls(){
        $.get('http://127.0.0.1:8000/api/obras',function(match){
            
         locations.push([locationData('listing-single2.html', 'Hotels', 'images/all/1.jpg','images/all/2.jpg','images/all/3.jpg','video/1.mp4', 'Luxary Hotel-Spa', "1327 Intervale Ave, Bronx, NY ", "+38099231212", "5", "27"), 40.73956781, -73.98726866, 10, 'images/marker.png']),
              $.each(match,function(i,val){
                var glatval=val.lat;
                var glngval=val.lng;
                var gname=val.nombre;
                var GLatLng = new google.maps.LatLng(glatval, glngval);
                var gicn= 'images/marker.png';
                createMarker(GLatLng,gicn,gname);
             
            });
        });
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(locations[i][1],
                    locations[i][2]),
                icon: locations[i][4],
                id: i
            });
            allMarkers.push(marker);
            var ib = new InfoBox();
            google.maps.event.addListener(ib, 'domready', function () {
                cardRaining();
            });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    ib.setOptions(boxOptions);
                    boxText.innerHTML = locations[i][0];
                    ib.open(map, marker);
                    currentInfobox = marker.id;
                    var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);
                    map.panTo(latLng);
                    map.panBy(0, -180);
                    google.maps.event.addListener(ib, 'domready', function () {
                        $('.infoBox-close').click(function (e) {
                            e.preventDefault();
                            ib.close();
                        });
                    });
                }
            })(marker, i));
        }
    }
    
      
});
