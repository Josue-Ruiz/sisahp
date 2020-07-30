@extends('layouts.master')


@section('content')
        <div class="col-md-12 col-sm-12 col-xs-12">
            @include('components.alerts.all')
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Jurisdicciones <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                   <li>
                        <a href="{{ route('jurisdicciones.create') }}"><button class="btn btn-sm btn-success" type="button"><i class="fa fa-plus"></i> Agregar</button></a>
                   </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                  @if(count($registers)>0)

                    <div class="col-xs-4" >                 
                        <ul class="nav nav-tabs tabs-left">
                            @foreach($registers as $key=>$item)
                                <li class=""><a href="#tab-panel-{{$item->id}}" data-toggle="tab" aria-expanded="true">{{$item->nombre}}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-xs-8">
                    <div class="tab-content" id="tab-scroll">
                   
                        @foreach($registers as $key=>$item)
                    
                        <div class="tab-pane" id="tab-panel-{{$item->id}}">

                        @php $municipalities = \Content::get_municipalities($item->id); @endphp
                            <p class="lead">{{$item->nombre}} - {{ count($municipalities)}}  </p>
                            <span>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></button>
                                    <ul role="menu" class="dropdown-menu">
                                    <li><a href="{{ route('jurisdicciones.edit',$item->id) }}">Editar</a></li>
                                    <li><a tabindex="0" data-toggle="modal" data-target="#modal-confirm-delete-{{$item->id}}"> Eliminar</a></li>
                                    <li><a href="{{ route('municipios-por-jurisdiccion.show',$item->id) }}">Agregar municipio</a></li>
                                    </ul>
                                </div>
                            </span>
                            @include('components.alerts.confirm',['ruta'=>route('jurisdicciones.destroy',$item->id),'id'=>$item->id])
                            <ul class="list-unstyled timeline">

                        @foreach($municipalities as $key=>$item)
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a  class="tag"><span>{{$key+1}}</span></a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title"><a>{{$item->nombre}}</a> </h2>
                                    </div>
                                </div>
                            </li>
                        @endforeach     

                        </ul>
                         
                        </div>
                      
                        @endforeach
                    
                        </div>      
                    </div>
                  
            @else 

            
                <div class="col-md-12 col-lg-12 col-xl-12">
            <div class=" profile-responsive ">
                <div class="dropdown-menu-header">
                    <div class="dropdown-menu-header-inner ">
                        <div class="menu-header-content">
                            <div class="avatar-icon-wrapper mr-2 avatar-icon-xl">
                                <img  src="{{ asset('images/empty/search_empty.png') }}" alt="" > 
                            </div>
                            <div>
                                <h1 class="text-search-results">No se encontraron resultados.</h1>
                              

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

                <div class="clearfix"></div>
                </div>
            </div>
        </div>
            
@endsection
