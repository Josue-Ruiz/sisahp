var map;
var markerCluster, marker, i;
var allMarkers = [];
var boxOptions;
var boxText;
var clusterStyles = [{url: '',height: 40,width: 40}];
var locations = [];
var marcadores =[];
var jurisdiccion;
var action;

$(document).ready(function(){

    $("#jurisdiccion").on("change", function(e)
    {
        if($('#jurisdiccion').val() != 0){

          $('#municipio').attr("disabled", true);
          $.ajax({
              url: '/municipios-por-jurisdiccion',
              type: "GET",
              data: { jurisdiccion:$('#jurisdiccion').val() }
          })
          .done(function(data)
          {
            var values = JSON.parse(data);

            $('#municipio').empty();
            $.each(values,function(i,val){
                $('#municipio').append('<option value="'+val.id_municipio+'" > '+val.nombre+'  </option>');
            });
            $('#municipio').attr("disabled", false);

          })
          .fail(function(jqXHR, ajaxOptions, thrownError){
              console.log(jqXHR);
          });
        }
    });

    $('#btn-search').click(function(e)
    {
        marcadores.length=0;
        allMarkers.length=0;
        locations.length=0;

        switch(parseInt($('#tipo').val()))
        {
            case 1:
                action = 1;
                var dates = $('#municipio').val()==0 ? {} : {'municipio':$('#municipio').val(),'intevals-dates':$('#reservation').val()};
                var url = '/puntos-georeferenciados';
                getpoints(url,dates);
                break;
            case 2:
                action = 2;
                var dates = $('#jurisdiccion').val()==0 ? {} : {'jurisdiccion':$('#jurisdiccion').val(),'intevals-dates':$('#reservation').val()};
                var url = '/puntos-georeferenciados-vibrio';
                getpoints(url,dates);
                break;
            case 3:
                jurisdiccion = $('#jurisdiccion').val();
                action = 3;
                var dates = $('#municipio').val()==0 ? {} : {'municipio':$('#municipio').val(),'intevals-dates':$('#reservation').val()};
                var url = '/puntos-georeferenciados';
                getpoints(url,dates);
                break;
            default:
                console.log('Ocurrio un Error en la solicitud, contactar a soporte.');
        }
    });

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
    function createMap(opcion)
    {
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
        styles: [{"featureType": "administrative","elementType": "labels.text.fill",
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
        function ZoomControl(controlDiv, map)
        {
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
        if(opcion != -1){ drawpoints(); }

    }

    function drawpoints()
    {
            for (i = 0; i < marcadores.length; i++) {

                marker = new google.maps.Marker
                ({
                    animation: google.maps.Animation.DROP,
                    position: new google.maps.LatLng(marcadores[i]['latitud'],marcadores[i]['longitud']),
                    icon: marcadores[i]['icono'],
                    map: map
                });

                allMarkers.push(marker);
                var ib = new InfoBox();

                google.maps.event.addListener(marker, 'click', (function (marker, i) {


                    return function () {

                        if (typeof marcadores[i]['valor'] !== 'undefined') {

                            var lat         = marcadores[i]['latitud'];
                            var long        = marcadores[i]['longitud'];
                            var id          = marcadores[i]['id'];
                            var id_notif    = marcadores[i]['id_notif'];
                            var cant        = marcadores[i]['cant'];
                            var valor       = cut_characters('Valor: '+ marcadores[i]['valor']);
                            var municipio   = cut_characters(marcadores[i]['municipio']);
                            var localidad   = cut_characters(marcadores[i]['localidad']);
                            var fecha       = cut_characters('Fecha: '+marcadores[i]['fecha']);
                            var direccion   = cut_characters('Dirección: '+marcadores[i]['direccion']);

                            $.ajax(
                                {
                                    url: '/puntos-georeferenciados',
                                    type: "GET",
                                    data: {'id':id,'id_notif':id_notif,'cant':cant,'municipio':municipio,'localidad':localidad,'fecha':fecha,'direccion':direccion,'intevals-dates':$('#reservation').val(),'valor':valor}
                                })
                                .done(function(data)
                                {

                                     locations.length=0;
                                     locations.push([data.caja]);
                                     ib.setOptions(boxOptions);
                                     boxText.innerHTML = locations[0];
                                     ib.open(map, marker);
                                     currentInfobox = marker.id;
                                     var latLng = new google.maps.LatLng(lat, long);
                                     map.panTo(latLng);
                                     map.panBy(0, -180);
                                     google.maps.event.addListener(ib, 'domready', function (e) {
                                        $('.infoBox-close').click(function (e) {
                                            ib.close();
                                            e.preventDefault();
                                        });
                                    });
                                })
                                .fail(function(jqXHR, ajaxOptions, thrownError)
                                {
                                    console.log(jqXHR + ajaxOptions + thrownError);
                                });

                            }else{

                                var lat         = marcadores[i]['latitud'];
                                var long        = marcadores[i]['longitud'];
                                var fecha       = 'Fecha: ' +marcadores[i]['fecha'];

                                ib.setOptions(boxOptions);
                                boxText.innerHTML = marcadores[i]['caja'];
                                ib.open(map, marker);
                                currentInfobox = marker.id;
                                var latLng = new google.maps.LatLng(lat, long);
                                map.panTo(latLng);
                                map.panBy(0, -180);
                                google.maps.event.addListener(ib, 'domready', function (e) {
                                $('.infoBox-close').click(function (e) {
                                    ib.close();
                                    e.preventDefault();
                                });
                                });
                            }
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

    async function getpoints(url,dates)
    {

        $.ajax({
                url: url,
                type: "GET",
                data: dates,
                beforeSend: function()
                {
                    $('#btn-search').prop('disabled',true);
                }
            })
            .done(function(data)
            {
                switch(action)
                {
                    case 1:
                        $.each(data,function(i,val){marcadores.push(val);});
                        $('#search-point').empty().append('<label> '+data.length+' Registros encontrados </label><br><img src="/../images/map.png" alt=""> <div class="row"><div class="col-md-3">  <h1><span class="green fa fa-map-marker"></span>Dentro de norma.</h1></div><div class="col-md-3">  <h1><span class="red fa fa-map-marker"></span>Arriba de norma.</h1></div><div class="col-md-3">  <h1><span class="yellow fa fa-map-marker"></span>Debajo de norma.</h1></div><div class="col-md-3">  <h1><span class="grey fa fa-map-marker"></span>Sin servicio.</h1></div> <div class="col-md-12">  <h1><span class="blue blue-top fa fa-map-marker"></span>Mas de un registro.</h1></div> </div>');
                        createMap();
                        break;
                    case 2:
                        $.each(data,function(i,val){marcadores.push({'id':val.id,'latitud':parseFloat(val.latitud),'longitud':parseFloat(val.longitud),'icono':val.icono,'resultado':val.resultado,'lugar':val.lugar,'fecha':val.fecha,'caja':val.caja});});
                        $('#search-point').empty().append('<label> '+data.length+' Registros encontrados </label><br><img src="/../images/map.png" alt=""> <div class="row"><div class="col-md-4">  <h1><span class="grey fa fa-map-marker"></span>Ausencia.</h1></div><div class="col-md-4">  <h1><span class="naranja fa fa-map-marker"></span>Presencia.</h1></div> <div class="col-md-4">  <h1><span class="lila fa fa-map-marker"></span>Mas de un registro.</h1></div></div>');
                        createMap();
                        break;
                    case 3:
                        $.each(data,function(i,val){marcadores.push(val);});
                        getVibrio();
                        break;
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                console.log(jqXHR+ajaxOptions+thrownError);
            })
            .complete(function(xhr, status){
                $('#btn-search').prop('disabled',false);
            });
    }

    function getVibrio(){

        var dates = jurisdiccion==0 ? {} : {'jurisdiccion':jurisdiccion,'intevals-dates':$('#reservation').val()};

         $.ajax({
            url: '/puntos-georeferenciados-vibrio',
            type: "GET",
            data: dates
        })
        .done(function(data)
        {
            $.each(data,function(i,val){
                marcadores.push({'id':val.id,'latitud':parseFloat(val.latitud),'longitud':parseFloat(val.longitud),'icono':val.icono,'resultado':val.resultado,'lugar':val.lugar,'fecha':val.fecha,'caja':val.caja});
            });
            $('#search-point').empty().append('<label> '+marcadores.length+' Registros encontrados </label><br><img src="/../images/map.png" alt=""> <div class="row"><div class="col-md-3">  <h1><span class="green fa fa-map-marker"></span>Dentro de norma.</h1></div><div class="col-md-3">  <h1><span class="red fa fa-map-marker"></span>Arriba de norma.</h1></div><div class="col-md-3">  <h1><span class="yellow fa fa-map-marker"></span>Debajo de norma.</h1></div><div class="col-md-3">  <h1><span class="grey fa fa-map-marker"></span>Sin servicio.</h1></div> <div class="col-md-12">  <h1><span class="blue blue-top fa fa-map-marker"></span>Mas de un registro.</h1></div> </div><br><div class="row"><div class="col-md-4">  <h1><span class="grey fa fa-map-marker"></span>Ausencia.</h1></div><div class="col-md-4">  <h1><span class="naranja fa fa-map-marker"></span>Presencia.</h1></div> <div class="col-md-4">  <h1><span class="lila fa fa-map-marker"></span>Mas de un registro.</h1></div></div>');
            createMap();
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            console.log(jqXHR+ajaxOptions+thrownError);
        });
    }
    function cut_characters(valor)
    {
        return (valor.length >= 40) ?  valor.substring(0,33)+'...' : valor;
    }
    createMap(-1);
});
