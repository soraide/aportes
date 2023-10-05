<link rel="stylesheet" href="../css/loader.css">
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <input type="hidden" class="form-control" id="pagina" value="1">
            <h1 class="h1 text-bold text-primary">SUBIR EXCEL APORTES</h1>
        </div>
    </div>
</div>
<section class="content mt-0">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="card direct-chat direct-chat-primary">
                    <div class="card-header" id="buscador-general">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-4">
                            <div class="col-lg-12">
                                <h4 class="text-bold">Cargar Excel</h4>
                            </div>
                            <form id="formularioCarga" enctype="multipart/form-data" style="width:100%;">
                                <div class="col-lg-4">
                                    <label for="inputFecha">Mes y Año:</label>
                                    <input type="month" id="inputFecha" class="form-control" name="fecha" value="<?php echo date('Y-m'); ?>" required>
                                </div>
                                <div class="col-lg-6 p-2">
                                    <div class="d-flex flex-row">
                                        <input type="file" id="inputArchivo" class="btn btn-success mr-2" name="archivoExcel" accept=".xlsx, .xls">
                                        <button type="button" class="btn btn-primary" onclick="subirArchivo()"><i class="fa fa-upload" aria-hidden="true"></i> Subir Excel</button>
                                    </div>
                                </div>
                            </form>
                            <div id="archivoExcelSubido" class="col-lg-12" style="padding-top: 20px;">
                        
                            </div>
                            <div id="loader2" class="loader2" style="display:none;">
                                <div class="loader2-content">
                                    <img style="max-width: 50%;" src="../../images/loader.gif" alt="Cargando...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>