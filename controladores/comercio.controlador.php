<?php

class ControladorComercio{

    //seleccionar plantilla  //seleccionar plantilla  //seleccionar plantilla
static public function ctrSeleccionarPlantilla(){

$tabla="plantilla";
$respuesta=ModeloComercio::mdlSeleccionarPlantilla($tabla);
return  $respuesta;

}






}