<?php

require_once "conexion.php";


class ModeloCategorias
{


    static public function mdlMostrarCategorias($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("select *from $tabla where $item=:$item ");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("select *from $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlactualizarCategoria($tabla, $item1, $valor1, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("update  $tabla set $item1=:$item1 where $item2=:$item2 ");
        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()){

            return "ok";
        }else{
            return null;
        }

            $stmt->close();
        $stmt = null;
    }


/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarCategoria($tabla, $datos){
      //  print_r($datos["categoria"]);
      //  print_r($datos["ruta"]);
       

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (categoria, ruta, estado) VALUES (:categoria, :ruta, :estado)");

		$stmt->bindParam(":categoria", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}







/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria, ruta = :ruta WHERE id = :id");
        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return null;
		
		}

		$stmt->close();
		$stmt = null;

	}





/*=============================================
	ELIMINAR CATEGORIA
	=============================================*/

	static public function mdlEliminarCategoria($tabla, $datos){

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



