var valor = '';
var idActual = -1;
var tipoActual = '';
var player = null;
$(document).ready(()=>{
  const menu = $('#menu');
  const seccion = $("#content");
  const botonContenido = $("#sig");
  var res = [];
  var ids = [];
  var lenRes = 0;
  var indiceContenido = 0;
  var avanzado = true;
  // var player = null;

  menu.click((event) => {
    const valor = event.target;
    if(valor.classList.value == 'tema' && avanzado){
      if($(valor).attr('data-ok') == 'ok'){
        console.log('ENTRO a peticion terminado');
        $.ajax({
          url: './controller/todoContenido.php?idTema='+valor.id.substr(1),
          type: 'GET',
          success: function (response) {
            seccion.html(response);
            botonContenido.hide();
            avanzado = true;
          },
          error: function (xhr, status, error) {
            console.log(error);
          }
        });
      }else{
        avanzado = false;
        seccion.empty();
        res = [];
        lenRes = 0;
        indiceContenido = 0;
        $.ajax({
          url: './controller/temas.php?idTema='+valor.id.substr(1),
          type: 'GET',
          dataType: 'json',
          success: function (response) {
            res = response.contenido;
            ids = response.ids;
            console.log(ids)
            lenRes = res.length;
            appendContent();
          },
          error: function (xhr, status, error) {
            console.log(error);
          }
        });
      }
    }else{
      if(valor.classList.value == 'tema'){
        Swal.fire({
          icon: 'warning',
          title: 'Termina el tema actual',
          showConfirmButton: true,
          timer: 1800
        });
      }
      console.log('Debe terminar el Avance');
    }
  });
  
  function appendContent(){
    if(indiceContenido < lenRes){
      console.log(`Se muestra el contenido ${indiceContenido} el ID es ${ids[indiceContenido][0]} , el tipo de contenido es ${ids[indiceContenido][1]}`);
      seccion.append(res[indiceContenido]);
      tipoContenido();
      document.getElementsByTagName('body')[0].scrollIntoView({ behavior: 'smooth', block: 'end' });
      indiceContenido++;
      eventsControll(indiceContenido-1);
    }else{
      avanzado = true;
      Swal.fire(
        '¡Buen Trabajo!',
        'Terminaste el tema',
        'success'
      );
      setTimeout(()=>{
        location.reload();
      }, 1900)
    }
  }

  function tipoContenido(){
    if(ids[indiceContenido][1] == 'video'){
      console.log(`Es video`)
      $("#sig").hide();
      idActual = ids[indiceContenido][0];
      return createYTObject();
    }else{
      botonContenido.show();
    }

  }
  /**
  eventsControll declaramos el estado actual.
  valores actuales 
    TIPO
    RESPUESTA (VALOR)
  */
  function eventsControll(actual){    
    idActual = ids[actual][0];
    tipoActual = ids[actual][1];
    // Evento para encuesta
    $(`#btns${idActual}`).on('click', '.btn', (event)=>{
      // console.log('CLICK En el boton')
      var boton = $(event.currentTarget);
      $(`.btn-group${idActual} .btn`).removeClass('btn-primary').addClass('btn-default');
      boton.removeClass('btn-default').addClass('btn-primary').addClass('active');
      // valor = boton.children().first().val();
      valor = boton;
    });
    
    // Evento Control foro 
    $(`#btn-foro${idActual}`).click(()=>{
      valor = $(`#respuesta${idActual}`).val();
      // console.log("CLICK EN ENVIAR+++++++++----VALOR   ",valor);
      $(`#respuesta${idActual}`).prop('disabled', true);
    })  
  }

  function createYTObject() {
    let video = document.getElementById('ytplayer');
    if (typeof window.YT !== 'undefined' && window.YT && typeof window.YT.Player !== 'undefined' && video != null) {
      player = new YT.Player('ytplayer', {
        events: {
          'onStateChange': eventos
        }
      });
      setTimeout(verificaExistencia,3000) //esperamos 3 segundos para saber si existe el video
    } else {
      setTimeout(createYTObject, 100);
    }
  }
  function eventos(event) {
    if (event.data == YT.PlayerState.PLAYING) {
      console.log('Video inició la reproducción');
    }
    if (event.data == YT.PlayerState.ENDED) {
      console.log('Video terminó la reproducción');
      // player.destroy();
      if(player.removeEventListener){
        player.removeEventListener('onStateChange', eventos);
        player = Object();
        $('#ytplayer').prop('id', '')
        registroAvance('video','', idActual);
        return appendContent();
      }
    }
  }

  

  botonContenido.click(function (){
    console.log(`Se registrará el tipo ${tipoActual}\nValor actual ${valor}\nID-Contenido Actual ${idActual}`)
    if(valor == '' && tipoActual == 'encuesta'){
      return Swal.fire({
        icon: 'warning',
        title: 'Selecciona una opción',
        showConfirmButton: false,
        timer: 1200
      })
    }
    registroAvance(tipoActual, valor, idActual);
    tipoActual = '';
    valor = '';
    idActual = -1;
    console.log(`Cambiando al contenido # ${indiceContenido}`)
    appendContent();
  })

  function verificaExistencia(){
    if(!player.playerInfo.availableQualityLevels.length > 0){
      console.log('NO existe video. Cambio de contenido')
      player.removeEventListener('onStateChange', eventos);
      player = Object();
      $('#ytplayer').prop('id', '')
      registroAvance('video','', idActual);
      return appendContent();
    }
  }

});
/* Fin Onload()*/

