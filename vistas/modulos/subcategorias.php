<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      GESTOR DE SUBCATEGORÍAS
      <small>Lectofon</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> INICIO</a></li>
      <li class="active">Gestor de Subcategorías</li>
    </ol>
  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-borde">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSubcategorias">Agregar Subcategoria</button>


      </div>
      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaSubcategorias" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Subcategoria</th>
              <th>Ruta</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>



        </table>




      </div>


    </div>

  </section>




</div>



<div id="modalAgregarSubcategorias" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar subcategoría</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            <!--=====================================
            ENTRADA PARA EL NOMBRE DE LA SUBCATEGORÍA
            ======================================-->
                        <div class="form-group">
            <label for="">Ingrese Subcategoria</label>
              <div class="input-group">                       
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg validarSubCategoria tituloSubCategoria" name="tituloSubCategoria" placeholder="Ingresar subcategoría" required>
              </div>
            </div>

            <!--=====================================
            ENTRADA PARA LA RUTA DE LA SUBCATEGORÍA
            ======================================-->
            
            <div class="form-group">
              <label for="">Url subcategoría</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-link"></i></span> 

                <input type="text" class="form-control input-lg rutaSubCategoria" name="rutaSubCategoria" placeholder="Ruta url de la subcategoría" readonly required>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA SELECCIONAR LA CATEGORÍA
            ======================================-->

            <div class="form-group">
            <label for="">Seleccione categoría</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg seleccionarCategoria" name="seleccionarCategoria" required>
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>


  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar subcategoría</button>

        </div>

         <?php

          $crearSubCategoria = new ControladorSubCategorias();
          $crearSubCategoria -> ctrCrearSubCategoria();

        ?>

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR SUBCATEGORÍA
======================================-->

<div id="modalEditarSubCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar subcategoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
            ENTRADA PARA EDITAR EL TITULO DE LA SUBCATEGORÍA
            ======================================-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg validarSubCategoria tituloSubCategoria"  name="editarTituloSubCategoria" required>

                <input type="hidden" class="editarIdSubCategoria" name="editarIdSubCategoria">
                <input type="hidden" class="editarIdCabecera" name="editarIdCabecera">

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA EDITAR LA RUTA DE LA SUBCATEGORÍA
            ======================================-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-link"></i></span> 

                <input type="text" class="form-control input-lg rutaSubCategoria" name="rutaSubCategoria" readonly required>

              </div>

            </div>

            <!--=====================================
            ENTRADA PARA EDITAR LA SELECCIÓN DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg seleccionarCategoria" name="seleccionarCategoria" required>
                  
                  <option class="optionEditarCategoria"></option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

         <?php

          $crearCategoria = new ControladorSubCategorias();
           $crearCategoria -> ctrEditarSubCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $eliminarCategoria = new ControladorSubCategorias();
  $eliminarCategoria -> ctrEliminarSubCategoria();

?>