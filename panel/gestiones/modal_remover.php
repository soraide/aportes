<div class="modal fade" id="modal-remover-gestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bold">Remover Gestión</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <p>
                ¿Esta seguro(a) que desea eliminar la gestión <b id="remover-gestion"></b>?
            </p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
        <button type="submit" class="btn btn-danger" onclick="eliminarGestion()">Eliminar</button>
      </div>
    </div>
  </div>
</div>