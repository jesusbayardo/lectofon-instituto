<?php

class ControladorUsuario
{

    //mostrar total usuarios//mostrar total usuarios//mostrar total usuarios
    //mostrar total usuarios//mostrar total usuarios//mostrar total usuarios
    public function crtMostrarTotalUsuario()
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlMostrarTotalUsuarios($tabla);
        return $respuesta;
    }



    
	static public function ctrMostrarUltimosUsuarios($orden){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarUltimosUsuarios($tabla, $orden);

		return $respuesta;

    }
    

    /*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	
	}



	/*=============================================
	INGRESO DE REPRESENTANTE
	=============================================*/

	public function ctrIngresoRepresentante()
	{
		if (isset($_POST["ingEmailRepresentante"])) {
			if (
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmailRepresentante"])
				&&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPasswordRepresentante"])
			) {
				$encriptar = crypt($_POST["ingPasswordRepresentante"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev3$');

				$tabla = "usuarios";
				$item = "email";
				$valor = $_POST["ingEmailRepresentante"];

				$respuesta = ModeloUsuarios::mdlMostrarRepresentantes($tabla, $item, $valor);
				if ($respuesta == false) {
					echo '<br>
					<div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>';
				} else {
					if ($respuesta["email"] == $_POST["ingEmailRepresentante"] && $respuesta["password"] == $encriptar) {
						if ($respuesta["verificacion"] ==0) {
							if ($respuesta["cuentas_compradas"] > 0) {
								$_SESSION["validarSesion"] = "ok";
								$_SESSION["idUser"] = $respuesta["id"];
								$_SESSION["nombreUser"] = $respuesta["nombre"];
								$_SESSION["fotoUser"] = $respuesta["foto"];
								$_SESSION["emailUser"] = $respuesta["email"];
								$_SESSION["passwordUser"] = $respuesta["password"];
								$_SESSION["perfilUser"] = $respuesta["perfil"];
								echo '<script>
							window.location = "inicio";
									  </script>';
							} else {
								echo '
								<script>

									swal({
										  type: "error",
										  title: "¡No tiene comprado el instituto lectofon!",
										  showConfirmButton: true,
										  confirmButtonText: "Cerrar"
										  }).then(function(result){
											if (result.value) {
											window.location = "login";
											}
										})

			  					</script>
								
								
								';
							}
						} else {
							echo '<br>
								<div class="alert alert-warning">Este usuario aún no está activado</div>';
								}
					} 
					else {
						echo '<br>
							<div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>';
					}
				}
			}
		}
	}

}
