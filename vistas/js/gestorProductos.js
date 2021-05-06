/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

/* $.ajax({

	  url:"ajax/tablaProductos.ajax.php",
	success:function(respuesta){
		
		console.log("respuesta", respuesta);

	  }
 })
*/

$('.tablaProductos').DataTable({

	"ajax": "ajax/tablaProductos.ajax.php",
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
ACTIVAR PRODUCTO
=============================================*/
$('.tablaProductos tbody').on("click", ".btnActivar", function () {

	var idProducto = $(this).attr("idProducto");
	var estadoProducto = $(this).attr("estadoProducto");
	console.log(idProducto)
	console.log(estadoProducto)

	var datos = new FormData();
	datos.append("activarId", idProducto);
	datos.append("activarProducto", estadoProducto);

	$.ajax({

		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {

			console.log("respuesta", respuesta);

		}

	})

	if (estadoProducto == 0) {

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoProducto', 1);

	} else {

		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoProducto', 0);

	}

})



/*=============================================
REVISAR SI EL TITULO DEL PRODUCTO YA EXISTE
=============================================*/

$(".validarProducto").change(function () {

	$(".alert").remove();

	var producto = $(this).val();

	var datos = new FormData();
	datos.append("validarProducto", producto);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			if (respuesta.length != 0) {

				$(".validarProducto").parent().after('<div class="alert alert-warning">Este título de producto ya existe en la base de datos</div>');

				$(".validarProducto").val("");

			}

		}

	})

})





/*=============================================
RUTA PRODUCTO
=============================================*/

function limpiarUrl(texto) {
	var texto = texto.toLowerCase();
	texto = texto.replace(/[á]/, 'a');
	texto = texto.replace(/[é]/, 'e');
	texto = texto.replace(/[í]/, 'i');
	texto = texto.replace(/[ó]/, 'o');
	texto = texto.replace(/[ú]/, 'u');
	texto = texto.replace(/[ñ]/, 'n');
	texto = texto.replace(/ /g, "-")
	return texto;
}

$(".tituloProducto").change(function () {

	$(".rutaProducto").val(limpiarUrl($(".tituloProducto").val()));

})



/*=============================================
AGREGAR MULTIMEDIA CON DROPZONE
=============================================*/

var arrayFiles = [];

$(".multimediaFisica").dropzone({

	url: "/",
	addRemoveLinks: true,
	acceptedFiles: "image/jpeg, image/png",
	maxFilesize: 2,
	maxFiles: 10,
	init: function () {

		this.on("addedfile", function (file) {

			arrayFiles.push(file);

			// console.log("arrayFiles", arrayFiles);

		})

		this.on("removedfile", function (file) {

			var index = arrayFiles.indexOf(file);

			arrayFiles.splice(index, 1);

			// console.log("arrayFiles", arrayFiles);

		})

	}

})



/*=============================================
SELECCIONAR SUBCATEGORÍA
=============================================*/

$(".seleccionarCategoria").change(function () {

	var categoria = $(this).val();
	console.log(categoria)
	$(".seleccionarSubCategoria").html("");

	$("#modalEditarProducto .seleccionarSubCategoria").html("");

	var datos = new FormData();
	datos.append("idCategoriap", categoria);

	$.ajax({
		url: "ajax/subcategorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			console.log("respuesta", respuesta);

			$(".entradaSubcategoria").show();

			respuesta.forEach(funcionForEach);

			function funcionForEach(item, index) {

				$(".seleccionarSubCategoria").append(

					'<option value="' + item["id"] + '">' + item["subcategoria"] + '</option>'

				)

			}

		}

	})

})



/*=============================================
SUBIENDO LA FOTO DE PORTADA
=============================================*/

var imagenPortada = null;

$(".fotoPortada").change(function () {

	imagenPortada = this.files[0];

	/*=============================================
		VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
		=============================================*/

	if (imagenPortada["type"] != "image/jpeg" && imagenPortada["type"] != "image/png") {

		$(".fotoPortada").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else if (imagenPortada["size"] > 2000000) {

		$(".fotoPortada").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar más de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagenPortada);

		$(datosImagen).on("load", function (event) {

			var rutaImagen = event.target.result;

			$(".previsualizarPortada").attr("src", rutaImagen);

		})

	}

})



/*=============================================
SUBIENDO LA FOTO PRINCIPAL
=============================================*/

var imagenFotoPrincipal = null;

