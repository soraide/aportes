
function send_data(carpeta, msg, tipo, nombre_form) {

  $("#shadow").fadeIn("normal");
  $("#spinner").html(`<div class='spinner-container'>
                                        <div class="spinner-path">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        </div>
                                    </div>`);
  const peticion = new XMLHttpRequest();
  var data = new FormData();
  data = getFormData(nombre_form, data);
  // for (var value of data.values()) {
  //   console.log(value);
  // }
  peticion.open("POST", "../" + carpeta + "/" + tipo + ".php");
  peticion.send(data);
  peticion.onload = function () {

    console.log("respuesta:" + this.responseText);
    if (this.responseText == 1) {
      alertify.success(msg);
      var carpeta_activa = document.getElementById("carpeta-activa").value;

      if (carpeta_activa == "avance") {
        listar_avance(1);
      }

      else if (carpeta_activa == "contenido") {
        listar_contenido(1);
      }

      else if (carpeta_activa == "curso") {
        listar_curso(1);
      }

      else if (carpeta_activa == "estudiante") {
        listar_estudiante(1);
      }

      else if (carpeta_activa == "miCurso") {
        listar_miCurso(1);
      }

      else if (carpeta_activa == "tema") {
        listar_tema(1);
      }

      else if (carpeta_activa == "modulo") {
        listar_modulo(1);
      }

      else if (carpeta_activa == "notas") {
        listar_notas(1);
      }

      else if (carpeta_activa == "usuario") {
        listar_usuario(1);
      }

      $("#buscador-general").show().animate({ "opacity": "1" }, 1000);
    } else if (this.responseText == 2) {
      alertify.error('Error');
    } else if (this.responseText == 7) {
      alertify.error('Registro repetido');
    }

    $("#shadow").fadeOut();
    $("#spinner").html(``);

  };

};


function getFormData(id, data) {

  $("#" + id).find("input,select,textarea").each(function (i, v) {
    if (v.type !== "file") {
      if (v.type === "checkbox" && v.checked === true) {
        data.append(v.name, "on");
      } else {
        // console.log("nombre:" + v.name + "-- valor:" + v.value);
        data.append(v.name, v.value);
      }
    }
  });

  for (let index = 1; index < 40; index++) {
    var testData = !!document.getElementById("textarea" + index);
    // console.log("Is Not null?",testData);
    if (testData) {
      var campo = document.getElementById("textarea" + index).getAttribute('name');
      var texto = $('#textarea' + index).html();
      data.append(campo, texto);
    }
  }

  return data;
}


// Ver encuesta previa 
function verEncuestaPrevia(){
  remove();

  $("#all-body").html(`
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-12">
          <h1 class="m-2">Encuesta previa</h1>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row" >
        <div class="col-md-12" id="encuesta-previa"></div>
      </div>
    </div>
  </section>`);
  $.ajax({
    type:"POST",
    url:"../contenido/encuestaPrev.php",
    success: function(res){
      $("#encuesta-previa").html(res)
    }
  })
}