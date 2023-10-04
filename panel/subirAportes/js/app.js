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
    "<div class='d-flex flex-row justify-content-end'>" +
    "<span class='mr-2 pl-2 pr-2 flex-grow-1' style='font-size: 120%;'>" +
    archivoNombre +
    "</span>" +
    '<button id="botonActualizar" class="btn btn-success mr-2" onclick="procesarExcel()"><i class="fa fa-save mr-2" aria-hidden="true"></i> Guardar</button>' +
    '<button class="btn btn-danger" onclick="quitarExcel()"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Quitar</button>' +
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