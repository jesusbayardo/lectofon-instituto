<?php

require_once "../controladores/subcategorias.controlador.php";
require_once  "../modelos/subcategorias.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once  "../modelos/productos.modelo.php";


class ajaxSubCategorias
{

    public $activarSubcategoria;
    public $idsubcategoria;
    public $estadoSubCategoria;


    public function activarEstadoSubcategoria()
    {

        ModeloProductos::mdlActualizarProductos("productos", "estado", $this->estadoSubCategoria, "id_subcategoria", $this->idsubcategoria);


        $respuesta =  ModeloSubcategorias::mdlActualizarSubcategorias("subcategorias", "estado", $this->estadoSubCategoria, "id", $this->idsubcategoria);
        return $respuesta;
    }



    //
    // AJAX CONSULTA DE DATOS REPETIDOS SUBCATEGORIAS
    //


    public $verificarCategoria;
    public $subCategoria;
    public function ajaxValidadSubcategoria()
    {
        $item = "subcategoria";
        $valor = $this->subCategoria;

        $tabla = "subcategorias";
        $respuesta = ControladorSubcategorias::ctrMostrarSubcategorias($tabla, $item, $valor);
        echo json_encode($respuesta);
    }




    /*=============================================
	EDITAR SUBCATEGORIA
	=============================================*/

    public $idSubCategoria;

    public function ajaxEditarSubCategoria()
    {

        $item = "id";
        $valor = $this->idSubCategoria;

        $tabla = "subcategorias";

        $respuesta = ControladorSubCategorias::ctrMostrarSubCategorias($tabla, $item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
	TRAER SUBCATEGORIAS DE ACUERDO A LA CATEGORÍA
	=============================================*/

    public $idCategoria;

    public function ajaxTraerSubCategoria()
    {

        $item = "id_categoria";
        $valor = $this->idCategoria;

        $tabla = "subcategorias";
        $respuesta = ControladorSubCategorias::ctrMostrarSubCategorias($tabla, $item, $valor);

        echo json_encode($respuesta);
    }

    public $idCategoriap;
    public function ajaxTraerSubCategoriaProductos()
    {

        $item = "id_categoria";
        $valor = $this->idCategoriap;

        $tabla = "subcategorias";
        $respuesta = ControladorSubCategorias::ctrMostrarSubCategoriasProductos($tabla, $item, $valor);

        echo json_encode($respuesta);
    }





}



if (isset($_POST["estadoSubCategoria"])) {

    $activarSubcategoria = new ajaxSubCategorias();
    $activarSubcategoria->estadoSubCategoria = $_POST["estadoSubCategoria"];
    $activarSubcategoria->idsubcategoria = $_POST["idsubcategoria"];
    $activarSubcategoria->activarEstadoSubcategoria();
}



if (isset($_POST["subCategoria"])) {
    $verificarCategoria = new ajaxSubCategorias();
    $verificarCategoria->subCategoria = $_POST["subCategoria"];
    $verificarCategoria->ajaxValidadSubcategoria();
}


/*=============================================
EDITAR SUBCATEGORIA
=============================================*/
if (isset($_POST["idSubCategoria"])) {

    $editarSubCategoria = new AjaxSubCategorias();
    $editarSubCategoria->idSubCategoria = $_POST["idSubCategoria"];
    $editarSubCategoria->ajaxEditarSubCategoria();
}

/*=============================================
TRAER SUBCATEGORIAS DE ACUERDO A LA CATEGORÍA
=============================================*/
if (isset($_POST["idCategoria"])) {

    $traerSubCategoria = new AjaxSubCategorias();
    $traerSubCategoria->idCategoria = $_POST["idCategoria"];
    $traerSubCategoria->ajaxTraerSubCategoria();
}



if (isset($_POST["idCategoriap"])) {

    $traerSubCategoria = new AjaxSubCategorias();
    $traerSubCategoria->idCategoriap = $_POST["idCategoriap"];
    $traerSubCategoria->ajaxTraerSubCategoriaProductos();
}






