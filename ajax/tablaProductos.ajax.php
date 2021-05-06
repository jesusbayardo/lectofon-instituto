<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";



class TablaProductos
{

    /*=============================================
  MOSTRAR LA TABLA DE PRODUCTOS
  =============================================*/

    public function mostrarTablaProductos()
    {
        $categoria=null;
        $item = null;
        $valor = null;

        $productos = ControladorProducto::ctrMostrarProductos($item, $valor);

        $datosJson = '

  		{	
  			"data":[';

        for ($i = 0; $i < count($productos); $i++) {

            /*=============================================
  			TRAER LAS CATEGORÍAS
  			=============================================*/

            $item = "id";
            $valor = $productos[$i]["id_categoria"];

            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
          

            if ($categorias["categoria"] == "") {

                $categoria = "SIN CATEGORÍA";
            } else {

                $categoria = $categorias["categoria"];
            }

            /*=============================================
  			TRAER LAS SUBCATEGORÍAS
  			=============================================*/

            $item2 = "id";
            $valor2 = $productos[$i]["id_subcategoria"];
            $tabla = "subcategorias";

            $subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($tabla, $item2, $valor2);

            if ($subcategorias["subcategoria"] == "") {

                $subcategoria = "SIN SUBCATEGORÍA";
            } else {

                $subcategoria = $subcategorias["subcategoria"];
            }

            /*=============================================
  			AGREGAR ETIQUETAS DE ESTADO
  			=============================================*/

            if ($productos[$i]["estado"] == 0) {

                $colorEstado = "btn-danger";
                $textoEstado = "Desactivado";
                $estadoProducto = 1;
            } else {

                $colorEstado = "btn-success";
                $textoEstado = "Activado";
                $estadoProducto = 0;
            }

            $estado = "<button class='btn btn-xs btnActivar " . $colorEstado . "' idProducto='" . $productos[$i]["id"] . "' estadoProducto='" . $estadoProducto . "'>" . $textoEstado . "</button>";



            /*=============================================
  			TRAER IMAGEN PRINCIPAL
  			=============================================*/

            $imagenPrincipal = "<img src='" . $productos[$i]["portada"] . "' class='img-thumbnail imgTablaPrincipal' width='100px'>";

            /*=============================================
			TRAER MULTIMEDIA
  			=============================================*/

            if ($productos[$i]["multimedia"] != null) {

                $multimedia = json_decode($productos[$i]["multimedia"], true);

                if ($multimedia[0]["foto"] != "") {

                    $vistaMultimedia = "<img src='" . $multimedia[0]["foto"] . "' class='img-thumbnail imgTablaMultimedia' width='100px'>";
                } else {

                    $vistaMultimedia = "<img src='http://i3.ytimg.com/vi/" . $productos[$i]["multimedia"] . "/hqdefault.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";
                }
            } else {

                $vistaMultimedia = "<img src='vistas/img/multimedia/default/default.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";
            }



            /*=============================================
  			TRAER PRECIO
  			=============================================*/

            if ($productos[$i]["precio"] == 0) {

                $precio = "Gratis";
            } else {

                $precio = "$ " . number_format($productos[$i]["precio"], 2);
            }

            /*=============================================
  			TRAER ENTREGA
  			=============================================*/

            if ($productos[$i]["entrega"] == 0) {

                $entrega = "Inmediata";
            } else {

                $entrega = $productos[$i]["entrega"] . " días hábiles";
            }

           
           
            /*=============================================
  			TRAER LAS ACCIONES
  			=============================================*/
           
            $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' rutaCabecera='".$productos[$i]["ruta"]."' ><i class='fa fa-times'></i></button></div>";

            /*=============================================
  			CONSTRUIR LOS DATOS JSON
  			=============================================*/


            $datosJson .= '[
					
                    "'.($i + 1).'",                                   
					"'.$productos[$i]["titulo"].'",
                    "'.$categoria.'",
                    "'.$subcategoria.'",
                    "'.$precio.'",
                    "'.$estado.'",
                    "'.$entrega.'",
                    "'.$acciones.'"
                    
                   
				
			],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ']

		}';

        echo $datosJson;
    }
}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();
