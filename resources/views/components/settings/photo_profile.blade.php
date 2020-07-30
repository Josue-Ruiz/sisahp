@extends('layouts.master')



@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Actualizar foto de perfil<small>Se recomienda poner una foto tuya.</small></h2>

                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                  <form action="{{ route('update_photo_settings') }}" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                    @csrf

                    <div class="text-center">
                        <input type="file"  name="foto" id="foto" onchange="previewFile()">
                    </div>


                    <div id ="perfil" class="text-center"></div>
                    <div id="error-image">@error('foto')  {{$message}} @enderror</div>
                    <div class="ln_solid"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{route('home') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>
                        <button type="submit" class="btn btn-success" id="save" disabled>Guardar</button>
                    </div>

                    </form>
                  </div>
            </div>
</div>


@endsection


@push('extra_js')
    <script type="text/javascript" src="{{ asset('js/upload_profile.js') }}"></script>
@endpush
