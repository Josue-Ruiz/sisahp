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



    var locations = [];
    var marcadores =[];


    $(document).ready(function(){



        function locationData(locationURL, locationCategory, locationImg1,locationImg2,locationImg3, locationTitle, locationAddress, locationCol, locationStarRating, locationRevievsCounter) {
            return (
                '<div class="map-popup-wrap"><div class="map-popup"><div class="infoBox-close"><i class="fa fa-times"></i></div><div class="map-popup-category">' + locationCategory + '</div>     <div id="destinoGaleria"><div class="slideshow-container" style=" height: 230px; background-image: url('+locationImg1+'); background-size: 100% 100%"><div class="mySlides fade"><div class="numbertext">1 / 3</div><img src="'+locationImg1+'" style="width:100%"><div class="text">Caption Text</div></div><div class="mySlides fade"><div class="numbertext">2 / 3</div><img src="'+locationImg2+'" style="width:100%"><div class="text">Caption Two</div></div><div class="mySlides fade"><div class="numbertext">3 / 3</div><a href="index.html"><img src="'+locationImg3+'" style="width:100%"></a><div class="text">Caption Three</div></div> <a class="prev" onclick="plusSlides(-1)">&#10094;</a><a class="next" onclick="plusSlides(1)">&#10095;</a></div><br></div></div>                  <div class="listing-content fl-wrap"><div style="text-align:center"><span id="dot1" onclick="currentSlide(1)" class="dot"></span> <span id="dot2" onclick="currentSlide(2)" class="dot"></span><span id="dot3" onclick="currentSlide(3)" class="dot"></span><div class="listing-title fl-wrap"><h4><a href=" /obras/detalles/'+locationURL+' ">' + locationTitle + '</a></h4><span class="map-popup-location-info"><i class="fa fa-map-marker"></i>' + locationAddress + '</span><span class="map-popup-location-phone"><i class="fa fa-map-marker"></i>' + locationCol + '</span></div></div></div></div>');
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
            //  center: new google.maps.LatLng(16.6679855, -93.2027747),  ,
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
                    position: new google.maps.LatLng(marcadores[i][1],marcadores[i][2]),
                    icon: "/../images/icono_obras.png",
                    map: map,
                    id: marcadores[i][0]
                });

                allMarkers.push(marker);
                var ib = new InfoBox();
                google.maps.event.addListener(ib, 'domready', function () {
                    cardRaining();
                });
                google.maps.event.addListener(marker, 'click', (function (marker, i) {

                    return function () {




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

        function getObras(){

            $.get('http://127.0.0.1:8000/puntos-georeferenciados',function(match){
                marcadores.length=0;
            allMarkers.length=0;
                     $.each(match,function(i,val){

                        marcadores.push([val.id,val.latitud,val.longitud]);

                 });

                createMap();


        });
        }


    getObras();



    document.getElementById('buttonSearch').addEventListener("click", function(){
        buscarObras();
       });

   function buscarObras(){
       var colonia=$('#colonia').val();
       var obra=$('#tipo_obras').val();
       if(colonia=="Todas"&&obra=="Todas"){
        while(locations.length) {
            locations.pop();
        }
        while(allMarkers.length) {
            allMarkers.pop();
        }
        while(marcadores.length){
            marcadores.pop();
        }
           getObras();
       }
       else
       {
        var barra=$('#barrakilometraje').val();
        var flag=0;
        if(barra!='50')
        {
            flag=1;
        }
        var checka=$("#check-a").prop('checked');
        var checkb=$("#check-b").prop('checked');
        getObrasParametrizadas(colonia,obra,barra,flag,checka,checkb);
       }

   }


   function getObrasParametrizadas(col, obr,bar,flg,checka,checkb){
    while(locations.length) {
        locations.pop();
    }
    while(allMarkers.length) {
        allMarkers.pop();
    }
    while(marcadores.length){
        marcadores.pop();
    }
    $.post('http://127.0.0.1:8000/api/obrasparametrizadas',
    {colonia:col,obra:obr},
    function(match){
        marcadores.length=0;
        allMarkers.length=0;
        var distancia=0.0;
        var c=1;
        var lat=0.0; var longi=0.0;
        var longitudvector=match.length;
        lat=16.7543832;
        longi=-93.115707;
        //AQUI MODIFIQUE
        distancia=parseFloat(bar)*0.0089996;
        var masx=longi+distancia;
        var menosx=longi-distancia;
        var masy=lat+distancia;
        var menosy=lat-distancia;
        //0.0089996 equivalencia de un kilometro
        if((checka==true && checkb==true)||(checka==false && checkb==false) ){//Todas las obras
            if(flg==1){
                $.each(match,function(i,val){
                    if((parseFloat(val.latitud)<=(masy))&&(parseFloat(val.latitud)>=(menosy)) && (parseFloat(val.longitud)<=(masx))&&(parseFloat(val.longitud)>=(menosx))){
                        marcadores.push([val.id,val.latitud,val.longitud]);
                        //locations.push([locationData(val.id, val.tipo_obra ,val.imagen_principal,val.imagen_secundaria,val.imagen_terciaria, val.titulo, val.descripcion, val.colonia, val.starrating, val.viewscount), val.latitud, val.longitud, c, "/../images/icono_obras.png"]);
                    c++;
                    }

                });
            }
            else{
                    $.each(match,function(i,val){
                        marcadores.push([val.id,val.latitud,val.longitud]);
                        //locations.push([locationData(val.id, val.tipo_obra ,val.imagen_principal,val.imagen_secundaria,val.imagen_terciaria, val.titulo, val.descripcion, val.colonia, val.starrating, val.viewscount), val.latitud, val.longitud, c, "/../images/icono_obras.png"]);
                    c++;
                        /*locations.push([locationData(val.id, val.tipo_obra ,'/../images/all/1.jpg','/../images/all/2.jpg','/../images/all/3.jpg',val.video, val.titulo,val.ubicacion,val.colonia, "5", "27"), (val.latitud), (val.longitud), c, "/../images/marker.png"]);*/

                    });
            }
        }
        else{
            if(checka==true){//Obras en proceso
                if(flg==1){
                    $.each(match,function(i,val){

                        if((parseFloat(val.latitud)<=(masy))&&(parseFloat(val.latitud)>=(menosy))&&(parseFloat(val.longitud)<=(masx))&&(parseFloat(val.longitud)>=(menosx))&&(val.estado_obra==0)){
                            //locations.push([locationData(val.id, val.tipo_obra ,val.imagen_principal,val.imagen_secundaria,val.imagen_terciaria, val.titulo, val.descripcion, val.colonia, val.starrating, val.viewscount), val.latitud, val.longitud, c, "/../images/icono_obras.png"]);
                            marcadores.push([val.id,val.latitud,val.longitud]);
                    c++;
                        }
                    });
                }
                else{
                        $.each(match,function(i,val){
                            if(val.estado_obra==0){
                                //locations.push([locationData(val.id, val.tipo_obra ,val.imagen_principal,val.imagen_secundaria,val.imagen_terciaria, val.titulo, val.descripcion, val.colonia, val.starrating, val.viewscount), val.latitud, val.longitud, c, "/../images/icono_obras.png"]);
                                marcadores.push([val.id,val.latitud,val.longitud]);
                    c++;
                            }

                        });
                }
            }
            else{//Obras terminadas
                if(flg==1){
                    $.each(match,function(i,val){
                        if((parseFloat(val.latitud)<=(masy))&&(parseFloat(val.latitud)>=(menosy))&&(parseFloat(val.longitud)<=(masx))&&(parseFloat(val.longitud)>=(menosx))&&(val.estado_obra==1)){
                           // locations.push([locationData(val.id, val.tipo_obra ,val.imagen_principal,val.imagen_secundaria,val.imagen_terciaria, val.titulo, val.descripcion, val.colonia, val.starrating, val.viewscount), val.latitud, val.longitud, c, "/../images/icono_obras.png"]);
                           marcadores.push([val.id,val.latitud,val.longitud]);
                    c++;

                        }
                    });
                }
                else{
                        $.each(match,function(i,val){
                            if(val.estado_obra==1){
                                marcadores.push([val.id,val.latitud,val.longitud]);
                            	//locations.push([locationData(val.id, val.tipo_obra ,val.imagen_principal,val.imagen_secundaria,val.imagen_terciaria, val.titulo, val.descripcion, val.colonia, val.starrating, val.viewscount), val.latitud, val.longitud, c, "/../images/icono_obras.png"]);
                                c++;

                            }
                        });
                }
            }
        }
   createMap();
});
}

    });


function limitarCaracteres(){
$( ".ubication-index-h3 a" ).each(function( index ) {
  //console.log( index + ": " + $( this ).text() );
  let viejoTitulo = $(this).text();
  let nuevoTitulo = "";
  for (let i = 0; i < 48; i++) {
      nuevoTitulo += viejoTitulo.charAt(i);
  }
  $(this).text(nuevoTitulo + "...");
});

$( ".ubication-index p" ).each(function( index ) {
  //console.log( index + ": " + $( this ).text() );
  let viejoTitulo = $(this).text();
  let nuevoTitulo = "";
  for (let i = 0; i < 48; i++) {
      nuevoTitulo += viejoTitulo.charAt(i);
  }
  $(this).text(nuevoTitulo + "...");
});

$( ".ubication-index a" ).each(function( index ) {
  //console.log( index + ": " + $( this ).text() );
  let viejoTitulo = $(this).text();
  let nuevoTitulo = "";
  for (let i = 0; i < 49; i++) {
      nuevoTitulo += viejoTitulo.charAt(i);
  }
  $(this).text(nuevoTitulo + "...");
});

$( ".widget-posts-descr a" ).each(function( index ) {
  //console.log( index + ": " + $( this ).text() );
  let viejoTitulo = $(this).text();
  let nuevoTitulo = "";
  for (let i = 0; i < 100; i++) {
      nuevoTitulo += viejoTitulo.charAt(i);
  }
  $(this).text(nuevoTitulo + "...");
});
}
limitarCaracteres();
