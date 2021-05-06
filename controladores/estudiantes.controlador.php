<?php

class ControladorEstudiantes
{


	/*=============================================
	MOSTRAR ESTUDIANTES
	=============================================*/

	static public function ctrMostrarEstudiantes($item, $valor)
	{
		$tabla = "estudiante";
		$respuesta = ModeloEstudiantes::mdlMostrarEstudiantes($tabla, $item, $valor);
		return $respuesta;
	}



	/*=============================================
	CREAR NUEVO ESTUDIANTES
	=============================================*/

	static public function ctrCrearEstudiante()
	{
		if (isset($_POST["cedulaEstudiante"])) {
			//CANTIDAD ESTUDIANTES POR USUARIO

			$valorestudiantes = 0;
			$item1 = "id_usuario";
			$valor1 = $_SESSION["idUser"];
			$tabla = "estudiante";
			$respuestaEstudiantes = ModeloEstudiantes::mdlMostrarEstudiantes($tabla, $item1, $valor1);


			//var_dump($respuestaEstudiantes);

			if ($respuestaEstudiantes == false) {

				$valorestudiantes = 1;
			} else {

				$valorestudiantes =	count($respuestaEstudiantes) + 1;
			}


			var_dump($valorestudiantes);


			//MOSTRAR CUENTAS
			$item2 = "id_usuario";
			$valor2 = $_SESSION["idUser"];
			$tabla2 = "cuentas";
			$cantidad2 = $valorestudiantes;
			$respuestaCuentas = ModeloEstudiantes::mdlMostrarCuentasbyCantidad($tabla2, $item2, $valor2, $cantidad2);

			if ($respuestaCuentas == false) {
				echo '<script>
	
				swal({
					  type: "error",
					  title: "Supera el límite de registros, adquiera más cuentas del instituto lectofon",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {

						window.location = "estudiantes";

						}
					})

			  </script>';
			} else {
				if (
					preg_match('/^[0-9]+$/', $_POST["cedulaEstudiante"]) &&
					preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailEstudiante"]) &&
					preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombresEstudiante"]) &&
					preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordEstudiante"])
				) {
					$tabla = "estudiante";
					$encriptar = crypt($_POST["passwordEstudiante"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev3$');
					$datos = array(
						"cedula" => $_POST["cedulaEstudiante"],
						"nombres" => strtoupper($_POST["nombresEstudiante"]),
						"email" => $_POST["emailEstudiante"],
						"password" => $encriptar,
						"fecha_nacimiento" => $_POST["fechaEstudiante"],
						"id_usuario" => $_SESSION["idUser"]
					);

					$respuesta = ModeloEstudiantes::mdlIngresarEstudiante($tabla, $datos);
					if ($respuesta == "ok") {



						echo '<script>
	
						swal({
							  type: "success",
							  title: "Datos guardados correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {
	
										window.location = "estudiantes";
	
										}
									})
	
						</script>';
					}
				} else {

					echo '<script>
	
						swal({
							  type: "error",
							  title: "¡Los campos no pueden ir vacíos o llevar caracteres especiales!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {
	
								window.location = "estudiantes";
	
								}
							})
	
					  </script>';
				}
			}
		}
	}




	/*=============================================
	INGRESO DE ESTUDIANTES
	=============================================*/

	public function ctrIngresoEstudiante()
	{
		if (isset($_POST["ingEmailEstudiante"])) {
			if (
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmailEstudiante"])
				&&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPasswordEstudiante"])
			) {
				$encriptar = crypt($_POST["ingPasswordEstudiante"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev3$');

				$tabla = "estudiante";
				$item = "email";
				$valor = $_POST["ingEmailEstudiante"];

				$respuesta = ModeloEstudiantes::mdlMostrarEstudiantesDatos($tabla, $item, $valor);
				var_dump($respuesta);

				if ($respuesta == false) {
					echo '<br>
					<div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>';
				} else {
					if ($respuesta["email"] == $_POST["ingEmailEstudiante"] && $respuesta["password"] == $encriptar) {
						if ($respuesta["estado"] == 1) {

							$_SESSION["validarSesion"] = "ok";
							$_SESSION["idUser"] = $respuesta["id"];
							$_SESSION["nombreUser"] = $respuesta["nombres"];
							$_SESSION["emailUser"] = $respuesta["email"];
							$_SESSION["passwordUser"] = $respuesta["password"];
							$_SESSION["perfilUser"] = $respuesta["perfil"];
							echo '<script>
							window.location = "inicio";
									  </script>';
						} else {
							echo '<br>
								<div class="alert alert-warning">Este usuario aún no está activado</div>';
						}
					} else {
						echo '<br>
							<div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>';
					}
				}
			}
		}
	}







	/*=============================================
	MOSTRAR ESTUDIANTE
	=============================================*/

	static public function ctrMostrarEstudiante($item, $valor)
	{

		$tabla = "estudiante";
		$respuesta = ModeloEstudiantes::mdlMostrarEstudiantesDatos($tabla, $item, $valor);
		return $respuesta;
	}





	/*=============================================
	EDITAR ESTUDIANTE
	=============================================*/

	static public function ctrEditarEstudiante()
	{

		if (isset($_POST["editarCedulaEstudiante"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombresEstudiante"])
			) {

				

				$password = null;

				if ($_POST["editarpasswordEstudiante"] == "") {
					$password = $_POST["oldpasswordEstudiante"];
				} else {



					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarpasswordEstudiante"])) {

						$password = crypt($_POST["editarpasswordEstudiante"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev3$');
					} else {

						echo '<script>

					swal({
						  type: "error",
						  title: "¡La contraseña de contenter lestras y números!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "estudiantes";

							}
						})

			  	</script>';
					}
				}



				$tabla = "estudiante";


				
				$datos = array(
					"cedula" => $_POST["editarCedulaEstudiante"],
					"nombres" => strtoupper($_POST["editarNombresEstudiante"]),
					"password" => $password

				);

				$respuesta = ModeloEstudiantes::mdlEditarEstudiante($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "Datos cambiados correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "estudiantes";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						  type: "error",
						  title: "¡La cédula no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';
			}
		}
	}
}
