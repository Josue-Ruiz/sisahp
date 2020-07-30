
<div class="modal fade bs-example-modal-sm" id="modal-confirm-delete-{{$id}}" tabindex="-1" role="dialog" aria-hidden="true">
<form action="{{$ruta}}" method="POST">
    {{method_field('DELETE')}}
    @csrf
  <div class="modal-dialog ">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Eliminar registro</h4>
        </div>
        <div class="modal-body">
            <p>¿Esta seguro que desea eliminar este registro?.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
    </div>
  </div>
  </form>
</div>



