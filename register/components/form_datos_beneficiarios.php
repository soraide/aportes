<div class="tab-pane" role="tabpanel" id="step4">
    <form id="form-datos-beneficiarios" data-name="Sección de Datos de Beneficiarios.">
        <div class="d-flex mb-4">
            <h4 class="h4"><i class="fas fa-user-circle me-2"></i><b>Beneficiarios</b></h4>
        </div>
        <div class="row mb-3" id="beneficiarios">

        </div>
        <div class="col-md-12 mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="check-agree" required/>
                <label class="form-check-label text-muted" for="check-agree">
                    Al hacer click aquí, estoy de acuerdo con las 
                    <a class="text-primary" href="#">políticas</a>
                    para mi afiliación en 
                    <a class="text-primary" href="#"> "Stella Maris"</a>.
                </label>
            </div>
        </div>
        <ul class="list-inline pull-right">
            <li><button type="button" class="btn btn-danger" onclick="removerBeneficiario()">Remover</button></li>
            <li><button type="button" class="btn btn-primary" onclick="nuevoBeneficiario()">Adicionar</button></li>
            <li><button type="button" class="btn btn-info prev-step">Regresar</button></li>
            <li><button class="btn btn-success next-step" type="button" id="btn-submit" data-id-form="form-datos-beneficiarios" data-verify="1" data-finish="1">Registrar</button></li>
        </ul>
    </form>
</div>