$(".fotoPrincipal").change(function () {

	imagenFotoPrincipal = this.files[0];

	/*=============================================
		VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
		=============================================*/

	if (imagenFotoPrincipal["type"] != "image/jpeg" && imagenFotoPrincipal["type"] != "image/png") {

		$(".fotoPrincipal").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else if (imagenFotoPrincipal["size"] > 2000000) {

		$(".fotoPrincipal").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar más de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagenFotoPrincipal);

		$(datosImagen).on("load", function (event) {

			var rutaImagen = event.target.result;

			$(".previsualizarPrincipal").attr("src", rutaImagen);

		})

	}

})




/*=============================================
GUARDAR EL PRODUCTO
=============================================*/

var multimediaFisica = null;
var multimediaVirtual = null;


$(".guardarProducto").click(function () {

	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/

	if ($(".tituloProducto").val() != "" &&
		$(".seleccionarCategoria").val() != "" &&
		$(".seleccionarSubCategoria").val() != "" &&
		$(".descripcionProducto").val() != ""
		&& $(".precio").val() != ""
	) {

		/*=============================================
			  PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA O LINK DE YOUTUBE
			  =============================================*/

		if (arrayFiles.length > 0 && $(".rutaProducto").val() != "") {

			var listaMultimedia = [];
			var finalFor = 0;

			for (var i = 0; i < arrayFiles.length; i++) {

				var datosMultimedia = new FormData();
				datosMultimedia.append("file", arrayFiles[i]);
				datosMultimedia.append("ruta", $(".rutaProducto").val());

				$.ajax({
					url: "ajax/productos.ajax.php",
					method: "POST",
					data: datosMultimedia,
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function () {

						$(".modal-footer .preload").html(`


							 <center>

								 <img src="vistas/img/plantilla/status.gif" id="status" />
								 <br>

							 </center>

						 `);

					},
					success: function (respuesta) {

						$("#status").remove();

						listaMultimedia.push({ "foto": respuesta.substr(3) })
						multimediaFisica = JSON.stringify(listaMultimedia);
						multimediaVirtual = null;

						if (multimediaFisica == null) {

							swal({
								title: "El campo de multimedia no debe estar vacío",
								type: "error",
								confirmButtonText: "¡Cerrar!"
							});

							return;

						}

						if ((finalFor + 1) == arrayFiles.length) {

							agregarMiProducto(multimediaFisica);
							finalFor = 0;

						}

						finalFor++;

					}

				})

			}

		}


		//	agregarMiProducto(multimediaVirtual);



	} else {

		swal({
			title: "Llenar todos los campos obligatorios",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

		return;
	}

})



function agregarMiProducto(imagen) {

	/*=============================================
	ALMACENAMOS TODOS LOS CAMPOS DE PRODUCTO
	=============================================*/

	var tituloProducto = $(".tituloProducto").val();
	var rutaProducto = $(".rutaProducto").val();
	//	var seleccionarTipo = $(".seleccionarTipo").val();
	var seleccionarCategoria = $(".seleccionarCategoria").val();
	var seleccionarSubCategoria = $(".seleccionarSubCategoria").val();
	var descripcionProducto = $(".descripcionProducto").val();
	//var pClavesProducto = $(".pClavesProducto").val();
	var precio = $(".precio").val();
	//	var peso = $(".peso").val();
	var entrega = $(".entrega").val();
	//	var selActivarOferta = $(".selActivarOferta").val();
	//	var precioOferta = $(".precioOferta").val();
	//var descuentoOferta = $(".descuentoOferta").val();
	//	var finOferta = $(".finOferta").val();



	//var detallesString = JSON.stringify(detalles);

	var datosProducto = new FormData();
	datosProducto.append("tituloProducto", tituloProducto);
	datosProducto.append("rutaProducto", rutaProducto);
	//	datosProducto.append("seleccionarTipo", seleccionarTipo);	
	//	datosProducto.append("detalles", detallesString);	
	datosProducto.append("seleccionarCategoria", seleccionarCategoria);
	datosProducto.append("seleccionarSubCategoria", seleccionarSubCategoria);
	datosProducto.append("descripcionProducto", descripcionProducto);
	//	datosProducto.append("pClavesProducto", pClavesProducto);
	datosProducto.append("precio", precio);
	//datosProducto.append("peso", peso);
	datosProducto.append("entrega", entrega);

	datosProducto.append("multimedia", imagen);

	datosProducto.append("fotoPortada", imagenPortada);
	datosProducto.append("fotoPrincipal", imagenFotoPrincipal);
	//datosProducto.append("selActivarOferta", selActivarOferta);
	//datosProducto.append("precioOferta", precioOferta);
	//datosProducto.append("descuentoOferta", descuentoOferta);
	//datosProducto.append("finOferta", finOferta);
	//datosProducto.append("fotoOferta", imagenOferta);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datosProducto,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {

			// console.log("respuesta", respuesta);

			if (respuesta == "ok") {

				swal({
					type: "success",
					title: "El producto ha sido guardado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function (result) {
					if (result.value) {

						window.location = "productos";

					}
				})
			}

		}

	})

}




