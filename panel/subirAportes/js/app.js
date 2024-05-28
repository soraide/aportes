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
  var archivoInput = document.getElementById('archivo-excel');
  var archivoNombre = archivoInput.files[0].name;

  var divArchivoSubido = document.getElementById("archivoExcelSubido");
  divArchivoSubido.innerHTML = `
    <div class="d-flex p-3">
      <span class="text-bold text-secondary m-0">
      <i class="fa fa-file-excel mr-2" aria-hidden="true"></i>${archivoNombre}
      </span> 
    </div>
    <div class="d-flex bd-highlight">
      <button id="botonActualizar" class="btn btn-success mr-2 flex-fill bd-highlight" onclick="procesarExcel()"><i class="fa fa-save mr-2" aria-hidden="true"></i> Guardar</button>
      <button class="btn btn-danger flex-fill bd-highlight" onclick="quitarExcel()"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Quitar</button>
    </div>
  `;
}

function procesarExcel() {
  // Aquí puedes realizar las acciones para procesar el Excel sin cambiar de página
  console.log("Procesando el Excel...");
  mostrarLoader();
  var archivoInput = document.getElementById('archivo-excel');
  var fechaInput = document.getElementById('mes-gestion');
  var archivo = archivoInput.files[0];
  var fecha = fechaInput.value;

  var formData = new FormData();
  formData.append("archivo", archivo);
  formData.append("fecha", fecha);

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

  var archivoInput = document.getElementById('archivo-excel');
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