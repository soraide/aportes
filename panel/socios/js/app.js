const lenguaje = {
  processing: 'Procesando...',
  search: 'Buscar en la tabla',
  lengthMenu: "Son  _MENU_ filas por página",
  paginate: {
    first: 'Primero',
    previous: 'Ant.',
    next: 'Sig.',
    last: 'Último'
  },
  emptyTable: 'No hay registros...',
  infoEmpty: 'No hay resultados',
  zeroRecords: 'No hay registros...',
}
async function listarSociosEspera() {
  remove();
  document.getElementById("nav_socios_espera").className += " active";
  document.getElementById("carpeta-activa").value = "socios";
  try {
    const res = await $.ajax({
      url: '../socios/headerSociosEspera.php',
      type: 'GET',
      dataType: 'html'
    })
    $("#all-body").html(res)
    const tables = await $.ajax({
      url: '../../api/socio/socioEspera',
      type: 'GET',
      dataType: 'json'
    });
    if (tables.status == 'success') {
      const contenido = generaFilasEspera(tables.socios);
      $("#afiliados_espera_body").html(contenido);
      $('#t_afiliados_espera').DataTable({
        language: lenguaje,
        columnDefs: [
          { orderable: false, targets: [3, 6] }
        ],
        "info": false,
        "scrollX": true,
        "scrollY": '50vh'
      });
      // console.log(tables);
    }
  } catch (error) {
    console.log(error);
  }
}

async function listarSocios() {
  remove();
  document.getElementById("nav_socios").className += " active";
  document.getElementById("carpeta-activa").value = "socio";
  try {
    const res = await $.ajax({
      url: '../socios/headerSocios.php',
      type: 'GET',
      dataType: 'html'
    })
    $("#all-body").html(res)
    const tables = await $.ajax({
      url: '../../api/socio/getAll',
      type: 'GET',
      dataType: 'json'
    });
    if (tables.status == 'success') {
      const contenido = generaFilas(tables.socios);
      $("#t_body_afiliados").html(contenido);
      $('#t_afiliados').DataTable({
        language: lenguaje,
        columnDefs: [
          { orderable: false, targets: [3, 7, 8] }
        ],
        "info": false,
        "scrollX": true,
        "scrollY": '50vh'
      });
      // console.log(tables);
    }
  } catch (error) {
    console.log(error)
  }
}
async function listarSociosBaja() {
  remove();
  document.getElementById("nav_socios_baja").className += " active";
  document.getElementById("carpeta-activa").value = "socio";
  try {
    const res = await $.ajax({
      url: '../socios/headerSociosBaja.php',
      type: 'GET',
      dataType: 'html'
    })
    $("#all-body").html(res)
    const tables = await $.ajax({
      url: '../../api/socio/getSociosBaja',
      type: 'GET',
      dataType: 'json'
    });
    if (tables.status == 'success') {
      const contenido = generaFilasBaja(tables.socios);
      $("#t_body_socio_baja").html(contenido);
      $('#t_socios_baja').DataTable({
        language: lenguaje,
        columnDefs: [
          { orderable: false, targets: [5,6] }
        ],
        "info": false,
        "scrollX": true,
      });
      // console.log(tables);
    }
  } catch (error) {
    console.log(error)
  }
}

function generaFilasEspera(data) {
  let filas = '';
  for (let index = 0; index < data.length; index++) {
    const element = data[index];
    let fecha = new Date(element.fechaNac);
    fecha = fecha.toLocaleDateString();
    filas += `
      <tr>
        <td>${element.numero}</td>
        <td>${element.apellidos}</td>
        <td>${element.nombres}</td>
        <td>${element.ci}</td>
        <td>${fecha}</td>
        <td>${element.celular}</td>
        <td>${element.grado}</td>
        <td>
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Acciones </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#" onclick="revisarSocio(${element.idSocio})"><i class="fas fa-check-square text-success"></i> &nbsp;&nbsp;Revisar</a>
            </div>
        </td>
      </tr>
    `;
  }
  return filas;
}
function generaFilas(data){
  let filas = '';
  for (let index = 0; index < data.length; index++) {
    const element = data[index];
    let fecha = new Date(element.fechaNac);
    let fecha2 = new Date(element.fechaAceptado);
    fecha2 = fecha2.toLocaleDateString();
    fecha = fecha.toLocaleDateString();
    filas += `
      <tr>
        <td>${element.numero}</td>
        <td>${element.apellidos}</td>
        <td>${element.nombres}</td>
        <td>${element.ci}</td>
        <td>${fecha}</td>
        <td>${element.celular}</td>
        <td>${element.grado}</td>
        <td>${element.observacion}</td>
        <td>${fecha2}</td>
        <td>
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Acciones </button>
            <div class="dropdown-menu">
              <!--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_detalle" data-id="${element.idSocio}"><i class="fas fa-eye text-info"></i> &nbsp;&nbsp; Detalles</a>
              <a class="dropdown-item editarUsuario" data-id="${element.idSocio}" href="#"><i class="fas fa-edit text-primary"></i> &nbsp;&nbsp;Editar</a>-->
              <a class="dropdown-item" href="#" data-id="${element.idSocio}" data-toggle="modal" data-target="#modal_baja"><i class="fas fa-external-link-alt text-danger"></i> &nbsp;&nbsp; Dar de baja</a>
              <a class="dropdown-item" data-id="${element.idSocio}" href="../../api/aporte/ContributionSummaryPDF/${element.idSocio}" target="_blank"><i class="fas fa-money-bill text-success"></i> &nbsp;&nbsp;Ver aportes resumen</a>
              <a class="dropdown-item" data-id="${element.idSocio}" href="../../api/aporte/ContributionHistoryPDF/${element.idSocio}" target="_blank"><i class="fas fa-money-bill text-primary"></i> &nbsp;&nbsp;Ver aportes detallado</a>
            </div>
        </td>
      </tr>
    `;
  }
  return filas;
}


