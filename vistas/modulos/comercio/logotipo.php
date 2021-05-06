<?php

$plantilla = ControladorComercio::ctrSeleccionarPlantilla();
?>


<div class="box box-primary">

    <div class="box-header with-border">

        <h3>LOGOTIPO</h3>

        <div class="box-tools pull-right">

            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i>
            </button>

        </div>


    </div>


    <div class="box-body">


        <div class="form-group">
        <label for="">Cambiar logotipo</label>
        <p class="pull-rigth">
        <img src="<?php  echo $plantilla["logo"]?>" alt="">
        
        
        </p>


        </div>
    </div>



    <div class="box-footer">

    </div>
</div>