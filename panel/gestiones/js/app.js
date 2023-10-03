
async function listarGestiones() {
    remove();
    document.getElementById("nav_gestiones").className += " active";
    document.getElementById("carpeta-activa").value = "gestiones";
    try {
      const res = await $.ajax({
        url: "../gestiones/headerGestiones.php",
        type: "GET",
        dataType: "html",
      });
      $("#all-body").html(res);
      const data = await $.ajax({
        url: "../gestiones/services/listar_gestiones.php",
        type: "GET",
        dataType: "json",
      });
      const contenido = generaFilasGestion(data);
      $("#t_body_gestiones").html(contenido);
    } catch (error) {
      console.log(error);
    }
  }
  
  function generaFilasGestion(data) {
    let filas = '';
    for (let index = 0; index < data.length; index++) {
      const element = data[index];
      let fecha = new Date(element.fechaNac);
      fecha = fecha.toLocaleDateString();
      filas += `
        <tr>
          <td>${element.idRendimiento}</td>
          <td>${element.gestion}</td>
          <td>${element.rendimiento}</td>
          <td align="center">${ (new Date().getFullYear()) == element.gestion ? `<button class="btn btn-info" onclick="obtenerGestion(${ element.idRendimiento })">Editar</button>` : 'No disponible' }</td>
        </tr>
      `;
    }
    return filas;
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

  document.getElementById('form-registrar-gestion').onsubmit = (e) => {
    e.preventDefault();
    let data = {
      'gestion' : document.getElementById('gestion-add').value,
      'rendimiento' : document.getElementById('rendimiento-add').value
    }
    registrarGestion(data);
  };

  document.getElementById('form-editar-gestion').onsubmit = (e) => {
    e.preventDefault();
    let data = {
      'idRendimiento' : document.getElementById('id-rendimiento-edit').value,
      'gestion' : document.getElementById('gestion-edit').value,
      'rendimiento' : document.getElementById('rendimiento-edit').value
    }
    actualizarGestion(data);
  };

  const registrarGestion = (data) => {
    const ACCION = "REGISTRAR GESTIÓN";
    $.ajax({
      url: "../gestiones/services/adicionar_gestion.php",
      data: data,
      type: "POST",
      dataType: "JSON",
      beforeSend: (data) => {
        console.log(ACCION, "Enviando datos...");
      },
      success: (response) => {
        if(response.success){
          listarGestiones();
          $('#modal-adicionar-gestion').modal('hide');
        }
        console.log(ACCION, response.message);
      },
      error: (error) => {
        console.log(ACCION, error);
      }
    });
  };

  const obtenerGestion = (id) => {
    const ACCION = "OBTENER GESTIÓN";
    $.ajax({
      url: "../gestiones/services/obtener_gestion.php",
      data: { 'idRendimiento' : id },
      type: "GET",
      dataType: "JSON",
      beforeSend: (data) => {
        console.log(ACCION, "Enviando datos...");
      },
      success: (response) => {
        console.log(response);
        if(response.success){
          $('#modal-editar-gestion').modal('show');
          document.getElementById('id-rendimiento-edit').value = response.data.idRendimiento;
          document.getElementById('gestion-edit').value = response.data.gestion;
          document.getElementById('rendimiento-edit').value = response.data.rendimiento;
        }
        console.log(ACCION, response.message);
      },
      error: (error) => {
        console.log(ACCION, error);
      }
    });
  };

  const actualizarGestion = (data) => {
    const ACCION = "ACTUALIZAR GESTIÓN";
    $.ajax({
      url: "../gestiones/services/actualizar_gestion.php",
      data: data,
      type: "POST",
      dataType: "JSON",
      beforeSend: (data) => {
        console.log(ACCION, "Enviando datos...");
      },
      success: (response) => {
        if(response.success){
          listarGestiones();
          $('#modal-editar-gestion').modal('hide');
        }
        console.log(ACCION, response.message);
      },
      error: (error) => {
        console.log(ACCION, error);
      }
    });
  };