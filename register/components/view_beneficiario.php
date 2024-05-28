<div class="col-md-12" id="bnf-<?=$_POST['id']?>">
    <label><i class="fas fa-child me-2"></i><b>Beneficiario <?=$_POST['id']?></b></label>
    <div class="row mt-2">
        <div class="col-md-12 mb-3">
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" name="nombre_beneficiario[]" required placeholder="Nombres" autocomplete="off" id="nombre-beneficiario-<?=$_POST['id']?>"/>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" name="paterno_beneficiario[]" required placeholder="Ap. Paterno" autocomplete="off" id="paterno-beneficiario-<?=$_POST['id']?>">
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" name="materno_beneficiario[]" required placeholder="Ap. Materno" autocomplete="off" id="materno-beneficiario-<?=$_POST['id']?>">
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <select name="parentesco_id_beneficiario[]" class="form-select form-control-lg pl-2" required placeholder="Parentesco" id="parentesco-id-beneficiario-<?=$_POST['id']?>">
                    <option value="" disabled selected><i> - Seleccionar Parentesco - </i></option>
                </select>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="form-group">
                <input type="number" class="form-control form-control-lg" name="ci_beneficiario[]" required placeholder="Cédula de Identidad" id="ci-beneficiario-<?=$_POST['id']?>" autocomplete="off">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <select name="expedido_id_beneficiario[]" class="form-select form-control-lg" required id="expedido-id-beneficiario-<?=$_POST['id']?>">
                    <option value="" disabled selected> - Exp - </option>
                </select>
            </div>
        </div>
    </div>
</div>