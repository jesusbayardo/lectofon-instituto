


var guardarSlide = $(".guardarSlide");
var tipoSlide = $(".tipoSlide");
var tipoSlideIzq = $(".tipoSlideIzq");
var tipoSlideDer = $(".tipoSlideDer");
var slideOpciones = $(".slideOpciones");
var previsualizarFondo = $(".previsualizarFondo");
var previsualizarProducto = $(".previsualizarProducto");
var subirFondo = null;
var subirImgProducto = null;
$(".nombreSlide").change(function () {

    var nombre = $(this).val();
    var indiceSlide = $(this).attr("indice")

    $(guardarSlide[indiceSlide]).attr("nombreSlide", nombre)

})




/*=============================================
CAMBIO DE FONDO
=============================================*/
$(".subirFondo").change(function () {

    var imagenFondo = this.files[0];
    console.log(imagenFondo );

    var indiceSlide = $(this).attr("indice");

    /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if (imagenFondo["type"] != "image/jpeg" && imagenFondo["type"] != "image/png") {

        $(".subirFondo").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else if (imagenFondo["size"] > 2000000) {

        $(".subirFondo").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagenFondo);

        $(datosImagen).on("load", function (event) {

            var rutaImagen = event.target.result;
            $(previsualizarFondo[indiceSlide]).attr("src", rutaImagen);
            $(slideOpciones[indiceSlide]).parent().children('.cambiarFondo').attr("src", rutaImagen);
            $(guardarSlide[indiceSlide]).attr("imgFondo", "");

        })



    }

})



//******************************
//*******************************
//******************GUARDAR SLIDE

$(".guardarSlide").click(function () {
    var id = $(this).attr("id");
    var indiceSlide = $(this).attr("indice")
    var nombre = $(this).attr("nombreSlide");

    var imgFondo = $(this).attr("imgFondo");
  

    if(imgFondo == ""){

		subirFondo = $(".subirFondo");
		imgFondo = $(this).attr("rutaImgFondo");

	}

    
    //GUARDAR SLIDE//GUARDAR SLIDE//GUARDAR SLIDE
    var datos = new FormData();
    datos.append("id", id);
    datos.append("nombre", nombre);
    datos.append("imgFondo", imgFondo)

    if (subirFondo != null) {

        datos.append("subirFondo", subirFondo[indiceSlide].files[0]);

    } else {

        datos.append("subirFondo", subirFondo);
    }

   
    $.ajax({

        url: "ajax/slide.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

            console.log(respuesta)

            if (respuesta != null) {

                swal({
                    type: "success",
                    title: "El slide ha sido cambiado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then((result) => {
                    if (result.value) {

                        window.location = "slide";

                    }
                })
            }

        }

    })


})



