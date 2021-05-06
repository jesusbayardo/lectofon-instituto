<?php

require_once "../controladores/subcategorias.controlador.php";
require_once  "../modelos/subcategorias.modelo.php";


class tablaSubcategorias
{


    public  function  MostrarTablaCategorias()
    {
        $item = null;
        $valor = null;
        $tabla = "subcategorias";
        $subCategorias = ControladorSubcategorias::ctrMostrarSubcategorias($tabla, $item, $valor);


        $datosJson = '{
		 
        "data": [ ';

        for ($i = 0; $i < count($subCategorias); $i++) {

            /*=============================================
          REVISAR ESTADO
          =============================================*/

            if ($subCategorias[$i]["estado"] == 0) {

                $colorEstado = "btn-danger";
                $textoEstado = "Desactivado";
                $estadoCategoria = 1;
            } else {

                $colorEstado = "btn-success";
                $textoEstado = "Activado";
                $estadoCategoria = 0;
            }

            $estado = "<button class='btn " . $colorEstado . " btn-xs btnActivar' estadoSubCategoria='" . $estadoCategoria . "' idSubCategoria='" . $subCategorias[$i]["id"] . "'>" . $textoEstado . "</button>";

                   

            /*=============================================
            CREAR LAS ACCIONES
            =============================================*/

            $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarSubCategoria' idSubCategoria='" . $subCategorias[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarSubCategoria'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarSubCategoria' idSubCategoria='" . $subCategorias[$i]["id"] . "'  ><i class='fa fa-times'></i></button></div>";

            $datosJson     .= '[
                    "' .( $i+1). '",
                    "' . $subCategorias[$i]["subcategoria"] . '",
                    "' . $subCategorias[$i]["ruta"] . '",
                    "' . $estado . '",
                    "' . $acciones . '"		    
                  ],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .=  ']
        
  }';

        echo $datosJson;
    }
}

$activar = new tablaSubcategorias();
$activar->MostrarTablaCategorias();
