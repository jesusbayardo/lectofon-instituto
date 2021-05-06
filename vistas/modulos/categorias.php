<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      GESTOR DE CATEGORÍAS
      <small>Lectofon</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> INICIO</a></li>

      <li class="active">Gestor de categorías</li>
    </ol>
  </section>



  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">


      <!-- /.box-head -->
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          Agregar Categoría</button>

      </div>
      <!-- /.box-head -->

      <!-- /.box-body -->
      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaCategorias" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Categoría</th>
              <th>ruta</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>

          </thead>
         
        </table>
      </div>
      <!-- /.box-body -->



      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->





<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    
    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        
        <div class="modal-header" style="background:#3c8dbc; color:white">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
          <div class="box-body">

            <!--=====================================
            ENTRADA DEL TITULO DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
            <label for="">Nombre categoría</label>
              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                  <input type="text" class="form-control input-lg validarCategoria tituloCategoria" placeholder="Ingresar Categoria" name="tituloCategoria" required> 

              </div> 

            </div>

            <!--=====================================
            ENTRADA PARA LA RUTA DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
            <label for="">URL categoría</label>
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-link"></i></span>

                <input type="text" class="form-control input-lg rutaCategoria" placeholder="Ruta url para la categoría" name="rutaCategoria" readonly required> 

              </div> 

            </div>

           
            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar categoría</button>

        </div>

      </form>

      <?php

        
         $crearCategoria = new ControladorCategorias();
         $crearCategoria -> ctrCrearCategoria();

      ?>

    </div>

  </div>

</div>





<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    
    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        
        <div class="modal-header" style="background:#3c8dbc; color:white">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Editar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
          <div class="box-body">

            <!--=====================================
            ENTRADA DEL TITULO DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
            <label for="">Categoría</label>
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg validarCategoria tituloCategoria" placeholder="Ingresar Categoria" name="editarTituloCategoria" required> 

                <input type="hidden" class="editarIdCategoria" name="editarIdCategoria">
               
              </div> 

            </div>

            <!--=====================================
            ENTRADA PARA LA RUTA DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
            <label for="">Url Categoría</label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-link"></i></span>

                <input type="text" class="form-control input-lg rutaCategoria" placeholder="Ruta url para la categoría" name="rutaCategoria" readonly required> 

              </div> 

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar categoría</button>

        </div>

      </form>

      <?php

        
          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();

      ?>

    </div>

  </div>

</div>

 <?php

        
    $eliminarCategoria = new ControladorCategorias();
    $eliminarCategoria -> ctrEliminarCategoria();

  ?>







