<?php
require_once "conexion.php";

class ModeloVentas
{

    //total de ventas//total de ventas//total de ventas//total de ventas
    //total de ventas//total de ventas//total de ventas//total de ventas
    static public function mdlMostrarTotalVentas($tabla)
    {
        $stmt = Conexion::conectar()->prepare("select sum(totalcompra) as total from $tabla");
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt->null;
    }



    static public function mdlMostrarTotalCompras($tabla)
    {
        $stmt = Conexion::conectar()->prepare("select sum(cantidad) as total from $tabla");
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt->null;
    }




    static public function mdlMostrarVentas($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where totalcompra!=0  ");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }




    static public function mdlMostrarVentasTabla($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla   ");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }



    static public function mdlActualizarVenta($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}







    /*=============================================
	ACTUALIZAR PERFIL
	=============================================*/

	static public function mdlActualizarReembolso($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;




    }




    static public  function mdlMostrarDatosServerPaymentez($tabla)
	{
		$stmt = Conexion::conectar()->prepare("select clienteIdPaymentez,llaveSecretaPaymentez from $tabla");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close;
		$stmt = null;
	}

    
}