/*=============================================
EDITAR PRODUCTO
=============================================*/

$('.tablaProductos tbody').on("click", ".btnEditarProducto", function () {

	$(".previsualizarImgFisico").html("");

	var idProducto = $(this).attr("idProducto");

	console.log(idProducto)
	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({

		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			$("#modalEditarProducto .idProducto").val(respuesta[0]["id"]);
			$("#modalEditarProducto .tituloProducto").val(respuesta[0]["titulo"]);
			$("#modalEditarProducto .rutaProducto").val(respuesta[0]["ruta"]);

			/*=============================================
			TRAER EL TIPO DE PRODUCTO
			=============================================*/

			//	$("#modalEditarProducto .seleccionarTipo").val(respuesta[0]["tipo"]);

			/*=============================================
			CUANDO EL PRODUCTO ES VIRTUAL
			=============================================*/

			if (respuesta[0]["tipo"] == "virtual") {

				$(".multimediaVirtual").show();
				$(".multimediaFisica").hide();

				$("#modalEditarProducto .multimedia").val(respuesta[0]["multimedia"]);

				$(".detallesVirtual").show();
				$(".detallesFisicos").hide();

				var detalles = JSON.parse(respuesta[0]["detalles"]);

				$("#modalEditarProducto .detalleClases").val(detalles.Clases);
				$("#modalEditarProducto .detalleTiempo").val(detalles.Tiempo);
				$("#modalEditarProducto .detalleNivel").val(detalles.Nivel);
				$("#modalEditarProducto .detalleAcceso").val(detalles.Acceso);
				$("#modalEditarProducto .detalleDispositivo").val(detalles.Dispositivo);
				$("#modalEditarProducto .detalleCertificado").val(detalles.Certificado);

				/*=============================================
				CUANDO EL PRODUCTO ES FÍSICO
				=============================================*/

			} else {

				$(".multimediaVirtual").hide();
				$(".multimediaFisica").show();

				if (respuesta[0]["multimedia"] != "") {

					var imagenesMultimedia = JSON.parse(respuesta[0]["multimedia"]);

					for (var i = 0; i < imagenesMultimedia.length; i++) {

						$(".previsualizarImgFisico").append(

							'<div class="col-md-3">' +
							'<div class="thumbnail text-center">' +
							'<img class="imagenesRestantes" src="' + imagenesMultimedia[i].foto + '" style="width:100%">' +
							'<div class="removerImagen" style="cursor:pointer">Remove file</div>' +
							'</div>' +

							'</div>'

						);

						localStorage.setItem("multimediaFisica", JSON.stringify(imagenesMultimedia));

					}

					/*=============================================
					CUANDO ELIMINAMOS UNA IMAGEN DE LA LISTA
					=============================================*/

					$(".removerImagen").click(function () {

						$(this).parent().parent().remove();

						var imagenesRestantes = $(".imagenesRestantes");
						var arrayImgRestantes = [];

						for (var i = 0; i < imagenesRestantes.length; i++) {

							arrayImgRestantes.push({ "foto": $(imagenesRestantes[i]).attr("src") })

						}

						localStorage.setItem("multimediaFisica", JSON.stringify(arrayImgRestantes));

					})

				}



			}

			/*=============================================
			TRAEMOS LA CATEGORIA
			=============================================*/

			if (respuesta[0]["id_categoria"] != 0) {

				var datosCategoria = new FormData();
				datosCategoria.append("idCategoria", respuesta[0]["id_categoria"]);


				$.ajax({

					url: "ajax/categorias.ajax.php",
					method: "POST",
					data: datosCategoria,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function (respuesta) {

						$("#modalEditarProducto .seleccionarCategoria").val(respuesta["id"]);
						$("#modalEditarProducto .optionEditarCategoria").html(respuesta["categoria"]);


					}

				})

			} else {


				$("#modalEditarProducto .optionEditarCategoria").html("SIN CATEGORÍA");

			}

			/*=============================================
			TRAEMOS LA SUBCATEGORIA
			=============================================*/

			if (respuesta[0]["id_subcategoria"] != 0) {
				console.log(respuesta[0]["id_subcategoria"])
				var datosSubCategoria = new FormData();
				datosSubCategoria.append("idCategoriap", respuesta[0]["id_categoria"]);

				$.ajax({

					url: "ajax/subcategorias.ajax.php",
					method: "POST",
					data: datosSubCategoria,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function (respuesta) {
						console.log(respuesta)

						$("#modalEditarProducto .optionEditarSubCategoria").val(respuesta[0]["id"]);
						$("#modalEditarProducto .optionEditarSubCategoria").html(respuesta[0]["subcategoria"]);

						var datosCategoria = new FormData();
						datosCategoria.append("idCategoriap", respuesta[0]["id_categoria"]);

						$.ajax({

							url: "ajax/subcategorias.ajax.php",
							method: "POST",
							data: datosCategoria,
							cache: false,
							contentType: false,
							processData: false,
							dataType: "json",
							success: function (respuesta) {

								respuesta.forEach(funcionForEach);

								function funcionForEach(item, index) {

									$("#modalEditarProducto .seleccionarSubCategoria").append(

										'<option value="' + item["id"] + '">' + item["subcategoria"] + '</option>'

									)

								}

							}

						})

					}

				})

			} else {

				$("#modalEditarProducto  .optionEditarSubCategoria").html("SIN CATEGORÍA");

			}



			/*=============================================
			CARGAMOS LA IMAGEN PRINCIPAL
			=============================================*/
			$("#modalEditarProducto .previsualizarPortada").attr("src", respuesta[0]["portada"]);
			$("#modalEditarProducto .antiguaFotoPortada").val(respuesta[0]["portada"]);


			$("#modalEditarProducto .previsualizarPrincipal").attr("src", respuesta[0]["portada"]);
			$("#modalEditarProducto .antiguaFotoPrincipal").val(respuesta[0]["portada"]);
			$("#modalEditarProducto .descripcionProducto").val(respuesta[0]["descripcion"]);

			/*=============================================
			CARGAMOS EL PRECIO, PESO Y DIAS DE ENTREGA
			=============================================*/
			$("#modalEditarProducto .precio").val(respuesta[0]["precio"]);
			$("#modalEditarProducto .peso").val(respuesta[0]["peso"]);
			$("#modalEditarProducto .entrega").val(respuesta[0]["entrega"]);

			/*=============================================
			PREGUNTAMOS SI EXITE OFERTA
			=============================================*/



			/*=============================================
			CREAR NUEVA OFERTA AL EDITAR
			=============================================*/

		



			/*=============================================
			GUARDAR CAMBIOS DEL PRODUCTO
			=============================================*/

			var multimediaFisica = null;
			var multimediaVirtual = null;

			$(".guardarCambiosProducto").click(function () {

				/*=============================================
				PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
				=============================================*/

				if ($("#modalEditarProducto .tituloProducto").val() != "" &&
					$("#modalEditarProducto .seleccionarCategoria").val() != "" &&
					$("#modalEditarProducto .seleccionarSubCategoria").val() != "" &&
					$("#modalEditarProducto .descripcionProducto").val() != "" 
				) {

					/*=============================================
						  PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA O LINK DE YOUTUBE
						  =============================================*/

					if ($("#modalEditarProducto .seleccionarTipo").val() != "virtual") {

						if (arrayFiles.length > 0 && $("#modalEditarProducto .rutaProducto").val() != "") {

							var listaMultimedia = [];
							var finalFor = 0;

							for (var i = 0; i < arrayFiles.length; i++) {

								var datosMultimedia = new FormData();
								datosMultimedia.append("file", arrayFiles[i]);
								datosMultimedia.append("ruta", $("#modalEditarProducto .rutaProducto").val());

								$.ajax({
									url: "ajax/productos.ajax.php",
									method: "POST",
									data: datosMultimedia,
									cache: false,
									contentType: false,
									processData: false,
									beforeSend: function () {

										$(".modal-footer .preload").html(`


												<center>

													<img src="vistas/img/plantilla/status.gif" id="status" />
													<br>

												</center>

											`);

									},
									success: function (respuesta) {

										$("#status").remove();

										listaMultimedia.push({ "foto": respuesta.substr(3) });
										multimediaFisica = JSON.stringify(listaMultimedia);

										if (localStorage.getItem("multimediaFisica") != null) {

											var jsonLocalStorage = JSON.parse(localStorage.getItem("multimediaFisica"));

											var jsonMultimediaFisica = listaMultimedia.concat(jsonLocalStorage);

											multimediaFisica = JSON.stringify(jsonMultimediaFisica);
										}

										multimediaVirtual = null;

										if (multimediaFisica == null) {

											swal({
												title: "El campo de multimedia no debe estar vacío",
												type: "error",
												confirmButtonText: "¡Cerrar!"
											});

											return;
										}


										if ((finalFor + 1) == arrayFiles.length) {

											editarMiProducto(multimediaFisica);
											finalFor = 0;

										}

										finalFor++;

									}

								})

							}

						} else {

							var jsonLocalStorage = JSON.parse(localStorage.getItem("multimediaFisica"));

							multimediaFisica = JSON.stringify(jsonLocalStorage);

							editarMiProducto(multimediaFisica);

						}

					} else {

						multimediaVirtual = $("#modalEditarProducto .multimedia").val();
						multimediaFisica = null;

						if (multimediaVirtual == null) {

							swal({
								title: "El campo de multimedia no debe estar vacío",
								type: "error",
								confirmButtonText: "¡Cerrar!"
							});

							return;
						}

						editarMiProducto(multimediaVirtual);

					}

				} else {

					swal({
						title: "Llenar todos los campos obligatorios",
						type: "error",
						confirmButtonText: "¡Cerrar!"
					});

					return;

				}

			})

		}

	})

})

