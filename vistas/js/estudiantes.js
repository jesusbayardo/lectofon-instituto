


$(".tablaEstudiantes").DataTable({
    "ajax": "ajax/tablaEstudiantes.ajax.php",
    "deferReder": true,
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












//revisar cliente repetido

$("#cedulaEstudiante").change(function () {

    $(".alert").remove();
    var cedulaEstudiante = $(this).val();
    console.log("ingreso")

    var datos = new FormData();
    datos.append("validarEstudiante", cedulaEstudiante);
    $.ajax({

        url: "ajax/estudiantes.ajax.php",
        method: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta.length)

            if (respuesta.length != 0) {
                $("#cedulaEstudiante").parent().after('<div class="alert alert-warning">Cédula ya existe</div>');
                $("#cedulaEstudiante").val("");
            }
        }
    });
});



//revisar correo repetido

$("#emailEstudiante").change(function () {

    $(".alert").remove();
    var emailEstudiante = $(this).val();
    console.log("ingreso")

    var datos = new FormData();
    datos.append("emailEstudiante", emailEstudiante);
    $.ajax({

        url: "ajax/estudiantes.ajax.php",
        method: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta.length)

            if (respuesta.length != 0) {

                $("#emailEstudiante").parent().after('<div class="alert alert-warning">Correo electrónico ya existe</div>');

                $("#emailEstudiante").val("");
            }

        }
    });

})


$(function () {
    $('#fechaEstudiante').on('change', calcularEdad);
});

function calcularEdad() {

    fecha = $(this).val();
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    console.log(edad)

    if (edad < 7) {
        swal({
            type: "error",
            title: "El estudiante debe tener mínimo 7 años de edad",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
        }).then(function (result) {
            if (result.value) {

                $('#fechaEstudiante').val("");
                return;

            }
        })

    }



}


/*=============================================
EDITAR ESTUDIANTE
=============================================*/
$(".tablaEstudiantes").on("click", ".btnEditarEstudiante", function () {
    

    var idEstudiante = $(this).attr("idEstudiante");
    console.log(idEstudiante)
    var datos = new FormData();
    datos.append("idEstudianteEditar", idEstudiante);

    $.ajax({

        url: "ajax/estudiantes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta["cedula"])

            $("#editarCedulaEstudiante").val(respuesta["cedula"]);
            $("#editarNombresEstudiante").val(respuesta["nombres"]);
            $("#EditarFechaEstudiante").val(respuesta["fecha_nacimiento"]);
            $("#editarEmailEstudiante").val(respuesta["email"]);
            $("#oldpasswordEstudiante").val(respuesta["password"]);
               

        }

    })

})