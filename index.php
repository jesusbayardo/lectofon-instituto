<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/administradores.controlador.php";
require_once "controladores/banner.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/comercio.controlador.php";
require_once "controladores/perfiles.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/slide.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/subcategorias.controlador.php";
require_once "controladores/notificaciones.controlador.php";
require_once "controladores/estudiantes.controlador.php";

require_once "modelos/administradores.modelos.php";
require_once "modelos/estudiantes.modelo.php";
require_once "modelos/banner.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/plantilla.modelo.php";
require_once "modelos/comercio.modelo.php";
require_once "modelos/perfiles.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/slide.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/rutas.php";
require_once "modelos/subcategorias.modelo.php";
require_once "modelos/notificaciones.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->plantilla();


?>