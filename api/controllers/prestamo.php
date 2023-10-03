<?php
require_once('./models/prestamo.php');
class Prestamo
{
  public function __construct(){
    
  }

  public function create($data, $files=null)
  {
    $prestamo = new PrestamoModel();
    $id = $prestamo->createPrestamo($data);
    if ($id > 0) {
      echo json_encode(array('status' => 'success', 'message' => 'Agregado correctamente', 'id' => $id));
    } elseif($id == -10) {
      echo json_encode(array('status' => 'error', 'message' => 'No puede tener como garante a usted mismo'));
    }else{
      echo json_encode(array('status' => 'error', 'message' => 'Error al crear socio'));
    }
  }

  public function getAll(){
    $prestamos = new PrestamoModel();
    $res = $prestamos->getSociosAceptados();
    echo json_encode(array('status' => 'success', 'socios' => $res));
  }

  public function prestamoUsuario(){
    session_start();
    $prestamo = new PrestamoModel();
    $idUser = $_SESSION['idSocio'];
    // $idUser = 21;
    $res = $prestamo->getPrestamoUser($idUser);
    if($res != null){
      if(count($res) > 0){
        echo json_encode(array('status'=>'success', 'prestamos'=>$res));
      }else{
        echo json_encode(array('status'=>'success', 'prestamos'=>array()));
      }
    }else{
      echo json_encode(array('status'=>'success', 'prestamos'=>array()));
    }
  }
}
?>