function generaFilasBaja(data){
  let filas = '';
  for (let index = 0; index < data.length; index++) {
    const element = data[index];
    let fecha = new Date(element.fechaAceptado);
    let fecha2 = new Date(element.fechaBaja);
    fecha2 = fecha2.toLocaleDateString();
    fecha = fecha.toLocaleDateString();
    filas += `
      <tr>
        <td>${element.numero}</td>
        <td>${element.apellidos}</td>
        <td>${element.nombres}</td>
        <td>${element.ci}</td>
        <td>${element.celular}</td>
        <td>${element.grado}</td>
        <td>${fecha}</td>
        <td>${fecha2}</td>
      </tr>
    `;
  }
  return filas;
}
async function revisarSocio(id) {
  try {
    const htmlDatos = await $.ajax({
      url: `../../api/socio/socioDetalleHtml/${id}`,
      dataType: 'html',
      type: 'GET'
    })
    const htmlArchivos = await $.ajax({
      url: `../../api/socio/socioArchivosHtml/${id}`,
      dataType: 'html',
      type: 'GET'
    })
    $("#afiliadosEspera").html(`<div class="row">
    ${htmlDatos} ${htmlArchivos}</div>
    <div class="d-flex justify-content-center mt-3">
      <button class="btn btn-secondary ml-2" onclick="listarSociosEspera()">Volver</button>
      <button class="btn btn-danger ml-2" data-id="${id}" data-toggle="modal" data-target="#modal_rechazar">Rechazar</button>
      <button class="btn btn-success ml-2" data-id="${id}" data-toggle="modal" data-target="#modal_aceptar">Aceptar</button>
    </div>`);
  } catch (error) {
    console.log(error)
  }
}

$("#modal_aceptar").on('show.bs.modal', function (e){
  console.log(e.relatedTarget)
  $("#id_usuario_aceptar").val(e.relatedTarget.dataset.id)
})
$("#modal_baja").on('show.bs.modal', function (e){
  $("#id_usuario_baja").val(e.relatedTarget.dataset.id)
})

$("#modal_rechazar").on('show.bs.modal', function (e){
  console.log(e.relatedTarget)
  $("#id_usuario_rechazar").val(e.relatedTarget.dataset.id)
})
$("#modal_aceptar").on('hidden.bs.modal', function(){
  $("#id_usuario_aceptar").val('')
})
$("#modal_rechazar").on('hidden.bs.modal', function(){
  $("#id_usuario_rechazar").val('')
})

async function aceptarSocio(){
  const id = $("#id_usuario_aceptar").val();
  const obs = $("#observacion").val();
  if(id != ''){
    try {
      const res = await $.ajax({
        url: `../../api/socio/aceptarSocio`,
        type: 'PUT',
        data: {idUsuario: id, observacion: obs},
        dataType: 'json'
      });
      if(res.status == 'success'){
        alertify.success('El usuario fue aceptado con éxito');
        setTimeout(()=>{window.location.reload()},2200);
      }else{
        alertify.error('Ocurrio un error al aceptar el usuario');
      }
    } catch (error) {
      console.log(error)
    }
  }else{
    alertify.error('Ocurrio un error con el usuario');
  }
}
async function rechazarSocio(){
  const id = $("#id_usuario_rechazar").val();
  if(id != ''){
    try {
      const res = await $.ajax({
        url: `../../api/socio/rechazarSocio`,
        type: 'DELETE',
        data: {idUsuario: id},
        dataType: 'json'
      });
      if(res.status == 'success'){
        alertify.success('El Socio fue rechazado y eliminado de la cola');
        setTimeout(()=>{window.location.reload()},2200);
      }else{
        alertify.error('Ocurrio un error al eliminar al usuario');
      }
    } catch (error) {
      console.log(error)
    }
  }else{
    alertify.error('Ocurrio un error con el usuario');
  }
}

async function bajaSocio(){
  const id = $("#id_usuario_baja").val();
  if(id != ''){
    try {
      const res = await $.ajax({
        url: `../../api/socio/bajaSocio`,
        type: 'DELETE',
        data: {idUsuario: id},
        dataType: 'json'
      });
      if(res.status == 'success'){
        alertify.success('El socio fue dado de baja');
        window.open(`../../api/socio/UnsubscribePartnerPDF/${id}`, "_blank");
      }else{
        alertify.error('Ocurrio un error al dar de baja al socio');
      }
    } catch (error) {
      console.log(error)
    }
  }else{
    alertify.error('Ocurrio un error con el usuario');
  }
}

$('.editarUsuario').on('click',(e) => {
  console.log(e.target.dataset.id);
  console.log('clic')
})