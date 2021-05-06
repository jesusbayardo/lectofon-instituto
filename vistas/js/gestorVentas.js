/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

/*$.ajax({

   url:"ajax/tablaVentas.ajax.php",
   success:function(respuesta){
   	
       console.log("respuesta", respuesta);

     }

})
*/
$(".tablaVentas").DataTable({
    "ajax": "ajax/tablaVentas.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }


});

/*=============================================
PROCESO DE ENVÍO
=============================================*/


$(".tablaVentas tbody").on("click", ".btnEnvio", function () {


    var idVenta = $(this).attr("idVenta");
    var etapa = $(this).attr("etapa");

    var datos = new FormData();
    datos.append("idVenta", idVenta);
    datos.append("etapa", etapa);

    $.ajax({

        url: "ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

            console.log("respuesta", respuesta);

        }

    });

    if (etapa == 1) {

        $(this).addClass('btn-warning');
        $(this).removeClass('btn-danger');
        $(this).html('Enviando el producto');
        $(this).attr('etapa', 2);

    }

    if (etapa == 2) {

        $(this).addClass('btn-success');
        $(this).removeClass('btn-warning');
        $(this).html('Producto entregado');

    }


})




/*=============================================
REFUSED DE VENTAS
=============================================*/
$(".tablaVentas").on("click", ".btnreembolso", function () {

    var started = "started";

    var idReembolso = $(this).attr("idrembolso");
    var estadoReembolso = $(this).attr("estadoReembolso");
    console.log(estadoReembolso)

    if (estadoReembolso == 0) {
        swal({
            title: "¿Desea realizar el reembolso?",

            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "NO",
            confirmButtonText: "SI"

        }).then((result) => {
            if (result.value) {

                var datos = new FormData();
                datos.append("idReembolso", idReembolso);

                $.ajax({
                    url: "ajax/ventas.ajax.php",
                    method: "POST",
                    data: datos,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {
                        //location.reload();
                    }
                })


                var respuestarefused = null;
                var data = new FormData();
                data.append("started", started);
                console.log("incia ajax")
                $.ajax({
                    url: "ajax/ventas.ajax.php",
                    method: "POST",
                    async: false,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        respuestarefused = respuesta;
                        console.log("refused", respuestarefused)
                    }
                })


                var respuestaRefusedServer = null;
                var respuestaRefusedPassword = null;



                // inserta datos en refused y ejecuta refused

                  respuestaRefusedServer = respuestarefused["serve"];
                  respuestaRefusedPassword = respuestarefused["passserver"];
                  var dataresult = new FormData();
                  dataresult.append("clientServe", respuestaRefusedServer);
                  dataresult.append("passServe", respuestaRefusedPassword);
                  dataresult.append("idTransaccion", idReembolso);
                  $.ajax({
                      url: "ajax/ventas.ajax.php",
                      method: "POST",
                      async: false,
                      data: data,
                      cache: false,
                      contentType: false,
                      processData: false,
                      dataType: "json",
                      success: function (respuesta) {
                        console.log("respuesta refused");
                        console.log( respuesta);
                      }
                  })
  
  


                  swal({
                        type: "success",
                        title: "El rembolso fue procesado",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    })
                    location.reload();
            }

        });

    } else {
        swal({
            type: "error",
            title: "El reembolso ya fue procesado",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
        }).then((result) => {
            if (result.value) {

                return;

            }
        });


    }





})


