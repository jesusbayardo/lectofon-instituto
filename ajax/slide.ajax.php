<?php
require_once "../controladores/slide.controlador.php";
require_once "../modelos/slide.modelo.php";


class AjaxSlide{
   
    public $id;
    public $imgFondo;
    public $subirFondo; 
    

/*cambiar Slide*//*cambiar Slide*//*cambiar Slide*//*cambiar Slide*//*cambiar Slide*//*cambiar Slide*//*cambiar Slide*//*cambiar Slide*/

public function ajaxCambiarSlide(){
$datos=array(
    "id"=>$this->id,
   
    "imgFondo"=>$this->imgFondo,
    "subirFondo"=>$this->subirFondo,


);
$repuesta=ControladorSlide::ctrActualizarSlide($datos);
echo $repuesta;

}
}

/*cambiar Slide*//*cambiar Slide*//*cambiar Slide*//*cambiar Slide*//*cambiar Slide*//*cambiar Slide*//*cambiar Slide*//*cambiar Slide*/
if(isset($_POST["id"])){
$slide=new AjaxSlide();
$slide->id=$_POST["id"];

$slide->imgFondo=$_POST["imgFondo"];

if(isset($_FILES["subirFondo"]))
{
    $slide->subirFondo=$_FILES["subirFondo"];

}else{

    $slide->subirFondo=null;
}


$slide->ajaxCambiarSlide();


}