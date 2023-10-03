<!-- modal aviso rechazar -->
<div class="modal fade" id="modal_rechazar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bold">Rechazar la solicitud de afiliación al usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_usuario_rechazar">
        ¿Está seguro de rechazar la solicitud del usuario?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
        <button type="button" class="btn btn-danger" onclick="rechazarSocio()" data-dismiss="modal">Rechazar</button>
      </div>
    </div>
  </div>
</div>

<!-- modal aviso aceptar -->
<div class="modal fade" id="modal_aceptar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bold">Aceptar la solicitud de afiliación al usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="hidden" id="id_usuario_aceptar">
          <label for="observacion">¿Existe alguna observación para el usuario?</label>
          <input type="text" class="form-control" id="observacion"  placeholder="Observación">
          <small class="form-text text-muted">Observaciones sobre los documentos presentados, datos personales, etc. (No es obligatorio)</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
        <button type="button" class="btn btn-success" onclick="aceptarSocio()" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>