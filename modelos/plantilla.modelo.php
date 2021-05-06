<?php

class ModeloPlantilla{

    public function plantilla(){
        include "vistas/plantilla.php";
    }


    static public function mdlEstiloPlantilla($tabla){

        $stmt= Conexion::conectar()->prepare("SELECT * FROM $tabla");
    
        $stmt -> execute();
        return  $stmt -> fetch();
        $stmt -> close();
    
    }

}
?>