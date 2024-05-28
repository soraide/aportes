<div class="tab-pane" role="tabpanel" id="step2">
    <form id="form-datos-ubicacion"  data-name="Sección de Datos de Localización.">
        <div class="d-flex mb-4 text-start">
            <h4 class="h4"><i class="fas fa-map-marker-alt me-2"></i><b>Datos de Localización y Cuenta</b></h4>
        </div>
        <div class="row mb-4">
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <input type="text" name="lugar_nacimiento" class="form-control form-control-lg" required placeholder="Lugar de Nacimiento" autocomplete="off" id="lugar-nacimiento">
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <span><b>Su dirección actual</b></span>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="calle" placeholder="Calle" autocomplete="off" id="calle" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="zona" placeholder="Zona - Avenida" autocomplete="off" id="zona" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="number" class="form-control form-control-lg" name="numero" placeholder="Número" autocomplete="off" id="numero" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="ciudad" placeholder="Ciudad" autocomplete="off" id="ciudad" required>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <span><b>Datos de la Cuenta</b></span>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="email" class="form-control form-control-lg" name="correo" required placeholder="Correo Electrónico" autocomplete="off" id="correo"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-lg">
                    <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password" required data-obscure="1"/>
                    <button class="btn btn-light text-center" type="button" id="btn-obscure-password" data-mdb-ripple-init data-mdb-ripple-color="dark" >
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>
        <ul class="list-inline pull-right">
            <li><button type="button" class="btn btn-info prev-step">Regresar</button></li>
            <li><button type="button" class="btn btn-success next-step" data-verify="1" data-id-form="form-datos-ubicacion">Siguiente</button></li>
        </ul>
    </form>
</div>