function registroAvance(tipo, value, id){

  let val = '';
  if(tipo == 'encuesta'){
    val = value.children().first().val();
    $(`.btn-group${id} .btn`).prop('disabled', true);
    $(`.btn-group${id} .btn`).addClass('disabled');
    $('#btn-enc'+id).show()
  }else if(tipo == 'seleccion'){
    if(value.children().first().val() == 'no'){
      value.removeClass('btn-primary').addClass('btn-danger');
      $("#correct").removeClass('btn-default').addClass('btn-success')
    }else{
      $("#correct").removeClass('btn-primary').addClass('btn-success')
    }
    $(`.btn-group${id} .btn`).prop('disabled', true);
    $(`.btn-group${id} .btn`).addClass('disabled');
  }
  if(tipo != 'foro'){
    let params = {val, id};
    $.ajax({
      type: "POST",
      url: "./controller/updateAvance.php",
      data: params,
      success: function (res) {
        console.log('Actualizado', res);
      },
    });
  }
  
}
function foroResp(mostrar, self, idContenido){
  $(self).prop('disabled', true);
  setTimeout(() => {
    console.log(valor, idActual, tipoActual);
    let params = {"val":valor,"id":idActual};
    $.ajax({
      type: "POST",
      url: "./controller/updateAvance.php",
      data: params,
      success: function (res) {
        console.log('Actualizado desde FORO', res);
      },
    });
  }, 700);
  Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Respuesta registrada',
    showConfirmButton: false,
    timer: 1000
  });
  if(mostrar == 'SI'){
    console.log("FORO PUBLICO PARA VER RESPUESTAS", idContenido)
    $("#btn-ver"+idContenido).show();
  }
}
function respuestas(idCont){
  $.ajax({
    type: "POST",
    url: "./controller/foro-resp.php",
    data: {
      "idContenido": idCont
    },
    success: function (res) {
      $("#verForo"+idCont).html(res);
    },
  });
}

function verEncuesta(idCurso){
  $.ajax({
    type: "POST",
    url: "./controller/encuesta_previa.php",
    data: {idCurso},
    success: function (html) {
      $("#content").html(html);
    },
  });

  setTimeout(()=>{
    let formulario = document.getElementById("enc1043");
    formulario.addEventListener("submit", function (event) {
      event.preventDefault();
      let enc1 = $('input[name="enc1"]:checked').val();
      let enc2 = $("#enc2").val();
      let enc3 = $('input[name="enc3"]:checked').val();
      enc3 = enc3 == 'otros' ? $("#otros3").val() : enc3;
      let enc4 = $('input[name="enc4"]:checked').val();
      let enc5 = $('input[name="enc5"]:checked').val();
      enc5 = enc5 == 'otros' ? $("#otros5").val() : enc5;
      let enc6 = $("#enc6").val();
      $.ajax({
        type: "POST",
        url: "./controller/procesa_encuesta.php",
        data: {enc1,enc2,enc3,enc4,enc5,enc6},
        success: function (res) {
          if(res.trim() == '1'){
            Swal.fire(
              '¡Muy bien!',
              'Se registraron tus respuestas',
              'success'
            );
            document.getElementById("encuestaprevia").style.display = 'none';
            setTimeout(() => location.reload(), 1200)
          }else{
            console.log("FAIL\n",res.trim())
          }
        },
      });
    });
  }, 1000)
  
}

function verResultadosEnc(idContenido){
  let html = `<canvas id="grafico${idContenido}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>`;
  $("#resEncuesta"+idContenido).html(html)
  $.ajax({
    type: "POST",
    url: "./controller/resultadosEncuesta.php",
    dataType:'json',
    data: {
      "idContenido": idContenido
    },
    success: function (res) {
      if(res.success){
        let nom = [];
        let cant = [];
        res.data.forEach(row => {
          nom.push(row.respuesta)
          cant.push(row.cantidad)
        });
        graficarDonutChart(idContenido, nom, cant);
      }else{
        console.log('ERROR', res.data);
      }
    },
  });
  console.log('Recuperar resultados de encuesta con id ', idContenido)
}

function graficarDonutChart(id, labels, cantidades){
  let cantidad = labels.length;
  // Colores, unicamente 7
  let colores = ["#f56954", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc", "#d2d6de", "#03bf0f"];
  var donutChartCanvas = $("#grafico"+id).get(0).getContext("2d")
  var donutData        = {
    labels: labels,
    datasets: [
      {
        data: cantidades,
        backgroundColor : [... colores.slice(0, cantidad)],
      }
    ]
  }
  var donutOptions     = {
    maintainAspectRatio : false,
    responsive : true,
  }
  new Chart(donutChartCanvas, {
    type: "doughnut",
    data: donutData,
    options: donutOptions
  })
}

function getPlayer(){
  return player;
}
