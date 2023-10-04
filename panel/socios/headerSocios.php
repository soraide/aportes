<div class="content-header">
  <div class="container-fluid">
    <div class="d-flex justify-content-between">
      <input type="hidden" class="form-control" id="pagina" value="1">
      <h1 class="h1 text-bold text-primary">SOCIOS</h1>
      <a href="../socios/exportarAportesExcel.php" class="btn btn-success" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Exportar Excel</a>
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
            <div id="afiliados" style="margin:0 10px;">
              <table id="t_afiliados" class="table table-bordered table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>Nro.</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>C.I.</th>
                    <th>Fecha Nac.</th>
                    <th>Celular</th>
                    <th>Grado</th>
                    <th>Observaciones</th>
                    <th>Fecha Aceptado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody id="t_body_afiliados">

                </tbody>
              </table>
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