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
async function listarAfiliadosEspera() {
  remove();
  document.getElementById("nav_afiliado_espera").className += " active";
  document.getElementById("carpeta-activa").value = "afiliados";
  try {
    const res = await $.ajax({
      url: '../afiliados/headerAfiliadosEspera.php',
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
      });
      // console.log(tables);
    }
  } catch (error) {
    console.log(error);
  }
}

async function listarAfiliados() {
  remove();
  document.getElementById("nav_afiliados").className += " active";
  document.getElementById("carpeta-activa").value = "afiliados";
  try {
    const res = await $.ajax({
      url: '../afiliados/headerAfiliados.php',
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
        <td>${element.apellidos}</td>
        <td>${element.nombres}</td>
        <td>${element.ci}</td>
        <td>${fecha}</td>
        <td>${element.celular}</td>
        <td>${element.provieneFuerza}</td>
        <td>
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Acciones </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_detalle" data-id="${element.idUsuario}"><i class="fas fa-eye text-info"></i> &nbsp;&nbsp;Más detalles</a>
              <a class="dropdown-item" href="#" onclick="revisarSocio(${element.idUsuario})"><i class="fas fa-check-square text-success"></i> &nbsp;&nbsp;Revisar</a>
              <a class="dropdown-item" href="#"><i class="fas fa-edit text-primary"></i> &nbsp;&nbsp;Editar</a>
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
        <td>${element.apellidos}</td>
        <td>${element.nombres}</td>
        <td>${element.ci}</td>
        <td>${fecha}</td>
        <td>${element.celular}</td>
        <td>${element.provieneFuerza}</td>
        <td>${element.observacion}</td>
        <td>${fecha2}</td>
        <td>
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Acciones </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_detalle" data-id="${element.idUsuario}"><i class="fas fa-eye text-info"></i> &nbsp;&nbsp; Detalles</a>
              <a class="dropdown-item" href="#"><i class="fas fa-edit text-primary"></i> &nbsp;&nbsp;Editar</a>
            </div>
        </td>
      </tr>
    `;
  }
  return filas;
}

$('#modal_detalle').on('show.bs.modal', async function (event) {
  const id = event.relatedTarget.dataset.id;
  try {
    const res = await $.ajax({
      url: `../../api/socio/socioEsperaDetalle/${id}`,
      dataType: 'json',
      type: 'GET'
    })
    if (res.status == 'success') {
      $("#tituloDetalle").html(`<b>Usuario:</b> ${res.socio.nombre}`);
      let cadena = '';
      let fecha = new Date(res.socio.fechaIncorporacion);
      fecha = fecha.toLocaleDateString();
      cadena += `
      <tr><td style="font-weight:bolder">Estado Civil</td>
      <td>${res.socio.estadoCivil}</td></tr>
      <tr><td style="font-weight:bolder">Correo Electrónico</td>
      <td>${res.socio.correoElec}</td></tr>
      <tr><td style="font-weight:bolder">Ciudad</td>
      <td>${res.socio.ciudad}</td></tr>
      <tr><td style="font-weight:bolder">Localidad</td>
      <td>${res.socio.localidad}</td></tr>
      <tr><td style="font-weight:bolder">Dirección</td>
      <td>${res.socio.direccion}</td></tr>
      <tr><td style="font-weight:bolder">Fuerza</td>
      <td>${res.socio.provieneFuerza}</td></tr>
      <tr><td style="font-weight:bolder">Fecha Incorporación</td>
      <td>${res.socio.fechaIncorporacion}</td></tr>
      <tr><td style="font-weight:bolder">Carnet Militar</td>
      <td>${res.socio.carnetMilitar}</td></tr>
      <tr><td style="font-weight:bolder">Carnet Cossmil</td>
      <td>${res.socio.carnetCossmil}</td></tr>
      <tr><td style="font-weight:bolder">Arma</td><td>${res.socio.arma}</td></tr>
      `;
      $("#tableDetail").html(cadena);
    } else {
      $("#tituloDetalle").html('Upps, ocurrió un error')
    }
  } catch (error) {
    console.log(error);
  }
})

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
      <button class="btn btn-secondary ml-2" onclick="listarAfiliadosEspera()">Volver</button>
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
        setTimeout(()=>{window.location.reload()},3000);
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
        alertify.success('El usuario fue rechazado y eliminado de la cola');
        setTimeout(()=>{window.location.reload()},3000);
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
