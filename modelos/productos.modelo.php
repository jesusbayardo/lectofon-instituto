<?php
require_once "conexion.php";

class ModeloProductos
{

    //total de usuario//total de usuario//total de usuario//total de usuario
    //total de usuario//total de usuario//total de usuario//total de usuario
    static public function mdlMostrarTotalProductos($tabla)
    {
        $stmt = Conexion::conectar()->prepare("select count(id) as total from $tabla");
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt->null;
    }



    /*=============================================
	MOSTRAR EL TOTAL DE VENTAS
	=============================================*/	

	static public function mdlMostrarTotalProductosInicio($tabla, $orden){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

    }
    

 /*=============================================
	ACTUALIZAR ESTADO PRODUCTPS
	=============================================*/	

    static public function mdlActualizarProductos($tabla, $item1, $valor1, $item2, $valor2)
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
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;


    }
    






    static public function mdlIngresarProducto($tabla, $datos){
$fisico="fisico";
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, id_subcategoria, tipo, ruta, estado, titulo
        , descripcion, multimedia, precio, portada, oferta, imgOferta, entrega) 
        VALUES (:id_categoria, :id_subcategoria, :tipo, :ruta, :estado, :titulo, :descripcion, :multimedia, 
         :precio, :portada, :oferta,  :imgOferta, :entrega)");

		$stmt->bindParam(":id_categoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_subcategoria", $datos["idSubCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $fisico, PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
	
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["imgFotoPrincipal"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
	
		$stmt->bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
	
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
    





    /*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function mdlEditarProducto($tabla, $datos){
		

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, id_subcategoria = :id_subcategoria, 
         ruta = :ruta,  titulo = :titulo,  descripcion = :descripcion, 
        multimedia = :multimedia, precio = :precio, portada = :portada, 
         entrega = :entrega WHERE id = :id");

		$stmt->bindParam(":id_categoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_subcategoria", $datos["idSubCategoria"], PDO::PARAM_STR);
	
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
	
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["imgFotoPrincipal"], PDO::PARAM_STR);
	
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}






	
	/*=============================================
	ELIMINAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

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


