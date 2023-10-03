<?php
function connectToDatabase()
{
  $serverName = "localhost";
  $databaseName = "dbAportes";
  $username = "sa2";
  $password = "#12345678.";

  try {
    $pdo = new PDO("sqlsrv:Server=$serverName;Database=$databaseName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  } catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
  }
}
?>