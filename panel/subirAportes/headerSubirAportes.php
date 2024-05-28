<link rel="stylesheet" href="../css/loader.css">
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <input type="hidden" class="form-control" id="pagina" value="1">
            <h1 class="h1 text-bold text-success">SUBIR EXCEL APORTES</h1>
        </div>
    </div>
</div>
<section class="content mt-0">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card" style="max-width: 400px;">
                <div class="card-header">
                    <label class="text-bold text-secondary m-0 h5">Subir Excel Aportes</label>
                </div>
                <div class="card-body">
                    <form id="formularioCarga" enctype="multipart/form-data" style="width:100%;">
                        <div class="row mb-2">
                            <div class="col-md-12 mb-3">
                                <label for="mes-gestion">Mes y Año:</label>
                                <input type="month" id="mes-gestion" class="form-control" name="fecha" value="<?php echo date('Y-m'); ?>" max="<?=date('Y-m')?>" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Archivo:</label>
                                <input type="file" class="" id="archivo-excel" name="archivoExcel" accept=".xlsx, .xls" required>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary" onclick="subirArchivo()" style="width: 100%;"><i class="fa fa-upload mr-2"></i>Subir Excel</button>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="archivoExcelSubido">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="max-width: 600px;min-width:500px;">
                <div class="card-header">
                    <label class="text-bold text-secondary m-0 h5">Observaciones</label>
                </div>
                <div class="card-body">
                    <ul class="list-group" id="observaciones" style="overflow-y: auto;max-height: 300px;">

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="loader2" class="loader2" style="display:none;">
        <div class="loader2-content">
            <img style="max-width: 30%;" src="../images/loader.gif" alt="Cargando...">
        </div>
    </div>
</section>