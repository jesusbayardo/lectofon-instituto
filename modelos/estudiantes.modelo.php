
<?php
require_once "conexion.php";
class ModeloEstudiantes
{

    /*=============================================
        MOSTRAR ESTUDIANTES
        =============================================*/
    static public function mdlMostrarEstudiantes($tabla, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }






    /*=============================================
        MOSTRAR ESTUDIANTES
        =============================================*/
    static public function mdlMostrarCuentas($tabla, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }




    /*=============================================
        MOSTRAR CUENTAS por cantidad existe o no cantidad comprada
        =============================================*/
        static public function mdlMostrarCuentasbyCantidad($tabla, $item, $valor,$cantidad2)
        {
    
           
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and numero_cuenta = :numero_cuenta");
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
                $stmt->bindParam(":numero_cuenta", $cantidad2, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch();
            
            $stmt->close();
            $stmt = null;
        }
    






    /*=============================================
	CREAR ESTUDIANTE
	=============================================*/

    static public function mdlIngresarEstudiante($tabla, $datos)
    {
        $estado = 1;
        $perfil = "estudiante";
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cedula,nombres,email,password,estado,fecha_nacimiento,perfil,id_usuario) VALUES (:cedula,:nombres,:email,:password,:estado,:fecha_nacimiento,:perfil,:id_usuario)");
        $stmt->bindParam(":cedula", $datos["cedula"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
        $stmt->bindParam(":perfil",  $perfil, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();
        $stmt = null;
    }




    /*=============================================
        MOSTRAR ESTUDIANTES
        =============================================*/
        static public function mdlMostrarEstudiantesDatos($tabla, $item, $valor)
        {
    
            if ($item != null) {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            $stmt->close();
            $stmt = null;
        }
    
    




        
	/*=============================================
	EDITAR ESTUDIANTE
	=============================================*/

	static public function mdlEditarEstudiante($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres = :nombres,password=:password WHERE cedula = :cedula");

		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula", $datos["cedula"], PDO::PARAM_STR);
		
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
}
