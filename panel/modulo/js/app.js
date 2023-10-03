
function listar_modulo(pag) {
  $("#buscador-general").show().animate({ "opacity": "1" }, 1000);

  var start = (pag - 1) * 10;
  var texto = $("#busqueda_modulo").val();
  var parametros = {
    "start": start,
    "texto": texto
  }


  var result1 = '';
  $.ajax({
    data: parametros,
    url: "../modulo/listamodulo.php",
    type: "post",
    success: function (response) {

      result1 = response;

      jQuery.ajax({
        type: "POST",
        url: "../modulo/generar_paginacion.php",
        data: parametros,
        dataType: "JSON",
        success: function (data) {

          $("#modulo-result").html(response + data.tabla);
          $('.pagination').pagination({
            items: data.records,
            itemsOnPage: 10,
            cssStyle: 'light-theme',
            currentPage: pag,
          });

          $('#pagina').val(pag);

        }, beforeSend: function () {
          $("#modulo-result").show();
          $("#modulo-result").html(`<div style="text-align:center">
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="spinner-border" role="status">
                                                                                <span class="visually-hidden"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
        }
      });


    }, beforeSend: function () {
      $("#modulo-result").show();
      $("#modulo-result").html(`<div style="text-align:center">
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="spinner-border" role="status">
                                                                            <span class="visually-hidden"></span>
                                                                    </div>
                                                                </div>
                                                            </div>`);
    }
  });
}

function modulo() {
  remove();
  document.getElementById("nav_modulo").className += " active";
  document.getElementById("carpeta-activa").value = "modulo";
  $("#shadow").fadeIn("normal");
  $("#spinner").html(`<div class="container">
                                                    <div class="loader-container">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    </div>
                                                </div>`);
  $.ajax({
    url: "../modulo/modulo.php",
    type: "post",
    success: function (response) {
      $("#shadow").fadeOut();
      $("#spinner").html(``);
      $("#all-body").html(response);
      listar_modulo(1);
    }
  });
}

function add_modulo() {
  $("#buscador-general").hide().animate({ "opacity": "0" }, 0);
  $("#modulo-result").hide().animate({ "opacity": "0", "bottom": "-80px" }, 0);
  $.ajax({
    url: "../modulo/add.php",
    type: "post",
    success: function (response) {
      $("#modulo-result").show().animate({ "opacity": "1", "bottom": "-80px" }, 1000);
      $("#modulo-result").html(response);

      let form = document.getElementById("add_modulo");
      form.addEventListener("submit", function (event) {
        event.preventDefault();
        send_data("modulo", "Guardado", "add_insert", "add_modulo");
      });

    }, beforeSend: function () {
    }
  });
}

function edit_modulo(id) {
  $("#buscador-general").hide().animate({ "opacity": "0" }, 0);
  $("#modulo-result").hide().animate({ "opacity": "0", "bottom": "-80px" }, 0);

  var parametros = {
    "id": id
  }

  $.ajax({
    data: parametros,
    url: "../modulo/edit.php",
    type: "post",
    success: function (response) {
      $("#modulo-result").show().animate({ "opacity": "1", "bottom": "-80px" }, 1000);
      $("#modulo-result").html(response);

      let form = document.getElementById("edit_modulo");
      form.addEventListener("submit", function (event) {
        event.preventDefault();
        send_data("modulo", "Actualizado", "edit_insert", "edit_modulo");
      });

    }
  });
}

$("#modal_eliminar_modulo").on("show.bs.modal", function (e) {
  var id = $(e.relatedTarget).data().id;
  $("#id_modulo").val(id);
});

function borrar_modulo(id) {

  $("#shadow").fadeIn("normal");
  $("#spinner").html(`<div class="spinner-container">
                                                    <div class="spinner-path">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    </div>
                                                </div>`);

  var parametros = {
    "id": id
  }

  pag = parseInt($('#pagina').val());
  if (pag == 0) {
    pag = 1;
  }

  $.ajax({
    data: parametros,
    url: "../modulo/eliminar.php",
    type: "post",
    success: function (response) {
      $("#shadow").fadeOut();
      $("#spinner").html(``);
      if (response == 1) {
        alertify.success("Registro eliminado");
        listar_modulo(pag);
      } else if (response == 2) {
        alertify.error("Error");
      }
    }
  });

}

function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
  results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}