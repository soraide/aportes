<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-12">
        <input type="hidden" class="form-control" id="pagina" value="1">
        <h1 class="m-0" style="display:inline-block"> Afiliados en espera </h1>
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
            <div id="afiliadosEspera" style="margin:0 10px;">
              <table id="t_afiliados_espera" class="table table-bordered table-striped" style="width:100%">
                <thead>
                  <tr align="center">
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>C.I.</th>
                    <th>Fecha Nac.</th>
                    <th>Celular</th>
                    <th>Fuerza</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody id="afiliados_espera_body">

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