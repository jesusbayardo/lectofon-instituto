<?php


class ControladorAdministradores
{

    //ingreso de administrador

    public function ctrIngresoAdministrador()
    {
        if (isset($_POST["ingEmail"])) {
            if (
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"])
                &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
            ) {
                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
						
				$tabla = "administrador";
				$item = "email";
				$valor = $_POST["ingEmail"];

				$respuesta = ModeloAdministradores::mdlMostrarAdministradores($tabla, $item, $valor);

				if($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar){

					if($respuesta["estado"] == 1){

						$_SESSION["validarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["email"] = $respuesta["email"];
						$_SESSION["password"] = $respuesta["password"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						echo '<script>

							window.location = "inicio";

						</script>';

					}else{

						echo '<br>
						<div class="alert alert-warning">Este usuario aún no está activado</div>';	

					}

				}else{

					echo '<br>
					<div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>';

				}
            }
        }
    }




    /*=============================================
        MOSTRAR ADMINISTRADORES
        =============================================*/

    public static function ctrMostrarAdministradores($item, $valor)
    {
        $tabla = "administrador";

        $respuesta = ModeloAdministradores::MdlMostrarAdministradores($tabla, $item, $valor);

        return $respuesta;
    }

    /*=============================================
        EDITAR PERFIL
        =============================================*/

    public static function ctrEditarPerfil()
    {
        if (isset($_POST["idPerfil"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

                /*=============================================
                VALIDAR IMAGEN
                =============================================*/
               

                $tabla = "administrador";

                if ($_POST["editarPassword"] != "") {
                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {
                        echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {

										window.location = "Perfiles";

										}
									})

						  	</script>';
                    }
                } else {
                    $encriptar = $_POST["passwordActual"];
                }

                $datos = array("id" => $_POST["idPerfil"],
                               "nombre" => $_POST["editarNombre"],
                               "email" => $_POST["editarEmail"],
                               "password" => $encriptar,
                               "perfil" => $_POST["editarPerfil"],
                              );

                $respuesta = ModeloAdministradores::mdlEditarPerfil($tabla, $datos);

                if ($respuesta == "ok") {
                    echo'<script>

					swal({
						  type: "success",
						  title: "El perfil ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "perfiles";

									}
								})

					</script>';
                }
            } else {
                echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "perfiles";

							}
						})

			  	</script>';
            }
        }
    }

    /*=============================================
    ELIMINAR PERFIL
    =============================================*/

    public static function ctrEliminarPerfil()
    {
        if (isset($_GET["idPerfil"])) {
            $tabla ="administrador";
            $datos = $_GET["idPerfil"];

          

            $respuesta = ModeloAdministradores::mdlEliminarPerfil($tabla, $datos);

            if ($respuesta == "ok") {
                echo'<script>

				swal({
					  type: "success",
					  title: "El perfil ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "perfiles";

								}
							})

				</script>';
            }
        }
    }




    /*=============================================
    REGISTRO DE PERFIL
    =============================================*/

    public static function ctrCrearPerfil()
    {
        if (isset($_POST["nuevoPerfil"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
               preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])) {

                /*=============================================
                VALIDAR IMAGEN
                =============================================*/

                $ruta = "";

                if ($_POST["nuevoNombre"]!=""&&$_POST["nuevoEmail"]!=""&&$_POST["nuevoPerfil"]!=""){

                   



                    $tabla = "administrador";

                    $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $datos = array("nombre" => $_POST["nuevoNombre"],
                               "email" => $_POST["nuevoEmail"],
                               "password" => $encriptar,
                               "perfil" => $_POST["nuevoPerfil"],
                            
                               "estado" => 1);

                    $respuesta = ModeloAdministradores::mdlIngresarPerfil($tabla, $datos);
            
                    if ($respuesta == "ok") {
                        echo '<script>

					swal({

						type: "success",
						title: "¡El perfil ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "perfiles";

						}

					});
				

					</script>';
                    }
                } else {
                    echo '<script>

					swal({

						type: "error",
						title: "¡El perfil no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "perfiles";

						}

					});
				

				</script>';
                }
            }
        }
    }




  

}
