<?php

require_once "../controladores/categorias.controlador.php";
require_once  "../modelos/categorias.modelo.php";


class TablaCategorias
{

    //tabla categorias//tabla categorias//tabla categorias//tabla categorias//tabla categorias
    public function mostrarTabla()
    {
        $item = null;
        $valor = null;
        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);


        $datosJson = '
        {
            "data":[';
        for ($i = 0; $i < count($categorias); $i++) {
            //revisar estado //revisar estado //revisar estado //revisar estado //revisar estado
            //revisar estado //revisar estado //revisar estado //revisar estado //revisar estado //revisar estado
            if ($categorias[$i]["estado"] == 0) {
                $colorEstado = "btn-danger";
                $textoEstado = "Desactivado";
                $estadoCategoria = "1";
            } else {

                $colorEstado = "btn-success";
                $textoEstado = "Activado";
                $estadoCategoria = "0";
            }


            $suma = $i + 1;
            //revisar estado
            $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarCategoria' idCategoria='".$categorias[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCategoria'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCategoria'  idCategoria='".$categorias[$i]["id"]."'><i class='fa fa-times'></i></button></div>";
         
            $estado = "<button class='btn ".$colorEstado." btn-xs btnActivar' estadoCategoria='". $estadoCategoria."' idCategoria='".$categorias[$i]["id"]."'>".$textoEstado."</button>";
            $datosJson .= '
                [    "' . $suma . '",
                     "' . $categorias[$i]["categoria"] . '",
                     "' . $categorias[$i]["ruta"] . '",
                     "' . $estado . '",
                    "' . $acciones . '"
            ],';
        }
        $datosJson = substr($datosJson, 0, -1);
        $datosJson .= ' ]
        }';

        echo  $datosJson;
    }
}


$activar = new TablaCategorias();
$activar->mostrarTabla();
