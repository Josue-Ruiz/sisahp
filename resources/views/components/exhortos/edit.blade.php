@extends('layouts.master')

@push('extra_css')

@endpush

@push('extra_js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@endpush

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Modificar Asunto   | Reporte  Exhortos <small></small></h2>
                    <div class="clearfix"></div>
                 </div>
                 <br>

                 <div class="x_content">

                  <form action="{{ route('exhortos-eficiencia-cloracion.update','asunto') }}" method="POST" id="demo-form2"  class="form-horizontal form-label-left">
                    @csrf
                    @method('PATCH')
                    <textarea class="ckeditor" id="ckeditor" name="descripcion">{{$asunto}}</textarea>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{route('exhortos-eficiencia-cloracion.index') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>
                        <button type="submit"  class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                    </div>

                </form>
                  <br />

                  <div class="ln_solid"></div>

                </div>
            </div>
</div>

@endsection
