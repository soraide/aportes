<?php
function connectToDatabase()
{
  $serverName = "192.168.10.26";
  $databaseName = "dbAportes";
  $username = "sa2";
  $password = "123";

  try {
    $pdo = new PDO("sqlsrv:Server=$serverName;Database=$databaseName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  } catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
  }
}
?>