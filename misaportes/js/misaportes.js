$(document).ready(() => {

  /*const getLiteralMonth = (month) => {
    var literal = '';
    switch(month){
      case '01':literal = 'ENERO';break;
      case '02':literal = 'FEBRERO';break;
      case '03':literal = 'MARZO';break;
      case '04':literal = 'ABRIL';break;
      case '05':literal = 'MAYO';break;
      case '06':literal = 'JUNIO';break;
      case '07':literal = 'JULIO';break;
      case '08':literal = 'AGOSTO';break;
      case '09':literal = 'SEPTIEMBRE';break;
      case '10':literal = 'OCTUBRE';break;
      case '11':literal = 'NOVIEMBRE';break;
      case '12':literal = 'DICIEMBRE';break;
    };
    return literal;
  };

  $.ajax({
    url: "../api/aporte/getAportes",
    method: "POST",
    contentType: false,
    processData: false,
    dataType: 'JSON',
    success: function (response) {
      console.log(response);
      if(response.status == 'success'){
        var table = document.getElementById('tbody');
        var data = response.aportes;
        var i = data.length;
        var total = 0;
        data.forEach((aporte,n) => {
          const tr = document.createElement('tr');

          const index = document.createElement('td');
          index.textContent = i;
          index.align = 'center';

          const monto = document.createElement('td');
          monto.textContent = aporte.monto;
          monto.align = 'right';
          const mes = document.createElement('td');
          mes.textContent = getLiteralMonth(aporte.mes);
          mes.align = 'center';
          const gestion = document.createElement('td');
          gestion.textContent = aporte.gestion;
          gestion.align = 'center';
          const observacion = document.createElement('td');
          observacion.textContent = aporte.observacion;
          observacion.align = 'center';

          tr.appendChild(index);
          tr.appendChild(monto);
          tr.appendChild(mes);
          tr.appendChild(gestion);
          tr.appendChild(observacion);

          table.appendChild(tr);
          i--;
          total += parseFloat(aporte.monto);
        });
        document.getElementById('total-aportes').textContent = total;
      }else{
        console.log("Error...");
      }
    },
    error: function (xhr, status, error) {
      console.log(error, xhr, status);
    }
  });*/
});



function leerImagen() {
  const imagen = document.getElementById('perfil');
  var archivo = imagen.files[0];
  var xx = archivo.name;
  var ext = xx.split('.').pop();
  ext = ext.toLowerCase();
  // console.log(xx, ext);
  if (ext == "jpg" || ext == "png" || ext == "jpeg") {
    processfile(archivo);
  } else {
    $("#file-previ").val('');
    alertify.error('Formato de archivo no valido');
  }
}
function processfile(file) {
  const imagen = document.getElementById('imagen');
  const objectURL = URL.createObjectURL(file);
  imagen.src = objectURL;

  // Enviar el archivo al servidor

  var formData = new FormData();

  // Agregar el archivo de imagen al objeto FormData
  formData.append("imagen", file);

  // Hacer la solicitud AJAX con $.ajax
  $.ajax({
    url: "image.php",
    method: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      console.log(response);
    },
    error: function (xhr, status, error) {
      console.log(error, xhr, status);
    }
  });
}
const obtenerDatos = async () => {
  try {
    const response = await fetch('../session/session.php');
    if (!response.ok) {
      throw new Error('Error al obtener los datos de sesión.');
    }
    const datosSesion = await response.json();
    console.log(datosSesion);
    email = datosSesion['email'];
    celular = datosSesion['celular'];
  } catch (error) {
    console.log(error);
    return -1;
  }
  return 1;
}
const terminarSesion = async () => {
  try {
    const response = await fetch('../session/fin-session.php', {
      method: 'POST',
      body: JSON.stringify({ variable: 'nombre' }),
      headers: { 'Content-Type': 'application/json' }
    });

    if (!response.ok) {
      throw new Error('Error al destruir la sesión.');
    }

    const resultado = await response.json();
    console.log(resultado);
    window.location.href = "../auth/"
  } catch (error) {
    console.log(error);
  }
}

$(".btn-perfil").click(async () => {
  const res = await obtenerDatos();
  console.log(res)
  if (res == 1) {
    const { value: formValues } = await Swal.fire({
      title: 'Edita tu perfil',
      html:
        '<label>Correo Electrónico</label><input type="email" id="email" class="swal2-input" value="' + email + '">' +
        '<label>Teléfono - Celular</label><input id="celular" class="swal2-input" value="' + celular + '">' +
        '<textarea id="about" placeholder="Algo sobre tí" cols="30" rows="10"></textarea>',
      focusConfirm: false,
      preConfirm: () => { //antes de confirmar
        return [
          document.getElementById('celular').value,
          document.getElementById('email').value,
          document.getElementById('about').value
        ]
      }
    })

    if (formValues) {
      //Verificamos que haya cambiado los datos
      if (email != formValues[1] || celular != formValues[0] || formValues[2] != "") {
        // Actualizamos usuario
        let parametros = {
          "celular": formValues[0],
          "email": formValues[1],
          "sobremi": formValues[2]
        }
        $.ajax({
          type: "POST",
          url: "./updateUser.php",
          data: parametros,
          success: function (html) {
            console.log(html);
            setTimeout(() => {
              if (html == 1) {
                Swal.fire("Registro Correcto")
                setTimeout(() => {
                  location.reload();
                }, 1000);
              } else {
                console.log("OCURRIO ERROR");
                Swal.fire({
                  icon: 'error',
                  title: 'UPS!',
                  text: 'Ocurrió un error!'
                })
              }
            }, 1000);
          },
          beforeSend: function () {
          }
        });
      }
    }
  }

});

$("#exit").click(() => {
  terminarSesion();
});

$("#modal_misprestamos").on('show.bs.modal', async () => {
  try {
    const res = await $.ajax({
      url: `../api/prestamo/prestamoUsuario`,
      type: "GET",
      dataType: "json"
    })
    if(res.status === 'success'){
      const data = armarTablaPrestamos(res.prestamos)
      $("#t_body_prestamos").html(data)
    }
  } catch (error) {
    console.log(error)
  }
})


function armarTablaPrestamos(data){
  let cadena = data.length > 0 ? '':'<td colspan="8">NO hay registros de prestamos</td>';
  for(let i = 0; i < data.length; i++){
    let fecha = new Date(data[i].fechaSolicitud);
    fecha = fecha.toLocaleDateString();
    let fecha2 = data[i].fechaPrestamo != null ? new Date(data[i].fechaPrestamo):null;
    fecha2 = fecha2 != null ? fecha2.toLocaleDateString() : 'Sin pago realizado';
    cadena += `
    <tr>
      <td>${data[i].tipoPrestamo}</td>
      <td>${data[i].monto}</td>
      <td>${data[i].plazo} meses</td>
      <td>${data[i].motivo}</td>
      <td>${fecha}</td>
      <td>${fecha2}</td>
      <td>${data[i].g1}</td>
      <td>${data[i].g2}</td>
      <td>${data[i].estado}</td>
    </tr>
    `
  }
  return cadena;
}