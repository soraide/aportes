<link rel="stylesheet" href="../css/loader.css">
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <input type="hidden" class="form-control" id="pagina" value="1">
                <h1 class="m-0" style="display:inline-block"> Gestiones</h1>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row"></div>
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
                        <div id="for-pagination1" style="text-align:center"></div>
                        <div class="row p-4">
                            <div class="col-md-8">
                                <h4>Cargar Excel</h4>
                                <form id="formularioCarga" enctype="multipart/form-data">
                                    <div class="row flex">
                                        <div class="col-sm-12 p-2">
                                            <div class="col-sm-3">
                                                <label for="inputFecha">Mes y Año:</label>
                                                <input type="month" id="inputFecha" class="form-control" name="fecha" value="<?php echo date('Y-m'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 p-2">
                                            <input type="file" id="inputArchivo" class="btn btn-lg btn-success" name="archivoExcel" accept=".xlsx, .xls">
                                        </div>
                                        <div class="col-sm-4 p-2">
                                            <button type="button" class="btn btn-lg btn-primary" onclick="subirArchivo()"><i class="fa fa-upload" aria-hidden="true"></i> Subir Excel</button>
                                        </div>
                                    </div>
                                </form>
                                <div id="archivoExcelSubido" class="row" style="padding-top: 20px;"></div>
                                <div id="loader2" class="loader2" style="display:none;">
                                    <div class="loader2-content">
                                        <img style="max-width: 50%;" src="../../images/loader.gif" alt="Cargando...">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="for-pagination2" style="text-align:center"></div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>