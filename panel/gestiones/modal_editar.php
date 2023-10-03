<form id="form-editar-gestion">
<div class="modal fade" id="modal-editar-gestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bold">Editar Gestión</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label for="gestion-edit">Gestion</label>
              <input type="number" class="form-control" id="gestion-edit" aria-describedby="ayudaGestion-edit" min="1900" max="2050" max-length="4" readonly>
              <input type="hidden" class="form-control" id="id-rendimiento-edit">
              <small id="ayudaGestion-edit" class="form-text text-muted">Ingrese el año de la gestión a registrar.</small>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label for="rendimiento-edit">Rendimiento</label>
              <input type="decimal" class="form-control" id="rendimiento-edit" aria-describedby="ayudaRendimiento-edit" max="100" required>
              <small id="ayudaRendimiento-edit" class="form-text text-muted">Ingrese el porcentaje para el rendimiento asignado de la gestión.</small>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
        <button type="submit" class="btn btn-success">Registrar</button>
      </div>
    </div>
  </div>
</div>
</form>