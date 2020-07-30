@extends('layouts.master')

@push('extra_css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/color.css')}}">
<link type="text/css" rel="stylesheet" href="{{ asset('css/mapa.css')}}">
@endpush

@section('content')
<div class="content">
<input type="hidden" id="id" value="{{ $id }}">
    <div class="map-container column-map left-pos-map">
        <div id="map-main"></div>                                          
    </div>
</div>

@endsection

@push('extra_js')  


<script type="text/javascript" src="{{ asset('js/plugins.js')}}"></script>   
<script type="text/javascript" src="{{ asset('js/scripts.js')}}"></script>   
      
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDc2eAUQZOh3CpsAn0ZOa9e-H-MT2MIem8"></script> 
     
<script type="text/javascript" src="{{ asset('js/map_infobox.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/markerclusterer.js')}}"></script> 
<script type="text/javascript" src="{{ asset('js/map.js') }}"></script>    
<script type="text/javascript" src="{{ asset('js/slide.js')}}"></script>
@endpush