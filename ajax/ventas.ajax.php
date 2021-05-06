<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

require_once "../controladores/comercio.controlador.php";
require_once "../modelos/comercio.modelo.php";


class AjaxVentas{

	/*=============================================
	ACTUALIZAR PROCESO DE ENVÍO
	=============================================*/
	

  	public $idVenta;
  	public $etapa;

  	public function ajaxEnvioVenta(){

  		$respuesta = ModeloVentas::mdlActualizarVenta("compras", "envio", $this->etapa, "id", $this->idVenta);

  		echo $respuesta;

	}








    //ACTIVAR REEMBOLSO
    public $idReembolso;

    public function ajaxActivarReembolso()
    {
        $tabla = "compras";
        $item1 = "reembolso";
        $valor1 = 1;
        $item2 = "id_transaccion";
        $valor2 = $this->idReembolso;
        $respuesta = ModeloVentas::mdlActualizarReembolso($tabla, $item1, $valor1, $item2, $valor2);
        echo $respuesta;
    }


    //llamado datos server paymentez
    public $started;
    public function datoserver()
    {
        $datos = array(
            "started" => $this->started,
        );

        $respuesta = ControladorVentas::ctrServerPaymentez($datos);
        echo json_encode($respuesta);
    }



    // funcion para el refused

    public function refusedPaymentez()
    {
        $datos = array(
            "passServe" => $this->passServe,
            "clientServe" => $this->clientServe,
            "idTransaccion" => $this->idTransaccion,
        );

        $idTransaccion = $datos["idTransaccion"];
        $appcode = $datos["clientServe"];
        $appKey = $datos["passServe"];
        $fecha_actual = time();
        $variableTimestamp = (string)(time());
        $uniq_token_string = $appKey . $variableTimestamp;
        $uniq_token_hash = hash('sha256', $uniq_token_string);
        $auth_token = base64_encode($appcode . ';' . $variableTimestamp . ';' . $uniq_token_hash);
        //	$urlrefund='https://ccapi.paymentez.com/v2/transaction/refund/';
        $urlrefund = 'https://ccapi-stg.paymentez.com/v2/transaction/refund/';
        $data = array(
            'id' => $idTransaccion
        );
        $ch = curl_init($urlrefund);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        $payload = json_encode(array("transaction" => $data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json', 'Auth-Token:' . $auth_token
        ));
        $response = curl_exec($ch);
        $getresponse = json_decode($response, true);
        return $getresponse;
    }









}

/*=============================================
ACTUALIZAR PROCESO DE ENVÍO
=============================================*/


if(isset($_POST["idVenta"])){

	$envioVenta = new AjaxVentas();
	$envioVenta -> idVenta = $_POST["idVenta"];
	$envioVenta -> etapa = $_POST["etapa"];
	$envioVenta -> ajaxEnvioVenta();

}




/*=============================================
EJECURA REEMBOLSO
=============================================*/

if (isset($_POST["idReembolso"])) {
    $idReembolso = new AjaxVentas();
    $idReembolso->idReembolso = $_POST["idReembolso"];
    $idReembolso->ajaxActivarReembolso();
}


/*=============================================
LLAMADO DATOS CLIENTE PAYMENTEZ
=============================================*/
if (isset($_POST["started"])) {
    $started = new AjaxVentas();
    $started->started = $_POST["started"];
    $started->datoserver();
}


/*=============================================
REFUSED PAYMENTEZ
=============================================*/

if (isset($_POST["passServe"])) {

    $val = new AjaxVentas();
    $val->passServe = $_POST["passServe"];
    $val->clientServe = $_POST["clientServe"];
    $val->idTransaccion = $_POST["idTransaccion"];
    $val->refusedPaymentez();
}
