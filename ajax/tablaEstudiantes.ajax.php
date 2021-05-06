<?php

require_once "../controladores/estudiantes.controlador.php";
require_once  "../modelos/estudiantes.modelo.php";


class TablaEstudiantes
{

    
    public function mostrarTabla()
    {
        $item = null;
        $valor = null;
        $estudiantes = ControladorEstudiantes::ctrMostrarEstudiantes($item, $valor);


        $datosJson = '
        {
            "data":[';
        for ($i = 0; $i < count($estudiantes); $i++) {
            


            $suma = $i + 1;
            //revisar estado
            $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarEstudiante' idEstudiante='".$estudiantes[$i]["id"]."' data-toggle='modal' data-target='#modalEditarEstudiante'><i class='fa fa-pencil'></i></button></div>";
         
             $datosJson .= '
                [    "' . $suma . '",
                     "' . $estudiantes[$i]["cedula"] . '",
                     "' . $estudiantes[$i]["nombres"] . '",
                     "' . $estudiantes[$i]["email"] . '",
                     "' . $estudiantes[$i]["fecha_nacimiento"] . '",
                    "' . $acciones . '"
            ],';
        }
        $datosJson = substr($datosJson, 0, -1);
        $datosJson .= ' ]
        }';

        echo  $datosJson;
    }
}


$activar = new TablaEstudiantes();
$activar->mostrarTabla();
