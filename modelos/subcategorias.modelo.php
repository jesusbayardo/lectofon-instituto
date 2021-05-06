<?php
require_once "conexion.php";
class ModeloSubcategorias
{

    static public function mdlActualizarSubcategorias($tabla, $item1, $valor1, $item2, $valor2)
    {


        $stmt = Conexion::conectar()->prepare("update $tabla set $item1=:$item1 where $item2=:$item2");
        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
        if ($stmt->execute()) 
        {
            return "ok";
        } else 
        {
            return null;
        }
        $stmt->close();
        $stmt = null;
    }



/*=============================================
	MOSTRAR SUBCATEGORIAS
	=============================================*/

	static public function mdlMostrarSubCategorias($tabla, $item, $valor){
		

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}





	static public function mdlMostrarSubCategoriasProductos($tabla, $item, $valor){
		

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
	CREAR SUBCATEGORIA
	=============================================*/

	static public function mdlIngresarSubCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(subcategoria, id_categoria, ruta, estado) VALUES (:subcategoria, :id_categoria, :ruta, :estado)");

		$stmt->bindParam(":subcategoria", $datos["subcategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return null;
		
		}

		$stmt->close();
		$stmt = null;

	}


	


	/*=============================================
	EDITAR SUBCATEGORIA
	=============================================*/

	static public function mdlEditarSubCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET subcategoria = :subcategoria, id_categoria = :id_categoria, ruta = :ruta WHERE id = :id");

		$stmt->bindParam(":subcategoria", $datos["subcategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return null;
		
		}

		$stmt->close();
		$stmt = null;

	}





	/*=============================================
	ELIMINAR SUBCATEGORIA
	=============================================*/

	static public function mdlEliminarSubCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
}
