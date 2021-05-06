<?php

class ControladorVentas
{

	public function crtMostrarTotalVentas()
	{
		$tabla = "compras";
		$respuesta = ModeloVentas::mdlMostrarTotalVentas($tabla);
		return $respuesta;
	}


	public function crtMostrarTotalCompras()
	{
		$tabla = "compras";
		$respuesta = ModeloVentas::mdlMostrarTotalCompras($tabla);
		return $respuesta;
	}



	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas()
	{

		$tabla = "compras";
		$respuesta = ModeloVentas::mdlMostrarVentas($tabla);
		return $respuesta;
	}






	static public function ctrMostrarVentasTabla()
	{

		$tabla = "compras";
		$respuesta = ModeloVentas::mdlMostrarVentasTabla($tabla);

		return $respuesta;
	}




	/*=============================================
	DATOS SERVER PAYMENTEZ
	=============================================*/

	static public function ctrServerPaymentez($datospago)
	{
		$tabla = "comercio";
		$respuesta = ModeloVentas::mdlMostrarDatosServerPaymentez($tabla);
		return $respuesta;
	}


}
