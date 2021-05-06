<?php
require_once "conexion.php";

class ModeloComercio{

static public function mdlSeleccionarPlantilla($tabla){

$stmt=Conexion::conectar()->prepare("select *from $tabla");
$stmt->execute();
return $stmt->fetch();
$stmt->close();
$stmt->null;

}


}