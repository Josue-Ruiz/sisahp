var map;
var markerCluster, marker, i;
var allMarkers = [];
var boxOptions;
var boxText;
var clusterStyles = [{url: '',height: 40,width: 40}];
var locations = [];
var marcadores =[];

$(document).ready(function(){

    function locationData(locationURL, locationCategory, locationImg1,locationImg2,locationImg3, locationTitle, locationAddress, locationCol, locationStarRating, locationRevievsCounter) {
        return ('<div class="map-popup-wrap"><div class="map-popup"><div class="infoBox-close"><i class="fa fa-times"></i></div><div class="map-popup-category">' + locationCategory + '</div>     <div id="destinoGaleria"><div class="slideshow-container" style=" height: 230px; background-image: url('+locationImg1+'); background-size: 100% 100%"><div class="mySlides fade"><div class="numbertext">1 / 3</div><img src="'+locationImg1+'" style="width:100%"><div class="text">Caption Text</div></div><div class="mySlides fade"><div class="numbertext">2 / 3</div><img src="'+locationImg2+'" style="width:100%"><div class="text">Caption Two</div></div><div class="mySlides fade"><div class="numbertext">3 / 3</div><a href="index.html"><img src="'+locationImg3+'" style="width:100%"></a><div class="text">Caption Three</div></div> <a class="prev" onclick="plusSlides(-1)">&#10094;</a><a class="next" onclick="plusSlides(1)">&#10095;</a></div><br></div></div>                  <div class="listing-content fl-wrap"><div style="text-align:center"><span id="dot1" onclick="currentSlide(1)" class="dot"></span> <span id="dot2" onclick="currentSlide(2)" class="dot"></span><span id="dot3" onclick="currentSlide(3)" class="dot"></span><div class="listing-title fl-wrap"><h4><a href=" /obras/detalles/'+locationURL+' ">' + locationTitle + '</a></h4><span class="map-popup-location-info"><i class="fa fa-map-marker"></i>' + locationAddress + '</span><span class="map-popup-location-phone"><i class="fa fa-map-marker"></i>' + locationCol + '</span></div></div></div></div>');
    }

    var mapZoomAttr = $('#map-main').attr('data-map-zoom');
    var mapScrollAttr = $('#map-main').attr('data-map-scroll');
    if (typeof mapZoomAttr !== typeof undefined && mapZoomAttr !== false) {
        var zoomLevel = parseInt(mapZoomAttr);
    }
    else {
        var zoomLevel = 7;
    }
    if (typeof mapScrollAttr !== typeof undefined && mapScrollAttr !== false) {
        var scrollEnabled = parseInt(mapScrollAttr);
    }
    else {
        var scrollEnabled = false;
    }

    function createMap(){

        map = new google.maps.Map(document.getElementById('map-main'), {
            zoom: zoomLevel,
            scrollwheel: scrollEnabled,
            center: new google.maps.LatLng(16.2416066, -92.5770133),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            navigationControl: false,
            streetViewControl: false,
            animation: google.maps.Animation.BOUNCE,
            gestureHandling: 'cooperative',
            styles: [{
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#444444"
                    }]
                }
            ]
        });
        boxText = document.createElement("div");
        boxText.className = 'map-box'
        var currentInfobox;
        boxOptions = {
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
        createobras();
    }

    function createobras()
    {
        for (i = 0; i < marcadores.length; i++) {

            marker = new google.maps.Marker({
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(marcadores[i]['latitud'],marcadores[i]['longitud']),
                icon: "/../images/marcador.png",
                map: map,
                id: marcadores[i]['id']
            });

            allMarkers.push(marker);
            var ib = new InfoBox();
            google.maps.event.addListener(ib, 'domready', function () {
                cardRaining();
            });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {

                return function () {

                    var id = marcadores[0]['id'];
                    var municipio = cut_characters(marcadores[0]['municipio']);
                    var localidad = cut_characters(marcadores[0]['localidad']);
                    var poblacion = cut_characters('Pob. '+marcadores[0]['poblacion']);
                    var folio =     cut_characters('Fol. '+marcadores[0]['folio']);

                    locations.length=0;
                    locations.push([locationData(id, municipio ,"/../images/obra1.jpg","/../images/obra2.jpg","/../images/obra3.jpg", localidad, folio, poblacion, 0, 0), marcadores[0]['latitud'],marcadores[0]['longitud'], 0, "/../images/icono_obras.png"]);
                    ib.setOptions(boxOptions);
                    boxText.innerHTML = locations[0][0];
                    ib.open(map, marker);
                    currentInfobox = marker.id;
                    var latLng = new google.maps.LatLng(locations[0][1], locations[0][2]);
                    map.panTo(latLng);
                    map.panBy(0, -180);
                     google.maps.event.addListener(ib, 'domready', function () {
                        $('.infoBox-close').click(function (e) {
                            ib.close();
                            e.preventDefault();
                        });
                    });
                }
            })(marker, i));

        }
        var options = {
            imagePath: 'images/',
            styles: clusterStyles,
            minClusterSize: 2
        };
        markerCluster = new MarkerClusterer(map, allMarkers, options);
        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
    }

    function getLocation(){

        $.ajax(
        {
            url: '/info-mapa-localidad',
            type: "GET",
            data: {'id':$('#id').val()}
        })
        .done(function(data)
        {
            $.each(data,function(i,val){
                    marcadores.push({'id':val.id,'latitud':parseFloat(val.latitud),'longitud':parseFloat(val.longitud),'folio':val.folio,'municipio':val.municipio,'poblacion':val.pob_total,'localidad':val.nombre});
            });
            createMap();
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            console.log(jqXHR+ajaxOptions+thrownError);
        });
    }

    function cut_characters(valor){
        return (valor.length >= 30) ?  valor.substring(0,25)+'...' : valor;
    }

    getLocation();
});
