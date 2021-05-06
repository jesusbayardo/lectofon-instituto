<?php

if ($_SESSION["perfil"] == "editor") {

  echo '<script>

  window.location = "inicio";

</script>';

  return;
}

?>


<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      GESTOR DE VENTAS
      <small>lectofon</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> INICIO</a></li>

      <li class="active">Gestor de ventas</li>
    </ol>
  </section>



  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <?php

        include "inicio/grafico-ventas.php";

        ?>

      </div>

      <div class="box-body">

        <div class="box-tools">



        </div>

        <br>

        <table class="table table-bordered table-striped dt-responsive tablaVentas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th style="width:10px">ID transación</th>
              <th style="width:10px">Número compra</th>
              <th style="width:10px">Cant. compra</th>
              <th>Detalle producto</th>
              <th>Cliente</th>
              <th>Total Venta</th>
              <th>Proceso de envío</th>
              <th>Reembolso</th>
              <th>Metodo</th>
              <th>Email</th>
              <th>Dirección</th>
              <th>Provincia</th>
              <th>Fecha Compra</th>


            </tr>

          </thead>


        </table>


      </div>

    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->