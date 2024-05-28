<?php

namespace App\Models;

use ReflectionClass;

class BaseModel {
  public function objectNull() {
    $claseReflection = new ReflectionClass($this);
    $propiedades = $claseReflection->getProperties();
    foreach ($propiedades as $propiedad) {
      $tipoDato = $propiedad->getType()->getName();
      switch ($tipoDato) {
        case 'int':
          $propiedad->setValue($this, 0);
          break;
        case 'string':
          $propiedad->setValue($this, '');
          break;
        case 'object':
          $propiedad->setValue($this, null);
          break;
        case 'float':
          $propiedad->setValue($this, 0);
          break;
        case 'bool':
          $propiedad->setValue($this, false);
          break;
        default:
          $propiedad->setValue($this, null);
      }
    }
  }
  public function load($row) {
    // $this->objectNull();
    // Los nombres de las propiedades deben coincidir con los nombres de las columnas de la tabla
    foreach ($row as $propiedad => $valor) {
      // var_dump($row);
      if($valor){
        $this->$propiedad = $valor;
      }
    }
  }
  public function save(string $table, $idName, $minus = []): bool {

    $claseReflection = new ReflectionClass($this);
    $propiedades = $claseReflection->getProperties();
    $minus[] = $idName;
    $names = '';
    $valuesStr = '';
    $values = [];
    foreach ($propiedades as $propiedad) {
      if (!in_array($propiedad->getName(), $minus)) {
        $names .= $propiedad->getName() . ',';
        $valuesStr .= "?,";
        $values[] = $propiedad->getValue($this);
      }
    }
    $names = rtrim($names, ',');
    $valuesStr = rtrim($valuesStr, ',');
    try {
      $sql = "INSERT INTO $table($names) VALUES($valuesStr);";
      $con = connectToDatabase();
      $stmt = $con->prepare($sql);
      if($stmt->execute($values)){
        $this->$idName = $con->lastInsertId();
        return true;
      }
    } catch (\Throwable $th) {
      //throw $th;
    }
    return false;
  }
}
