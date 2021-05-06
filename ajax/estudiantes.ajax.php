<?php

require_once "../controladores/estudiantes.controlador.php";
require_once "../modelos/estudiantes.modelo.php";

class AjaxEstudiantes
{
/*=============================================
	EDITAR ESTUDIANTE
	=============================================*/	

	public $idEstudianteEditar;

	public function ajaxEditarEstudiante(){

		$item = "id";
		$valor = $this->idEstudianteEditar;

		$respuesta = ControladorEstudiantes::ctrMostrarEstudiante($item, $valor);

		echo json_encode($respuesta);


	}






//validar  estudiante cedula
public $validarEstudiante;
public function validarEstudiante(){
    $item = "cedula";
    $valor = $this->validarEstudiante;
    $respuesta = ControladorEstudiantes::ctrMostrarEstudiantes($item, $valor);
    echo json_encode($respuesta);
}



//validar  estudiante correo
public $emailEstudiante;
public function emailEstudiante(){
    $item = "email";
    $valor = $this->emailEstudiante;
    $respuesta = ControladorEstudiantes::ctrMostrarEstudiantes($item, $valor);
    echo json_encode($respuesta);
}



}

/*=============================================
VALIDAD CEDULA REPETIDA
=============================================*/	
if (isset($_POST["validarEstudiante"])) {
    $validarEstudiante = new AjaxEstudiantes();
    $validarEstudiante->validarEstudiante = $_POST["validarEstudiante"];  
    $validarEstudiante->validarEstudiante();
}


/*=============================================
VALIDAR CORREO REPETIDO
=============================================*/	
if (isset($_POST["emailEstudiante"])) {
    $emailEstudiante = new AjaxEstudiantes();
    $emailEstudiante->emailEstudiante = $_POST["emailEstudiante"];  
    $emailEstudiante->emailEstudiante();
}


/*=============================================
EDITAR ESTUDIANTE
=============================================*/	

if(isset($_POST["idEstudianteEditar"])){

	$estudiante = new AjaxEstudiantes();
	$estudiante -> idEstudianteEditar = $_POST["idEstudianteEditar"];
	$estudiante -> ajaxEditarEstudiante();

}