<?php


class ControladorCategorias
{


    static public function ctrMostrarCategorias($item, $valor)
    {

        $tabla = "categorias";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }

    //CREAR CATEGORIAS//CREAR CATEGORIAS//CREAR CATEGORIAS//CREAR CATEGORIAS//CREAR CATEGORIAS//CREAR CATEGORIAS

    static public function ctrCrearCategoria()
    {
        if (isset($_POST["tituloCategoria"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tituloCategoria"])) {



                $datos = array(
                    "titulo" => strtoupper($_POST["tituloCategoria"]),
                    "ruta" => $_POST["rutaCategoria"],
                    "estado" => 1
                );


                $tabla = "categorias";

                $respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                swal({
                      type: "success",
                      title: "La categoría ha sido guardada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {

                        window.location = "categorias";

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
	EDITAR CATEGORIAS
	=============================================*/

    static public function ctrEditarCategoria()
    {

        if (isset($_POST["editarTituloCategoria"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTituloCategoria"])) {



                $datos = array(
                    "id" => $_POST["editarIdCategoria"],
                    "categoria" => strtoupper($_POST["editarTituloCategoria"]),
                    "ruta" => $_POST["rutaCategoria"],
                );



              
             

                $respuesta = ModeloCategorias::mdlEditarCategoria("categorias", $datos);

                if ($respuesta != null) {

                    echo '<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

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
	ELIMINAR CATEGORIA
	=============================================*/

	static public function ctrEliminarCategoria(){

		if(isset($_GET["idCategoria"])){

			/*=============================================
			QUITAR LAS CATEGORIAS DE LAS SUBCATEGORIAS
			=============================================*/

			$traerSubCategorias = ModeloSubCategorias::mdlMostrarSubCategorias("subcategorias",  "id_categoria", $_GET["idCategoria"]);

			if($traerSubCategorias){

				foreach ($traerSubCategorias as $key => $value) {

					$item1 = "id_categoria";
					$valor1 = 0;
					$item2 = "id";
					$valor2 = $value["id"];

					ModeloSubCategorias::mdlActualizarSubCategorias("subcategorias", $item1, $valor1, $item2, $valor2);

				}

			}

			/*=============================================
			QUITAR LAS CATEGORIAS DE LOS PRODUCTOS
			=============================================*/

			$traerProductos = ModeloProductos::mdlMostrarProductos("productos", "id_categoria", $_GET["idCategoria"]);

			if($traerProductos){

				foreach ($traerProductos as $key => $value) {

					$item1 = "id_categoria";
					$valor1 = 0;
					$item2 = "id";
					$valor2 = $value["id"];

					ModeloProductos::mdlActualizarProductos("productos", $item1, $valor1, $item2, $valor2);	
				
				}

			}

			$respuesta = ModeloCategorias::mdlEliminarCategoria("categorias", $_GET["idCategoria"]);

			if($respuesta !=null){

				echo'<script>

				swal({
					  type: "success",
					  title: "La categoría ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "categorias";

								}
							})

				</script>';

			}		


		}

	}
    
}
