<?php
function generateAccessToken() {
  $auth = base64_encode(CLIENT_ID . ":" . APP_SECRET);
  $url = BASE."/v1/oauth2/token";
  $data = "grant_type=client_credentials";

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Basic " . $auth,
    "Content-Type: application/x-www-form-urlencoded",
  ));

  $response = curl_exec($ch);

  if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
  } else {
    $jsonData = json_decode($response, true);
    return $jsonData["access_token"];
  }

  curl_close($ch);
}
?>