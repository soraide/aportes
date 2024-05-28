
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
      url: "../../api/gestion/get",
      type: "GET",
      dataType: "html",
    });
    $("#afiliados").html(data);
    $('#t_gestiones').DataTable({
      language: lenguaje,
      columnDefs: [
        { orderable: false, targets: [3] }
      ],
      order:[],
      "info": false,
      "scrollX": true,
      "scrollY": '50vh'
    });
  } catch (error) {
    console.log(error);
  }
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
      url: "../../api/gestion/create",
      data: data,
      type: "POST",
      dataType: "JSON",
      beforeSend: (data) => {
        console.log(ACCION, "Enviando datos...");
      },
      success: (response) => {
        if(response.success){
          alertify.success('El usuario fue aceptado con éxito');
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
          document.getElementById('id-rendimiento-edit').value = response.data.idGestion;
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
          alertify.success('Gestion modificada con  éxito');
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

  const removerGestion = (id, gestion) => {
    $('#modal-remover-gestion').modal('show');
    document.getElementById('modal-remover-gestion').dataset.id = id;
    $('#remover-gestion').text(gestion);
  }

  const eliminarGestion = () => {
    var id = document.getElementById('modal-remover-gestion').dataset.id;
    const ACCION = "ELIMINAR GESTIÓN";
    $.ajax({
      url: "../gestiones/services/remover_gestion.php",
      data: { 'idRendimiento' : id },
      type: "POST",
      dataType: "JSON",
      beforeSend: (data) => {
        console.log(ACCION, "Enviando datos...");
      },
      success: (response) => {
        if(response.success){
          listarGestiones();
          $('#modal-remover-gestion').modal('hide');
          alertify.success('Gestión eliminada con éxito');
        }
        console.log(ACCION, response.message);
      },
      error: (error) => {
        console.log(ACCION, error);
      }
    });
  };