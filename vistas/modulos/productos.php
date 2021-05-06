<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      GESTOR DE PRODUCTOS
      <small>lectofon</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> INICIO</a></li>

      <li class="active">Gestor de productos</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
            Agregar Producto
          </button>

        </div>

      </div>




      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Titulo</th>
              <th>Categoria</th>
              <th>Subcategoria</th>
              <th>Precio Normal</th>
              <th>Estado</th>
              <th>Entrega</th>
              <th>acciones</th>



            </tr>

          </thead>

        </table>


      </div>

      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->




<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- <form role="form" method="post" enctype="multipart/form-data"> -->

      <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar producto</h4>

      </div>

      <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!--=====================================
            ENTRADA PARA EL TÍTULO
            ======================================-->

          <div class="form-group">
            <label for="">Producto</label>
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

              <input type="text" class="form-control input-lg validarProducto tituloProducto" placeholder="Ingresar título producto">

            </div>

          </div>

          <!--=====================================
            ENTRADA PARA LA RUTA DEL PRODUCTO
            ======================================-->

          <div class="form-group">
            <label for="">Ruta Producto</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-link"></i></span>

              <input type="text" class="form-control input-lg rutaProducto" placeholder="Ruta url del producto" readonly>

            </div>

          </div>



          <!--=====================================
            ENTRADA PARA AGREGAR MULTIMEDIA
            ======================================-->

          <div class="form-group agregarMultimedia">



            <!--=====================================
              SUBIR MULTIMEDIA DE PRODUCTO FÍSICO
              ======================================-->

            <div class="multimediaFisica needsclick dz-clickable">

              <div class="dz-message needsclick">

                Arrastrar o dar click para subir imagenes.

              </div>

            </div>
            <input type="hidden" class="valorMultimedia">
          </div>




          <!--=====================================
            AGREGAR CATEGORÍA
            ======================================-->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-th"></i></span>

              <select class="form-control input-lg seleccionarCategoria">

                <option value="">Selecionar categoría</option>

                <?php

                $item = null;
                $valor = null;

                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                foreach ($categorias as $key => $value) {

                  echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                }

                ?>

              </select>

            </div>

          </div>

          <!--=====================================
            AGREGAR SUBCATEGORÍA
            ======================================-->

          <div class="form-group  entradaSubcategoria" style="display:none">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-th"></i></span>

              <select class="form-control input-lg seleccionarSubCategoria">

              </select>

            </div>

          </div>

          <!--=====================================
            AGREGAR DESCRIPCIÓN
            ======================================-->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

              <textarea type="text" maxlength="320" rows="3" class="form-control input-lg descripcionProducto" placeholder="Ingresar descripción producto"></textarea>

            </div>

          </div>



          <!--=====================================
            AGREGAR FOTO DE PORTADA
            ======================================

          <div class="form-group">

            <div class="panel">SUBIR FOTO PORTADA</div>

            <input type="file" class="fotoPortada">

            <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>



          </div>-->

          <!--=====================================
            AGREGAR FOTO DE MULTIMEDIA
            ======================================-->

          <div class="form-group">

            <div class="panel">SUBIR FOTO PRINCIPAL DEL PRODUCTO</div>

            <input type="file" class="fotoPrincipal">

            <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>



          </div>

          <!--=====================================
            AGREGAR PRECIOY ENTREGA
            ======================================-->

          <div class="form-group row">

            <!-- PRECIO -->

            <div class="col-md-4 col-xs-12">

              <div class="panel">PRECIO</div>

              <div class="input-group">

                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                <input type="number" class="form-control input-lg precio" min="0" step="any">

              </div>

            </div>



            <!-- ENTREGA -->

            <div class="col-md-4 col-xs-12">

              <div class="panel">DÍAS DE ENTREGA</div>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                <input type="number" class="form-control input-lg entrega" min="0" value="0">

              </div>

            </div>

          </div>



        </div>

      </div>

      <!--=====================================
        PIE DEL MODAL
        ======================================-->

      <div class="modal-footer">

        <div class="preload"></div>

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="button" class="btn btn-primary guardarProducto">Guardar producto</button>

      </div>

      <!-- </form> -->

    </div>

  </div>

