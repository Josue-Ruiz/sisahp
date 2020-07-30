@push('extra_css')
<link href="{{ asset('vendor/cropper/dist/cropper.min.css') }}" rel="stylesheet">
@endpush

@push('extra_js')

  <script src="{{ asset('vendor/cropper/dist/cropper.min.js') }}"></script>
  <script src="{{ asset('js/upload_logo.js') }}"></script>
@endpush


@extends('layouts.master')

@section('content')


<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Modificar Logotipo<small></small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <div class="container cropper">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="img-container">
                        <img id="image" src="{{ $id == 1 ?  asset('images/report/secretariasalud.png') : asset('images/report/secretariasaludchiapas.png') }}" alt="Picture">
                      </div>
                    </div>
                    <div class="col-md-4">


                      <div class=" docs-buttons">


                      <div class="btn-group">
                        <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                          <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                            <span class="fa fa-upload"></span>
                          </span>
                        </label>

                        <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;reset&quot;)">
                            <span class="fa fa-refresh"></span>
                          </span>
                        </button>

                      </div>

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
                            <span class="fa fa-search-plus"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
                            <span class="fa fa-search-minus"></span>
                          </span>
                        </button>
                      </div>

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)">
                            <span class="fa fa-rotate-left"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)">
                            <span class="fa fa-rotate-right"></span>
                          </span>
                        </button>
                      </div>

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;crop&quot;)">
                            <span class="fa fa-check"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;clear&quot;)">
                            <span class="fa fa-remove"></span>
                          </span>
                        </button>
                      </div>

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, -10, 0)">
                            <span class="fa fa-arrow-left"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 10, 0)">
                            <span class="fa fa-arrow-right"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 0, -10)">
                            <span class="fa fa-arrow-up"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 0, 10)">
                            <span class="fa fa-arrow-down"></span>
                          </span>
                        </button>
                      </div>



                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;scaleX&quot;, -1)">
                            <span class="fa fa-arrows-h"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                          <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;scaleY&quot;, -1)">
                            <span class="fa fa-arrows-v"></span>
                          </span>
                        </button>
                      </div>



                      <div class="btn-group btn-group-crop">
                        <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
                          <span class="docs-tooltip" data-toggle="tooltip" >
                            Ajustar
                          </span>
                        </button>


                      </div>
                      <div class="docs-preview clearfix">

                          <form action="{{ route('exhortos-eficiencia-cloracion.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="id" value={{$id}}>
                              <div id="img-preview-saved"></div>
                          </form>

                        </div>
                       <div class="btn-group">

                      </div>

                      <!-- Show the cropped image in modal -->
                      <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" id="getCroppedCanvasTitle">Evidencia</h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <a class="btn btn-primary"disabled id="download" style="display: none;" href="javascript:void(0);" >Download</a>
                              <a class="btn btn-success" id="save-image" href="javascript:void(0);" >Ajustar Tamaño</a>
                            </div>
                          </div>
                        </div>
                      </div><!-- /.modal -->

                    </div><!-- /.docs-buttons -->
                    </div>
                    </div>
                  </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <a  href="{{route('exhortos-eficiencia-cloracion.show','logotipos') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>

                        </div>
                    </div>

        </div>
    </div>
</div>

@endsection
