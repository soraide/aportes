<?php
include '../cursos/Config/Config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener la orderID del cuerpo de la petición JSON
  $jsonData = json_decode(file_get_contents('php://input'), true);
  $orderID = $jsonData['orderID'];
  capturePayment($orderID);
}

function capturePayment($orderId) {
  $accessToken = generateAccessToken();
  $url = "https://api-m.sandbox.paypal.com/v2/checkout/orders/{$orderId}/capture";

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer " . $accessToken,
  ));

  $response = curl_exec($ch);

  if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
  } else {
    return handleResponse($response);
  }

  curl_close($ch);
}
function handleResponse($response) {
  $statusCode = $response->getStatusCode();

  if ($statusCode === 200 || $statusCode === 201) {
    return json_decode($response->getBody(), true);
  }

  $errorMessage = $response->getBody();
  throw new Exception($errorMessage);
}
?>