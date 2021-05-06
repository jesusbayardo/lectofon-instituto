<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      GESTOR DE SLIDE
      <small>lectofon</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> INICIO</a></li>

      <li class="active">Gestor de slide</li>
    </ol>
  </section>



  <section class="content">
    <div class="box">

      <div class="box-header with-border">


      </div>
      <div class="box-body">




        <?php

        $slide = ControladorSlide::ctrMostrarSlide();

        foreach ($slide as $key => $value) {


          $estiloImgProducto = json_decode($value["estiloImgProducto"], true);
          $estiloTextoSlide = json_decode($value["estiloTextoSlide"], true);
          $titulo1 = json_decode($value["titulo1"], true);
          $titulo2 = json_decode($value["titulo2"], true);
          $titulo3 = json_decode($value["titulo3"], true);

          echo '
          <div class="box-group" id=""accordion>
              <div class="panel box box-info">

                   <div class="box-header with-border"> 
          
                  <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $value["id"] . '">';

          echo '<p class="text-uppercase"> Slide ' . $value["id"] . ' </p>';


          echo ' </a>
                    </h4>
                        <div class="btn-group pull-right">
                           <button class="btn btn-primary guardarSlide" 
                           nombreSlide="' . $value["nombre"] . '" 
                           id="' . $value["id"] . '"  
                           imgFondo="' . $value["imgFondo"] . '" 
                           indice="' . $key . '" 
                           rutaImgFondo="' . $value["imgFondo"] . '"
                           > 
                             <i class="fa fa-floppy-o">  </i>
                            GUARDAR
                         </button>

                         </div>
                   </div>

                       <div id="collapse' . $value["id"] . '" class="panel-collapse collapse collapseSlide">
                          <div class="row">
                             <div class="col-md-4 col-xs-12">
                                <div class="box-body">

            
                                  <!--=====================================
                                  MODIFICAR EL FONDO DEL SLIDE
                                  ======================================--> 
            
                                  <div class="form-group">
                                
                                    <label>Cambiar Imagen Fondo:</label>
            
                                    <br>
            
                                    <p class="help-block">
                                    <img src="' . $value["imgFondo"] . '" class="img-thumbnail previsualizarFondo" width="200px">
                                    </p>
            
                                    <input type="file" class="subirFondo" indice="' . $key . '">
            
                                    <p class="help-block">Tamaño recomendado 1600px * 520px</p>
            
                                  </div>
            
                                  <!--=====================================
                                  MODIFICAR EL FONDO DEL SLIDE
                                  ======================================--> 




                                </div>

                             </div>
                          </div>

          
                         <div class="slide">
				
                          <img  class="cambiarFondo"  src="' . $value["imgFondo"] . '" >

							                  <div class="slideOpciones ' . $value["tipoSlide"] . '">';


          echo '<div class="textosSlide" style="top:' . $estiloTextoSlide["top"] . '%; left:' . $estiloTextoSlide["left"] . '%; width:' . $estiloTextoSlide["width"] . '%; right:' . $estiloTextoSlide["right"] . '%">
									
								                    

								                  

								                   
							                      	</div>	

						                  	</div>  
                             </div>
                           </div>
              </div>
            </div>';
        }






        ?>




      </div>

    </div>

  </section>

</div>
<!-- /.content-wrapper -->