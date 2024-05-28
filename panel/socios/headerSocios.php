<div class="content-header">
  <div class="container-fluid">
    <div class="d-flex bd-highlight">
      <input type="hidden" class="form-control" id="pagina" value="1">
      <h1 class="h1 text-bold text-primary flex-grow-1 bd-highlight">SOCIOS</h1>
      <a href="../../api/reporte/DetalleSociosAltaPDF" class="btn btn-danger bd-highlight mr-2" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Exportar PDF</a>
      <a href="../socios/exportarAportesExcel.php" class="btn btn-success bd-highlight" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Exportar Excel</a>
    </div>
  </div>
</div>
<section class="content m-0">
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
            <div id="afiliados" style="margin:0 10px;"></div>
            <div id="for-pagination2" style="text-align:center"></div>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </section>
    </div>
  </div>
</section>