</div>






<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar producto</h4>

      </div>

      <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!--=====================================
            ENTRADA PARA EL TÍTULO
            ======================================-->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

              <input type="text" class="form-control input-lg validarProducto tituloProducto" readonly>

              <input type="hidden" class="idProducto">
              <input type="hidden" class="idCabecera">

            </div>

          </div>

          <!--=====================================
            ENTRADA PARA LA RUTA DEL PRODUCTO
            ======================================-->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-link"></i></span>

              <input type="text" class="form-control input-lg rutaProducto" readonly>

            </div>

          </div>



          <!--=====================================
            ENTRADA PARA AGREGAR MULTIMEDIA
            ======================================-->

          <div class="form-group agregarMultimedia">

            <!--=====================================
              SUBIR MULTIMEDIA DE PRODUCTO VIRTUAL
              ======================================-->

            <div class="input-group multimediaVirtual" style="display:none">

              <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span>

              <input type="text" class="form-control input-lg multimedia">

            </div>

            <!--=====================================
              SUBIR MULTIMEDIA DE PRODUCTO FÍSICO
              ======================================-->

            <div class="row previsualizarImgFisico"></div>

            <div class="multimediaFisica needsclick dz-clickable" style="display:none">

              <div class="dz-message needsclick">

                Arrastrar o dar click para subir imagenes.

              </div>

            </div>

          </div>





          <!--=====================================
            AGREGAR CATEGORÍA
            ======================================-->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-th"></i></span>

              <select class="form-control input-lg seleccionarCategoria">

                <option class="optionEditarCategoria"></option>

                <?php

                $item = null;
                $valor = null;

                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                foreach ($categorias as $key => $value) {

                  echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                }

                ?>

              </select>

            </div>

          </div>

          <!--=====================================
            AGREGAR SUBCATEGORÍA
            ======================================-->

          <div class="form-group entradaSubcategoria">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-th"></i></span>

              <select class="form-control input-lg seleccionarSubCategoria">

                <option class="optionEditarSubCategoria"></option>

              </select>

            </div>

          </div>

          <!--=====================================
            AGREGAR DESCRIPCIÓN
            ======================================-->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

              <textarea type="text" maxlength="320" rows="3" class="form-control input-lg descripcionProducto"></textarea>

            </div>

          </div>


          <!--=====================================
            AGREGAR FOTO DE PORTADA
            ======================================

          <div class="form-group">

            <div class="panel">SUBIR FOTO PORTADA</div>

            <input type="file" class="fotoPortada">
            <input type="hidden" class="antiguaFotoPortada">

            <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>

            <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">

          </div>-->

          <!--=====================================
            AGREGAR FOTO DE MULTIMEDIA
            ======================================-->

          <div class="form-group">

            <div class="panel">SUBIR FOTO PRINCIPAL DEL PRODUCTO</div>

            <input type="file" class="fotoPrincipal">
            <input type="hidden" class="antiguaFotoPrincipal">

            <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>

            <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizarPrincipal" width="200px">

          </div>

          <!--=====================================
            AGREGAR PRECIO, PESO Y ENTREGA
            ======================================-->

          <div class="form-group row">

            <!-- PRECIO -->

            <div class="col-md-4 col-xs-12">

              <div class="panel">PRECIO</div>

              <div class="input-group">

                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                <input type="number" class="form-control input-lg precio" min="0" step="any">

              </div>

            </div>


            <!-- ENTREGA -->

            <div class="col-md-4 col-xs-12">

              <div class="panel">DÍAS DE ENTREGA</div>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                <input type="number" class="form-control input-lg entrega" min="0" value="0">

              </div>

            </div>

          </div>




        </div>

      </div>

      <!--=====================================
        PIE DEL MODAL
        ======================================-->

      <div class="modal-footer">

        <div class="preload"></div>

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="button" class="btn btn-primary guardarCambiosProducto">Guardar cambios</button>

      </div>

    </div>

  </div>

</div>
<?php

  $eliminarProducto = new ControladorProducto();
  $eliminarProducto -> ctrEliminarProducto();

?>