function editarMiProducto(imagen) {

	var idProducto = $("#modalEditarProducto .idProducto").val();
	var tituloProducto = $("#modalEditarProducto .tituloProducto").val();
	var rutaProducto = $("#modalEditarProducto .rutaProducto").val();

	var seleccionarCategoria = $("#modalEditarProducto .seleccionarCategoria").val();
	var seleccionarSubCategoria = $("#modalEditarProducto .seleccionarSubCategoria").val();
	var descripcionProducto = $("#modalEditarProducto .descripcionProducto").val();

	var precio = $("#modalEditarProducto .precio").val();
	var entrega = $("#modalEditarProducto .entrega").val();
	var antiguaFotoPortada = $("#modalEditarProducto .antiguaFotoPortada").val();
	var antiguaFotoPrincipal = $("#modalEditarProducto .antiguaFotoPrincipal").val();
	
	
	var datosProducto = new FormData();
	datosProducto.append("id", idProducto);
	datosProducto.append("editarProducto", tituloProducto);
	datosProducto.append("rutaProducto", rutaProducto);
	
	
	datosProducto.append("seleccionarCategoria", seleccionarCategoria);
	datosProducto.append("seleccionarSubCategoria", seleccionarSubCategoria);
	datosProducto.append("descripcionProducto", descripcionProducto);
	
	datosProducto.append("precio", precio);

	datosProducto.append("entrega", entrega);

	if (imagen == null) {

		multimediaFisica = localStorage.getItem("multimediaFisica");
		datosProducto.append("multimedia", multimediaFisica);

	} else {

		datosProducto.append("multimedia", imagen);
	}



	datosProducto.append("fotoPortada", imagenPortada);
	datosProducto.append("fotoPrincipal", imagenFotoPrincipal);



	//datosProducto.append("fotoOferta", imagenOferta);
	datosProducto.append("antiguaFotoPortada", antiguaFotoPortada);
	datosProducto.append("antiguaFotoPrincipal", antiguaFotoPrincipal);
	
	

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datosProducto,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {


			if (respuesta == "ok") {

				swal({
					type: "success",
					title: "El producto ha sido cambiado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function (result) {
					if (result.value) {

						localStorage.removeItem("multimediaFisica");
						localStorage.clear();
						window.location = "productos";

					}
				})
			}

		}

	})

}


/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$('.tablaProductos tbody').on("click", ".btnEliminarProducto", function () {


	var idProducto = $(this).attr("idProducto");
	var imgOferta = $(this).attr("imgOferta");
	var rutaCabecera = $(this).attr("rutaCabecera");
	var imgPortada = $(this).attr("imgPortada");
	var imgPrincipal = $(this).attr("imgPrincipal");

	swal({
		title: '¿Está seguro de borrar el producto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar producto!'
	}).then(function (result) {

		if (result.value) {

			window.location = "index.php?ruta=productos&idProducto=" + idProducto + "&imgOferta=" + imgOferta + "&rutaCabecera=" + rutaCabecera + "&imgPortada=" + imgPortada + "&imgPrincipal=" + imgPrincipal;

		}

	})




})


