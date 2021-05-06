<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class TablaVentas
{

    /*=============================================
  MOSTRAR LA TABLA DE VENTAS
  =============================================*/

    public function mostrarTabla()
    {

        $ventas = ControladorVentas::ctrMostrarVentasTabla();


        $datosJson = '{
		 
	 "data": [ ';

        for ($i = 0; $i < count($ventas); $i++) {

            /*=============================================
		TRAER PRODUCTO
		=============================================*/

            $item = "id";
            $valor = $ventas[$i]["id_producto"];

            $traerProducto = ControladorProducto::ctrMostrarProductos($item, $valor);

            $producto = $traerProducto[0]["titulo"];

            $imgProducto = "<img class='img-thumbnail' src='" . $traerProducto[0]["portada"] . "' width='100px'>";

            $tipo = $traerProducto[0]["tipo"];


            /*=============================================
		TRAER CLIENTE
		=============================================*/

            $item2 = "id";
            $valor2 = $ventas[$i]["id_usuario"];

            $traerCliente = ControladorUsuario::ctrMostrarUsuarios($item2, $valor2);

            $cliente = $traerCliente["nombre"];


            /*=============================================
		TRAER EMAIL CLIENTE
		=============================================*/

            if ($ventas[$i]["email"] == "") {

                $email = $traerCliente["email"];
            } else {

                $email = $ventas[$i]["email"];
            }

            /*=============================================
		TRAER PROCESO DE ENVÍO
		=============================================*/

            if ($ventas[$i]["envio"] == 0 && $tipo == "virtual") {

                $envio = "<button class='btn btn-info btn-xs'>Entrega inmediata</button>";
            } else if ($ventas[$i]["envio"] == 0 && $tipo == "fisico") {

                $envio = "<button class='btn btn-danger btn-xs btnEnvio' idVenta='" . $ventas[$i]["id"] . "' etapa='1'>Despachando el producto</button>";
            } else if ($ventas[$i]["envio"] == 1 && $tipo == "fisico") {

                $envio = "<button class='btn btn-warning btn-xs btnEnvio' idVenta='" . $ventas[$i]["id"] . "' etapa='2'>Enviando el producto</button>";
            } else {

                $envio = "<button class='btn btn-success btn-xs'>Producto entregado</button>";
            }



            /*=============================================
		REALIZAR REEMBOLSO
		=============================================*/


            if ($ventas[$i]["reembolso"] == 0) {
                $reembolso = "<button class='btn btn-primary btn-xs btnreembolso' estadoReembolso='" . $ventas[$i]["reembolso"] . "' idrembolso='" . $ventas[$i]["id_transaccion"] . "'>Procesar</button>";
            } else if ($ventas[$i]["reembolso"] == 1) {
                $reembolso = "<button class='btn btn-warning btn-xs btnreembolso' estadoReembolso='" . $ventas[$i]["reembolso"] . "'>Procesado</button>";
            }






            /*=============================================
		DEVOLVER DATOS JSON
		=============================================*/
            $datosJson     .= '[
                          "' . ($i + 1) . '",
                          "' . $ventas[$i]["id_transaccion"] . '",	
                          "' . $ventas[$i]["ordercompra"] . '",	
                          "' . $ventas[$i]["cantidad"] . '",	
                          
			      		"' . $producto . '",
			      	
			      		"' . $cliente . '",
			      	
			      		"$ ' . number_format($ventas[$i]["totalcompra"], 2) . '",
			      		
                          "' . $envio . '",
                          "' . $reembolso . '",
                          
			      		"' . $ventas[$i]["metodo"] . '",	
			      		"' . $email . '",
			      		"' . $ventas[$i]["direccion"] . '",
			      		"' . $ventas[$i]["provincia"] . '",
			      		"' . $ventas[$i]["fecha"] . '"	
			      		],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .=  ']
		  
	}';

        echo $datosJson;
    }




}

/*=============================================
ACTIVAR TABLA DE VENTAS
=============================================*/
$activar = new TablaVentas();
$activar->mostrarTabla();




