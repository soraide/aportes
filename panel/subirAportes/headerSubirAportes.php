<link rel="stylesheet" href="../css/loader.css">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <input type="hidden" class="form-control" id="pagina" value="1">
                <h1 class="m-0" style="display:inline-block"> Subir Excel Aportes</h1>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row"></div>
        <div class="row">
            <section class="col-lg-8 connectedSortable">
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
                                <h4>Cargar Excel</h4>
                            </div>
                            <form id="formularioCarga" enctype="multipart/form-data" style="width:100%;">
                                <div class="col-lg-8">
                                    <label for="inputFecha">Mes y Año:</label>
                                    <input type="month" id="inputFecha" class="form-control" name="fecha" value="<?php echo date('Y-m'); ?>" required>
                                </div>
                                <div class="col-lg-12 p-2">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <input type="file" id="inputArchivo" class="btn btn-success" name="archivoExcel" accept=".xlsx, .xls">
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="button" class="btn btn-primary" onclick="subirArchivo()"><i class="fa fa-upload" aria-hidden="true"></i> Subir Excel</button>
                                        </div>
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
            <section class="col-lg-4 connectedSortable">
                <form id="formularioDescarga">
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
                                <div class="col-md-12">
                                    <h4>Descargar Excel</h4>
                                </div>
                                <div class="col-lg-12">
                                    <label for="inputFecha">Mes y Año:</label>
                                    <input type="month" id="fecha-aporte" class="form-control" name="fechaAporte" value="<?php echo date('Y-m'); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="button" class="btn btn-success" onclick="descargarExcelAportes()"><i class="fa fa-download" aria-hidden="true"></i> Descargar Excel</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</section>