<div class="tab-pane" role="tabpanel" id="step3">
    <form id="form-datos-militares"  data-name="Sección de Datos Militares.">
        <div class="d-flex mb-4 text-start">
            <h4 class="h4"><i class="fas fa-address-card me-2"></i><b>Datos Militares</b></h4>
        </div>
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <span class="text-primary">Grado</span>
                <div class="form-group">
                    <select name="grado_id" class="form-select form-control-lg" id="grado-id" required>
                        <option value="" selected disabled> - Seleccionar Grado - </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <span class="text-primary">Fecha de Ingreso Armada Boliviana</span>
                <div class="form-group">
                    <input type="date" class="form-control form-control-lg" name="fecha_ingreso" required max="<?= (new DateTime())->format("Y-m-d") ?>" min="<?= (new DateTime("1960-01-01"))->format("Y-m-d") ?>" id="fecha-ingreso" autocomplete="off"/>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="number" class="form-control form-control-lg" name="promo" required max="3000" min="1900" placeholder="Año de Promoción ENM" id="promo" autocomplete="off"/>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="text" name="profesion" class="form-control form-control-lg" placeholder="Profesión"  id="profesion" autocomplete="off"/>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="number" class="form-control form-control-lg" name="nro_tin" required placeholder="Número de T.I.N." id="nro-tin" autocomplete="off"/>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="number" class="form-control form-control-lg" name="codigo_boleta" required placeholder="Código Boleta" id="codigo-boleta" autocomplete="off"/>
                </div>
            </div>
        </div>
        <ul class="list-inline pull-right">
            <li><button type="button" class="btn btn-info prev-step">Regresar</button></li>
            <li><button type="button" class="btn btn-success next-step" data-verify="1" data-id-form="form-datos-militares">Siguiente</button></li>
        </ul>
    </form>
</div>