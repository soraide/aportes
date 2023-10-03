<?php
include_once 'controllers/autoload.php';
$url = isset($_GET['url']) ? $_GET['url'] : '';

$parts = explode('/', $url);
// print_r($parts);
$method = $_SERVER['REQUEST_METHOD'];
$controller = $parts[0];
$action = $parts[1];

$controller = new $controller();

switch($method){
  case 'GET':
    if(isset($parts[2])){
      $param = $parts[2];
      $controller->$action($param);
    }else{
      $controller->$action();
    }
    break;
  case 'POST':
    $controller->$action($_POST, $_FILES);
    break;
  case 'PUT':
    parse_str(file_get_contents('php://input'), $params);
    $controller->$action($params);
    break;
  case 'DELETE':
    parse_str(file_get_contents('php://input'), $params);
    $controller->$action($params);
    break;
  default:
    echo json_encode(array('error' => 'Metodo no permitido'));
}

?>