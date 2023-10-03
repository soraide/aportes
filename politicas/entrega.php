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
  <title>Politicas de entrega</title>
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
          <h2 class="u-custom-font u-font-montserrat u-text u-text-default u-text-1"> Políticas de entrega
          </h2>
          <br>
          <p style="color:#243f56;font-family:'Open Sans';text-align:justify;"> En Mining Business School, nos comprometemos a brindarte un servicio eficiente y oportuno en la entrega de nuestros cursos en línea. A continuación, te presentamos nuestras políticas de entrega:</p>
          <p style="color:#243f56;font-family:'Open Sans';text-align:justify;margin-left:10px;"><b>1. Acceso inmediato:</b> Una vez que completes el proceso de compra, recibirás un correo electrónico de confirmación con los detalles de acceso al curso o programa adquirido. Podrás acceder al contenido de manera inmediata y comenzar tu aprendizaje. </p>
          <p style="color:#243f56;font-family:'Open Sans';text-align:justify;margin-left:10px;"><b>2. Disponibilidad del contenido:</b> El acceso al contenido del curso o programa adquirido estará disponible durante un período determinado, que variará según el curso o programa específico. Te recomendamos revisar la descripción del curso o programa para obtener información detallada sobre la duración del acceso.</p>
          <p style="color:#243f56;font-family:'Open Sans';text-align:justify;margin-left:10px;"><b>3. Soporte técnico:</b> Nuestro equipo de soporte técnico está disponible para brindarte asistencia en caso de que encuentres algún problema técnico durante el proceso de acceso al contenido. Puedes contactarnos a través de nuestro servicio de atención al cliente y te responderemos lo más pronto posible para resolver cualquier inconveniente que puedas tener. </p>
          <p style="color:#243f56;font-family:'Open Sans';text-align:justify;margin-left:10px;"><b>4. Actualizaciones del contenido:</b> En Mining Business School nos esforzamos por mantener nuestro contenido actualizado y relevante. En caso de que realicemos actualizaciones en el contenido del curso o programa adquirido durante tu período de acceso, tendrás derecho a acceder a las actualizaciones sin costo adicional.</p>
          <!-- <p style="color:#243f56;font-family:'Open Sans';text-align:justify;"></p> -->
        </div>
      </div>
    </section>
    
    
    
    <?php include('../common/footer.php'); ?>
</body>
</html>