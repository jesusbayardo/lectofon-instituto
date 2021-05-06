
<?php
require_once "conexion.php";
class ModelosSlide
{

    static public function mdlMostrarSlide($tabla)
    {
        $stmt = Conexion::conectar()->prepare("select *from $tabla ORDER by orden ASC");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }




    static public function mdlActualizarSlide($tabla,$rutaFondo, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla set imgFondo=:imgFondo where id=:id");
       
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":imgFondo", $rutaFondo, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return null;
        }

        $stmt->close();
        $stmt = null;
    }
}
