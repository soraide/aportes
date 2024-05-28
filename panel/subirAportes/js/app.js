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
  const fecha = (fechaInput.value).split('-');

  var formData = new FormData();
  formData.append("file", archivo);
  formData.append('mes', fecha[1]);
  formData.append('gestion', fecha[0]);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../api/reportexlsx/registrarAportes", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Aquí se puede manejar la respuesta del servidor después de procesar el archivo
      var respuesta = JSON.parse(xhr.responseText);
      if(respuesta.success){
        ocultarLoader();
        // Limpiar el input de archivo
        archivoInput.value = null;
        var divArchivoSubido = document.getElementById("archivoExcelSubido");
        divArchivoSubido.innerHTML = '';
        const unregistered = respuesta.data.unregistered;
        const nroRegistros = respuesta.data.nroRegistrados;
        $observaciones = `
          <li class="list-group-item text-success">Aportes registrados: ${nroRegistros}</li>
        `;
        if(unregistered.length > 0){
          unregistered.forEach((socio) => {
            $observaciones += `
              <li class="list-group-item text-danger">Usuario no registrado: ${socio.nombre} [Codigo: ${socio.codigo}], en la fila ${socio.row}</li>
            `;
          });
        }
        document.getElementById('observaciones').innerHTML = $observaciones;
      }
      ocultarLoader();
      Swal.fire({
        title: 'Subir Excel Aportes',
        text: respuesta.message,
        icon: respuesta.success ? 'success' : 'warning',
      });
      quitarExcel();
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