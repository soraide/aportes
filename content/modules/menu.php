<aside class="main-sidebar" id="menu">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" style="text-overflow: ellipsis;">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header" style="text-align: center; font-weight: bold; background-color: #00294c !important;">
        Mining Business School
      </li>
      <li class="header" style="padding:5px;text-align: center; font-weight: bold; background-color: #00294c !important;">
        Avance total: &nbsp;&nbsp;<span style="font-size:17px;color:#d8fff8;"><?=$avanceTotalCurso?>%</span>
      </li>
      <li class="header" style="background-color: #00294c70; color: #ddd; text-transform:uppercase;" title="<?php echo $curso; ?>"><?php echo $curso; ?></li>
  <?php
  if($idCurso == 1043){
    echo '
      <li onclick="verEncuesta('.$idCurso.',this)" id="encuestaprevia"><a href="#"><i class="fa fa-file-text"></i> <span>Encuesta previa</span></a></li>
    ';
  }
  ?>
      <!-- Modulos INICIO -->
      <?php
      foreach ($modulos as $modulo => $temas) {
        
        $color = $avancePorcentaje[$modulo] == 100 ? 'green' : 'primary';
        $completo = $avancePorcentaje[$modulo] == 100 ? 'ok' : 'no';
        $color = $avancePorcentaje[$modulo] == 0 ?  'gray' : $color;
        echo '
      <li class="treeview">
        <a href="#">
          <i class="fa fa-tasks"></i> <span title="'.$modulo.'">'.$modulo.'</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            <small class="label pull-right bg-'.$color.'">'.$avancePorcentaje[$modulo].'%</small>
          </span>
          
        </a>
        
        <ul class="treeview-menu">';
        foreach($temas as $idTema => $tema){
          /*
          En la segunda consulta se almacena el avance del estudiante 
          ([idTema]=>SI|NO) SI en caso de ser IGUALES (cantidad de contenido y cantidad de avance) y no de lo contrario
          */
          $color = ($avance[$idTema] == 'SI') ? 'text-green' : ''; 
          echo '
          <li>
            <a href="#" class="tema" id="a'.$idTema.'" title="'.$tema.'" data-ok="'.$completo.'">
            <i class="fa fa-check-circle '.$color.'"></i>'.$tema.'</a>
          </li>';
        }
        echo '</ul>';
      echo '</li>';
      }
      ?>
      <li class="header">SOCIAL</li>
      <li><a href="./users.php?id=<?php echo $idCurso; ?>"><i class="fa fa-users" style="font-size:1.6rem"></i> <span>Mis compañeros</span></a></li>
      <!-- <li><a href="#"><i class="fa fa-book"></i> <span>Examen</span></a></li> -->
      <li class="header">ETIQUETAS</li>
      <li class="header"><i class="fa fa-check-circle text-green" style="font-size:1.6rem"></i><span>&nbsp; Avance Terminado</span></li>
      <li class="header"><i class="fa fa-check-circle" style="font-size:1.6rem"></i><span>&nbsp; Avance pendiente</span></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>