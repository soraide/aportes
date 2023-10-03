// $("a").removeClass("active");
$("#registrar").hide();
$("#ingresar").hide();
$("#logo").hide();
$("#miscursos").hide();

$.ajax({
    type: "POST",
    url: "../session/verSesion.php",
    success: function (html) {
        console.log(html);
        setTimeout(() => {
            if (html == 1) {
                $("#logo").show(10);
                $("#miscursos").show(600);
                // console.log("EXISTE UNA SESIÓN")
            }else{
                $("#registrar").show(600);
                $("#ingresar").show(600);
            }
        }, 1000);
    },
    beforeSend: function () {

    }
});