<?php

require_once "../controladores/categorias.controlador.php";
require_once  "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once  "../modelos/subcategorias.modelo.php";


require_once "../controladores/productos.controlador.php";
require_once  "../modelos/productos.modelo.php";

class AjaxCategorias
{

    /*activar categoria*//*activar categoria*//*activar categoria*//*activar categoria*//*activar categoria*//*activar categoria*//*activar categoria*//*activar categoria*/

    public $activarCategoria;
    public $activarId;
    public $validarCategoria;


    public function ajaxActivarCategoria()
    {


        ModeloSubcategorias::mdlActualizarSubcategorias("subcategorias", "estado", $this->activarCategoria, "id_categoria", $this->activarId);
        ModeloProductos::mdlActualizarProductos("productos", "estado", $this->activarCategoria, "id_categoria", $this->activarId);

        $respuesta = ModeloCategorias::mdlactualizarCategoria("categorias", "estado", $this->activarCategoria, "id", $this->activarId);
        return $respuesta;
    }



    /* categoria existe*//* categoria existe*//* categoria existe*//* categoria existe*//* categoria existe*//* categoria existe*//* categoria existe*//* categoria existe*/

    public function ajaxValidadCategoria()
    {
        $item = "categoria";
        $valor = $this->validarCategoria;
        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);


        echo json_encode($respuesta);
    }

    /*=============================================
EDITAR CATEGORIA
=============================================*/

    public $idCategoria;

    public function ajaxEditarCategoria()
    {

        $item = "id";
        $valor = $this->idCategoria;

        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        echo json_encode($respuesta);
    }
}
/*activar categoria*//*activar categoria*//*activar categoria*//*activar categoria*//*activar categoria*//*activar categoria*//*activar categoria*//*activar categoria*/
if (isset($_POST["activarCategoria"])) {

    $activarCategoria = new AjaxCategorias();
    $activarCategoria->activarCategoria = $_POST["activarCategoria"];
    $activarCategoria->activarId = $_POST["activarId"];
    $activarCategoria->ajaxActivarCategoria();
}


if (isset($_POST["validarCategoria"])) {

    $valCate = new AjaxCategorias();
    $valCate->validarCategoria = $_POST["validarCategoria"];

    $valCate->ajaxValidadCategoria();
}


/*=============================================
EDITAR CATEGORIA
=============================================*/
if (isset($_POST["idCategoria"])) {

    $editar = new AjaxCategorias();
    $editar->idCategoria = $_POST["idCategoria"];
    $editar->ajaxEditarCategoria();
}
