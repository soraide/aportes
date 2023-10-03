$(".login").on('submit', () =>{
  username = $("#user").val();
  password = $("#pass").val();

  parametros = {
    "correo": username,
    "password": password
  }
  console.log(parametros);

  $.ajax({
    type: "POST",
    url: "../api/socio/auth",
    data: parametros,
    dataType: "json",
    success: function (res) {
      console.log(res);
      setTimeout(() => {
        if (res.status == 'success') {

          $("#mensaje").hide().animate({ "opacity": "0", "bottom": "-80px"}, 0);
          $("#mensaje").css("background-color", "#2ecc71");
          document.getElementById("mensaje").className = "feedback";
          document.getElementById("mensaje").innerHTML = "Bienvenido!";
          $("#mensaje").show().animate({ "opacity": "1", "bottom": "-80px" }, 400);
          $("input").css({ "border-color": "#2ecc71" });

          setTimeout(() => {
            location.href = "../profile/";
          }, 1000);
        } else {
          $("#mensaje").hide().animate({ "opacity": "0", "bottom": "80px"}, 0);
          $("#mensaje").css("background-color","#e90505");
          
          document.getElementById("mensaje").innerHTML = "Usuario o contraseña incorrecta";
          $("#mensaje").show().animate({ "opacity": "1", "bottom": "-80px" }, 400);
          $("input").css({ "border-color": "#e90505" });
          
          $("input").on("focus",()=>{
            $("input").css({ "border": "1px solid #bdbdbd" });
          })
        }
      }, 1000);
    },
    beforeSend: function () {

      $("#mensaje").hide().animate({ "opacity": "0", "bottom": "-80px" }, 0);
      document.getElementById("mensaje").className = "carga";
      document.getElementById("mensaje").innerHTML = '<i class="fas fa-sync fa-spin"></i>';
      $("#mensaje").show().animate({ "opacity": "1", "bottom": "-80px" }, 400);
      // $("input").css({ "border-color": "#1f9cd6" });
    }
  });

  return false;
});