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
        if (res.success) {
          $("#mensaje").hide().animate({ "opacity": "0", "bottom": "-80px"}, 0);
          $('#mensaje').removeClass('bg-info');
          $('#mensaje').addClass('bg-success');
          document.getElementById("mensaje").innerHTML = "¡Bienvenido!";
          $("#mensaje").show().animate({ "opacity": "1", "bottom": "-80px" }, 400);
          setTimeout(() => location.href = "../profile/", 1000);
        } else {
          $("#mensaje").hide().animate({ "opacity": "0", "bottom": "80px"}, 0);
          $('#mensaje').removeClass('bg-info');
          $('#mensaje').addClass('bg-danger');
          document.getElementById("mensaje").innerHTML = res.message;
          $("#mensaje").show().animate({ "opacity": "1", "bottom": "-80px" }, 400);
        }
      }, 1000);
    },
    beforeSend: function () {
      $("#mensaje").hide().animate({ "opacity": "0", "bottom": "-80px" }, 0);
      $('#mensaje').removeClass('bg-success');
      $('#mensaje').removeClass('bg-danger');
      $('#mensaje').addClass('bg-info');
      document.getElementById("mensaje").innerHTML = '<i class="fas fa-sync fa-spin"></i>';
      $("#mensaje").show().animate({ "opacity": "1", "bottom": "-80px" }, 400);
    }
  });

  return false;
  
});

document.getElementById('btn-obscure-password').onclick = ( ) => {
  const pass = document.getElementById('pass');
  const isObscure = pass.dataset.obscure == '1';
  pass.dataset.obscure = isObscure ? '0' : '1';
  pass.type = isObscure ? 'text' : 'password';
}