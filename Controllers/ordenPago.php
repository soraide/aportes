<?php

include '../cursos/Config/Config.php';
include '../connections/conexion.php';
include './generateAccessToken.php';

$sql = "SELECT * FROM tblCurso WHERE idCurso=1032";
$stmt = sqlsrv_query($con, $sql);
if($stmt){
  $row = sqlsrv_fetch_array($stmt);
  $access_token = generateAccessToken();
  $nombre = $row['curso'];
  $precio = $row['precio'];
  $desc = $row['descripcion'];
  $requestData = array(
    "intent" => "CAPTURE",
    "purchase_units" => array(
      array(
        "items" => array(
          array(
            "name" => $nombre,
            "description" => $desc,
            "quantity" => "1",
            "unit_amount" => array(
              "currency_code" => "USD",
              "value" => $precio
            )
          )
        ),
        "amount" => array(
          "currency_code" => "USD",
          "value" => $precio,
          "breakdown" => array(
            "item_total" => array(
              "currency_code" => "USD",
              "value" => $precio
            )
          )
        )
      )
    ),
    "application_context" => array(
      "return_url" => SERVER_NAME. "/Controllers/success.php",
      "cancel_url" => SERVER_NAME. "/Controllers/cancel.php"	
    )
  );
  $jsonData = json_encode($requestData);
  $ch = curl_init(BASE.'/v2/checkout/orders');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$access_token,
    'Prefer: return=representation',
  ));
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

  $response = curl_exec($ch);

  if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
  }else {
    $responseData = json_decode($response, true);
  
    if ($responseData === null) {
      echo 'Error decoding JSON: ' . json_last_error_msg();
    } else {
        // Acceder a los valores de la respuesta
        // $orderId = $responseData['id'];
        // echo $orderId;
      echo json_encode($responseData);
    }
  }
  curl_close($ch);
}else{
  print_r(sqlsrv_errors($stmt));
  // echo json_encode(array('message'=>'Error - '.sqlsrv_errors($stmt)));
}
?>