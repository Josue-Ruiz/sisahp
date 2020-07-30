@extends ('layouts.home')



@section ('contenido')


   <div id="wrapper">
                <div class="content">


                    <!-- Map -->
                    <div class="map-container column-map left-pos-map">
                        <div id="map-main"></div>
                    </div>

                    <!-- Map end -->
                    <!--col-list-wrap -->
                    <div class="col-list-wrap right-list">

                        <div class="listsearch-options fl-wrap" id="lisfw" >
                            <div class="container">

                                <div class="listsearch-header fl-wrap">
                                    <h3>Fuente de la Información : <span>Secretaría de Salud. </span></h3>

                                </div>



                                <!-- listsearch-input-wrap  -->
                                <div class="listsearch-input-wrap fl-wrap">

                                    <div class="listsearch-input-item">
                                        <i class="mbri-key single-i"></i>
                                        <input type="text" placeholder="Obras" id="reservation" readonly/>
                                    </div>

                                    <div class="listsearch-input-item">
                                        <select data-placeholder="Location" id="jurisdiccion" class="select-css">
                                        @foreach($registers as $item)
                                             <option value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                        @php
                                            $municipalities = array();
                                            $municipalities =  count($registers)>0 ? \Content::get_municipalities($registers[0]->id) : array();
                                        @endphp

                                    <div class="listsearch-input-item" >
                                        <select  id="municipio" class="select-css" >
                                        @foreach($municipalities as $items)
                                             <option value="{{$items->id_municipio}}">{{$items->nombre}}</option>
                                        @endforeach

                                        </select>
                                    </div>

                                    <div class="listsearch-input-text">
                                        <div class="listsearch-input-item" >
                                            <select  id="tipo" class="select-css" >

                                                <option value="1">Cloro Residual</option>
                                                <option value="2">Vibrio Cholerae</option>
                                                <option value="3">Ambos</option>

                                            </select>
                                        </div>

                                        <div class="listsearch-input-item" >
                                            <button id="btn-search" class="button fs-map-btn">Buscar </button>
                                        </div>

                                    </div>





                                    <div class="clearfix"></div>

                                    <div class="search-points" id="search-point"></div>

                                </div>
                                <!-- listsearch-input-wrap end -->
                            </div>
                        </div>
                        <!-- list-main-wrap-->
                        <div class="list-main-wrap fl-wrap card-listing">
                            <a class="custom-scroll-link back-to-filters btf-r" href="#lisfw"><i class="fa fa-angle-double-up"></i><span>Volver a la busqueda</span></a>
                            <div id="containerPreviews" class="container">


                                <div class="clearfix"></div>
                                <!-- listing-item -->


                            </div>
                            <!-- <a class="load-more-button" href="/obras/detalles/todas">Cargar mas... <i class="fa fa-circle-o-notch"></i> </a> -->
                        </div>
                        <!-- list-main-wrap end-->
                    </div>
                    <!--col-list-wrap end -->
                    <div class="limit-box fl-wrap"></div>
                    <!--section -->

                    <!--section end -->
                </div>
                <!--content end -->
    </div>
            <!-- wrapper end -->

@endsection

@push('extra_js')


    <script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/map_geo.js')}}"></script>

    <script src="{{ asset('js/custom.min.js') }}"></script>

@endpush

@push('extra_css')

    <link href="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush




