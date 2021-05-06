<?php

class ControladorSlide
{

    static public function ctrMostrarSlide()
    {
        $tabla = "slide";
        $respuesta = ModelosSlide::mdlMostrarSlide($tabla);
        return $respuesta;
    }
    /*ACTUALIZAR SLIDE*//*ACTUALIZAR SLIDE*//*ACTUALIZAR SLIDE*//*ACTUALIZAR SLIDE*//*ACTUALIZAR SLIDE*/

    static public function ctrActualizarSlide($datos)
    {

        $tabla = "slide";
        $ruta1=null;
        if ($datos["subirFondo"] != null) {

            unlink("../".$datos["imgFondo"]);

            $directorio="../vistas/img/slide/slide".$datos["id"];

            if(!file_exists($directorio)){
                mkdir($directorio,0755);
            }

            $nuevoAncho=1600;
            $nuevoAlto=520;

            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);


            if($datos["subirFondo"]["type"] == "image/jpeg"){

				$ruta1 = $directorio."/fondo.jpg";

				$origen = imagecreatefromjpeg($datos["subirFondo"]["tmp_name"]);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $nuevoAncho, $nuevoAlto);

				imagejpeg($destino, $ruta1);
		
            }
            
            if($datos["subirFondo"]["type"] == "image/png"){

				$ruta1 = $directorio."/fondo.png";

				$origen = imagecreatefrompng($datos["subirFondo"]["tmp_name"]);

				imagealphablending($destino, FALSE);
    			
    			imagesavealpha($destino, TRUE);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $nuevoAncho, $nuevoAlto);

				imagepng($destino, $ruta1);
		
			}


            $rutaFondo = substr($ruta1, 3);

        }else{

			$rutaFondo = $datos["imgFondo"];

		}


        $respuesta = ModelosSlide::mdlActualizarSlide($tabla,$rutaFondo , $datos);
        return $respuesta;
    }
}
