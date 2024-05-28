<?php
session_start();
date_default_timezone_set('America/La_Paz');
require_once(__DIR__.'/config/database.php');
require_once(__DIR__.'/models/basemodel.php');
require_once(__DIR__.'/resources/response.php');
require_once(__DIR__.'/resources/request.php');

$entities = ['grado', 'usuario', 'expedicion', 'estadocivil', 'socio', 'registro', 'parentesco', 'beneficiario', 'gestion', 'aporte', 'reporte', 'reporteXLSX'];
foreach ($entities as $entity) {
  require_once(__DIR__ . "/models/$entity.php");
  require_once(__DIR__ . "/controllers/".$entity."Controller.php");
}