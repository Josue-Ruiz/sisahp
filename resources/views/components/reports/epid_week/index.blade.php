@extends('layouts.master')

@push('extra_css')
    <link href="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush

@push('extra_js')
<script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush


@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Reportes | Semanas Epidemiológicas<small></small></h2>

                    <div class="clearfix"></div>

                 </div>
                 <br>


                  <div class="x_content">


                <div class="row">
                    @foreach($weeks as $item)
                    <div class="col-md-4">
                        <div class="x_panel">
                            <div class="x_content">
                                <article class="media event">
                                <a class="pull-left date">
                                    <p class="month">{{$item->mes}}</p>
                                    <p class="day">{{substr($item->anio,2,3) }}</p>
                                </a>
                                <div class="media-body">
                                    <a class="title" href="{{ route('semana-epidemiologica.create',['semana'=>$item->id]) }}" target="_blank">{{$item->fec_inicio }} - {{ $item->fec_final}}</a>
                                    <p>{{$item->asunto}}</p>
                                </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


                  </div>

            </div>
</div>

@endsection
