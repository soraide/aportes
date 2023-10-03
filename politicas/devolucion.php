<?php
session_start();
$sesion = false;
if(isset($_SESSION['idSocio'])){
  $sesion=true;
  $img  = file_exists('../images/users/'.$_SESSION['idSocio'].'.jpg') ? '../images/users/'.$_SESSION['idSocio'].'.jpg': '../images/users/default.jpg';
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="​Happiness &amp;amp; Mindfulness Courses, Welcome Message, Benefits of working with us​, 01, 02, 03, 04, 05, 06, ​How Coaching Works, ​How and where to learn mindfulness, Meet The Team
Our Professionals, ​Start using Our App for free">
  <meta name="description" content="">
  <title>Devolución</title>
  <link rel="stylesheet" href="../static/css/nicepage.css" media="screen">
  <link rel="stylesheet" href="../static/css/Inicio.css" media="screen">
  <script class="u-script" type="text/javascript" src="../static/js/jquery.js"></script>
  <script class="u-script" type="text/javascript" src="../static/js/nicepage.js" defer=""></script>
  
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "Aprendizaje",
  "logo": "images/logo_en.png",
  "sameAs": []
}</script>
  <meta name="theme-color" content="#243f56">
  <meta property="og:type" content="website">
<meta data-intl-tel-input-cdn-path="intlTelInput/">
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
  rel="stylesheet"
/>
</head>
  <body class="u-body u-xl-mode" data-lang="es">

    <?php 
    if($sesion){
      include('../common/header-log.php');
    }else{
      include('../common/header.php');
    }
    ?>
    <section class="u-align-center u-clearfix u-section-1" id="sec-dda1" style="height:auto;">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="container col-auto text-center" data-animation-name="customAnimationIn" data-animation-duration="1200" data-animation-delay="500" data-lang-en="Meet The Team">
          <h2 class="u-custom-font u-font-montserrat u-text u-text-default u-text-1"> Políticas de devolución
          </h2>
          <br>
          <p style="color:#243f56;font-family:'Open Sans';text-align:justify;">En Mining Business School, nos esforzamos por brindarte la mejor experiencia de aprendizaje en línea. Entendemos que pueden surgir situaciones en las que necesites realizar una devolución, y estamos aquí para ayudarte. A continuación, te presentamos nuestras políticas de devolución:</p>
          <p style="color:#243f56;font-family:'Open Sans';text-align:justify;margin-left:10px;"> <b>1. Plazo de devolución:</b> Tienes un plazo de 30 días a partir de la fecha de compra para solicitar una devolución.</p>
          <p style="color:#243f56;font-family:'Open Sans';text-align:justify;margin-left:10px;"> <b>2. Condiciones de devolución:</b> Para que podamos procesar tu solicitud de devolución, el curso o programa adquirido debe cumplir con las siguientes condiciones:
          <ul style="color:#243f56;font-family:'Open Sans';text-align:left;margin-left:20px;">
            <li> No haber transcurrido más de 30 días desde la fecha de compra.</li>
            <li> No haber completado más del 5% del contenido del curso o programa.</li>
            <li> No haber obtenido un certificado o acreditación vinculada al curso o programa. </li>
          </ul>
        </p>
          <p style="color:#243f56;font-family:'Open Sans';text-align:justify;margin-left:5px;">  <b>3. Proceso de devolución:</b> Si cumples con las condiciones mencionadas anteriormente y deseas solicitar una devolución, por favor contáctanos a través de nuestro servicio de atención al cliente. Te guiaremos en el proceso y te proporcionaremos la asistencia necesaria para completar tu solicitud de devolución.</p>
          <p style="color:#243f56;font-family:'Open Sans';text-align:justify;margin-left:5px;"><b>4. Reembolso:</b> Una vez aprobada tu solicitud de devolución, procederemos a realizar el reembolso correspondiente. Ten en cuenta que el tiempo de procesamiento puede variar según el método de pago utilizado. Si el pago se realizó mediante tarjeta de crédito o débito, el reembolso se reflejará en tu cuenta en un plazo de 5 a 10 días hábiles.</p>
        </div>
      </div>
    </section>
    
    
    
    <?php include('../common/footer.php'); ?>
</body>
</html>