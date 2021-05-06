<?php

class ControladorSubcategorias
{

    static public  function ctrMostrarSubcategorias($tabla, $item, $valor)
    {
        $respuesta = ModeloSubcategorias::mdlMostrarSubCategorias($tabla, $item, $valor);
        return $respuesta;
    }



	static public  function ctrMostrarSubcategoriasProductos($tabla, $item, $valor)
    {
        $respuesta = ModeloSubcategorias::mdlMostrarSubCategoriasProductos($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrCrearSubCategoria()
    {

        if (isset($_POST["tituloSubCategoria"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tituloSubCategoria"])) {



                $datos = array(
                    "subcategoria" => $_POST["tituloSubCategoria"],
                    "idCategoria" => $_POST["seleccionarCategoria"],
                    "ruta" => $_POST["rutaSubCategoria"],
                    "estado" => 1,
                    "titulo" => $_POST["tituloSubCategoria"],
                );


                $respuesta = ModeloSubCategorias::mdlIngresarSubCategoria("subcategorias", $datos);

                if ($respuesta != null) {

                    echo '<script>

					swal({
						  type: "success",
						  title: "La subcategoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subcategorias";

									}
								})

					</script>';
                }
            } else {

                echo '<script>

                swal({
                      type: "error",
                      title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      })

              </script>';

                return;
            }
        }
    }













    /*=============================================
	EDITAR SUBCATEGORIA
	=============================================*/

    static public function ctreditarSubCategoria()
    {

        if (isset($_POST["editarTituloSubCategoria"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTituloSubCategoria"])) {
                /*=============================================
				PREGUNTAMOS SI VIENE OFERTE EN CAMINO
				=============================================*/




                $datos = array(
                    "id" => $_POST["editarIdSubCategoria"],
                    "subcategoria" => $_POST["editarTituloSubCategoria"],
                    "idCategoria" => $_POST["seleccionarCategoria"],
                    "ruta" => $_POST["rutaSubCategoria"],
                    );




           

                $respuesta = ModeloSubCategorias::mdleditarSubCategoria("subcategorias", $datos);

                if ($respuesta !=null) {

                    echo '<script>

					swal({
						  type: "success",
						  title: "La subcategoría ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subcategorias";

									}
								})

					</script>';
                }
            } else {

                echo '<script>

					swal({
						  type: "error",
						  title: "¡La subcategoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "subcategorias";

							}
						})

			  	</script>';
            }
        }
    }






/*=============================================
	ELIMINAR SUBCATEGORIA
	=============================================*/

	static public function ctrEliminarSubCategoria(){

		if(isset($_GET["idSubCategoria"])){

			$datos = $_GET["idSubCategoria"];

			/*=============================================
			ELIMINAR IMAGEN OFERTA
			=============================================*/

			

		
			


			/*=============================================
			QUITAR LAS SUBATEGORIAS DE LOS PRODUCTOS
			=============================================*/

			$traerProductos = ModeloProductos::mdlMostrarProductos("productos", "id_subcategoria", $_GET["idSubCategoria"]);

			foreach ($traerProductos as $key => $value) {

				$item1 = "id_subcategoria";
				$valor1 = 0;
				$item2 = "id";
				$valor2 = $value["id"];

				ModeloProductos::mdlActualizarProductos("productos", $item1, $valor1, $item2, $valor2);	
				
			}

			$respuesta = ModeloSubCategorias::mdlEliminarSubCategoria("subcategorias", $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La subcategoría ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "subcategorias";

								}
							})

				</script>';

			}		

		}

	}













}
