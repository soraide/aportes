<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-12">
        <input type="hidden" class="form-control" id="pagina" value="1">
        <h1 class="mr-4" style="display:inline-block"> Gestiones</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-adicionar-gestion">Añadir Gestion</button>
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
            <div id="afiliados" style="margin:0 10px;">
              <table id="t_gestiones" class="table table-bordered table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Gestion</th>
                    <th>Rendimiento</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody id="t_body_gestiones">

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