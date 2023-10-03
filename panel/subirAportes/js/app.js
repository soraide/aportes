async function subirAportes() {
  console.log("estas en subir aportes");
  remove();
  document.getElementById("nav_subir_aportes").className += " active";
  document.getElementById("carpeta-activa").value = "subirAportes";
  try {
    const res = await $.ajax({
      url: "../subirAportes/headerSubirAportes.php",
      type: "GET",
      dataType: "html",
    });
    $("#all-body").html(res);
  } catch (error) {
    console.log(error);
  }
}

function subirArchivo() {
  var archivoInput = document.getElementById("inputArchivo");
  var archivoNombre = archivoInput.files[0].name;

  var divArchivoSubido = document.getElementById("archivoExcelSubido");
  divArchivoSubido.innerHTML =
    "<div class='row'>" +
    "<div class='col-sm-8'><span style='font-size: 120%;'>" +
    archivoNombre +
    "</span></div>" +
    '<div class="col-sm-2"><button id="botonActualizar" class="btn btn-success" onclick="procesarExcel()"><span class="glyphicon glyphicon-ok"></span> Guardar</button></div>' +
    '<div class="col-sm-2"><button class="btn btn-danger" onclick="quitarExcel()"><span class="glyphicon glyphicon-remove"></span> Quitar</button></div>' +
    '</div>';
}

function procesarExcel() {
  // Aquí puedes realizar las acciones para procesar el Excel sin cambiar de página
  console.log("Procesando el Excel...");
  mostrarLoader();
  var archivoInput = document.getElementById("inputArchivo");
  var fechaInput = document.getElementById("inputFecha");
  var archivo = archivoInput.files[0];
  var fecha = fechaInput.value;

  var formData = new FormData();
  formData.append("archivoExcel", archivo);
  formData.append("fechaInput", fecha);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../subirAportes/guardarAportes.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Aquí se puede manejar la respuesta del servidor después de procesar el archivo
      var respuesta = JSON.parse(xhr.responseText);
      if (respuesta.status) {
        // console.log('se envió correctamente el archivo excel!')
        // console.log(respuesta.mensaje)
        ocultarLoader();
        Swal.fire({
          text: respuesta.mensaje,
          icon: "success",
        });
        // Limpiar el input de archivo
        archivoInput.value = null;
        var divArchivoSubido = document.getElementById("archivoExcelSubido");
        divArchivoSubido.innerHTML = '';
      } else {
        ocultarLoader();
        Swal.fire({
          text: respuesta.mensaje,
          icon: "warning",
        });
      }
    }
  };
  xhr.send(formData);
}

function quitarExcel() {
  var divArchivoSubido = document.getElementById("archivoExcelSubido");
  divArchivoSubido.innerHTML = "";

  var archivoInput = document.getElementById("inputArchivo");
  archivoInput.value = ""; // Limpiar el campo de entrada de archivo
}

function mostrarLoader() {
  console.log("estas en mostrarLoader");
  $("#botonActualizar").html(
    '<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Cargando...'
  );
  document.getElementById("loader2").style.display = "block";
}

function ocultarLoader() {
  $("#botonActualizar").html(
    '<span class="glyphicon glyphicon-ok"></span> Actualizar'
  );
  document.getElementById("loader2").style.display = "none";
}

const descargarExcelAportes = () => {
  var fecha = document.getElementById('fecha-aporte').value;
  var url = "../subirAportes/exportarAportesExcel.php";
  var form = document.createElement("form");
  form.setAttribute("method", "post");
  form.setAttribute("action", url);
  form.setAttribute("target", "_blank");
  form.innerHTML = `
        <input type="hidden" name="fechaAporte" value="${fecha}">
    `;
  document.body.appendChild(form);
  form.submit();
  form.remove();
}