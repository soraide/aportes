<div class="tab-pane active" role="tabpanel" id="step1">
    <form id="form-datos-personales"  data-name="Sección de Datos Personales.">
        <div class="d-flex text-start mb-4">
            <h4 class="h4"><i class="fas fa-user me-2"></i><b>Datos Personales</b></h4>
        </div>
        <div class="row mb-4">
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="nombre" required placeholder="Nombre(s)" id="nombre" autocomplete="off"/>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="paterno" required placeholder="Ap. Paterno" autocomplete="off" id="paterno">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="materno" required placeholder="Ap. Materno" autocomplete="off" id="materno">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <input type="number" class="form-control form-control-lg" name="ci" required placeholder="Cédula de Identidad" autocomplete="off" id="ci"/>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="form-group">
                    <select id="expedido-id" name="expedido_id" class="form-select form-control-lg" required>
                        <option value="" selected disabled> - Exp - </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <input type="number" class="form-control form-control-lg" name="celular" placeholder="Celular" autocomplete="off" id="celular" required/>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <span class="text-primary">Fecha de nacimiento</span>
                <div class="form-group">
                    <input type="date" class="form-control form-control-lg" name="fecha_nacimiento" required max="<?= (new DateTime())->modify('-18 years')->format("Y-m-d") ?>" id="fecha-nacimiento"/>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <span class="text-primary">Estado Civil</span>
                <div class="form-group">
                    <select id="estado-civil-id" name="estado_civil_id" class="form-select form-control-lg" required>
                        <option value="" disabled selected> - Estado Civil - </option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <span class="text-primary">PDF - Cédula de Identidad</span>
                <div class="input-group">                      
                    <input type="file" class="form-control filePdf" accept=".pdf" data-filename="ci" required id="pdf-ci" onchange="convertPDFToBase64(this,'documento')">
                    <input type="hidden" id="documento" name="documento"/>
                </div>
            </div>
        </div>
        <ul class="list-inline pull-right">
            <li><button type="button" class="btn btn-success next-step" data-verify="1" data-id-form="form-datos-personales">Siguiente</button></li>
        </ul>
    </form>
</div>