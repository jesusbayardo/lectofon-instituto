


<div class="container-fluid barraSuperior " id="top" style="background-color: rgb(255, 151, 3);">
    
    <div class="container" >
        <div class="row">
            <!-- SOCIAL-->
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
                <ul>
                    <?php
                   
                    $servidorEstudiantes = Ruta::RutaFrondBackEstudiantes();
                    $servidorFrontEnd = Ruta::ctrRutaFront();

                    $servidorBackEnd = Ruta::ctrRutaBack();
                    $social = ControladorPlantilla::ctrEstiloPlantilla();
                    $jsonRedesSociales = json_decode($social["redesSociales"], true);
                    foreach ($jsonRedesSociales as $key => $value) {
                        echo '
                        <li>
                        <a href="'  . $value["url"] . '" target="_back">
                            <i class="fa ' . $value["red"] . ' redSocial ' . $value["estilo"] . '" aria-hidden="true"></i>
                        </a>
                    </li>
                        ';
                    }
                    ?>
                </ul>
            </div>


            <!-- END SOCIAL-->
            <!-- REGISTRO-->
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">
                <ul>
                    <?php
                    
                    if (isset($_SESSION["validarSesion"])) {
                        if ($_SESSION["validarSesion"] == "ok") {
                            if ($_SESSION["modo"] == "directo") {
                                if ($_SESSION["foto"] != null) {
                                    echo '<li>
                                <img class="img-circle" src="' . $servidorfront . $_SESSION["foto"] . '" width="12%">
                                </li>
                                ';
                                } else {

                                    echo '<li>
                                <img class="img-circle" src="' . $servidorfront . 'vistas/img/usuarios/default/anonymous.png" width="12%">
                                </li>
                                ';
                                }

                                echo '
                            <li> <a href="' . $servidorfront . 'perfil" > Ver perfil </a> </li>
                          
                            <li> <a href="' . $servidorfront . 'salir" >Salir </a> </li>
                            ';
                            }
                        }
                    } else {

                        echo ' <li>
                              <a href="' . $servidorEstudiantes . 'login" data-togge="modal"><button class="btn btn-primary">iniciar sesión
                              </button></a>
                               
                              
                              
                              </li>';
                    }
                    ?>
                </ul>
            </div>
            <!-- END REGISTRO-->
        </div>
    </div>
</div>






<div>
    <div class="row" id="cabezote">
        <!--  logotipo-->
        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
            <a href="<?php echo  $servidorEstudiantes ?>">
                <img src="<?php echo  $servidorBackEnd . $social["logo"] ?>" class="img-responsive">

            </a>
        </div>
    </div>
</div>



<div class="menu_bar">
    <a href="#" class="bt-menu"><span class="icon-list2"></span>Menú</a>
</div>

<div id="principalmenu">



<nav >
    <ul>
     <?php  echo ' <li><a href="'.$servidorEstudiantes.'"><span class="icon-house"></span>INICIO</a></li>
       
     <!--   <li class="submenu">
            <a href="#"><span class="icon-rocket"></span>Proyectos<span class="caret icon-arrow-down6"></span></a>
            <ul class="children">
                <li><a href="#">SubElemento #1 <span class="icon-dot"></span></a></li>
                <li><a href="#">SubElemento #2 <span class="icon-dot"></span></a></li>
                <li><a href="#">SubElemento #3 <span class="icon-dot"></span></a></li>
            </ul>
        </li>-->
        <li><a href="#"><span class="icon-earth"></span>¿QUÉ ES INSTITUTO LECTOFON?</a></li>
        <li><a href="'.$servidorFrontEnd.'"><span class="icon-mail"></span>TIENDA ONLINE</a></li>' ;?>
    </ul>
</nav>

</div>



<!--=====================================
SLIDESHOW  
======================================-->

<div class="container-fluid" id="slide">
    <div class="row">
        <!--=====================================
		DIAPOSITIVAS
		======================================-->

        <ul>
            <?php
            $servidor = Ruta::ctrRutaBack();
            $slide = ControladorSlide::ctrMostrarSlide();
            foreach ($slide as $key => $value) {
                $estiloImgProducto = json_decode($value["estiloImgProducto"], true);
                $estiloTextoSlide = json_decode($value["estiloTextoSlide"], true);
                $titulo1 = json_decode($value["titulo1"], true);
                $titulo2 = json_decode($value["titulo2"], true);
                $titulo3 = json_decode($value["titulo3"], true);
                echo '<li>
							 <img class="imgProducto" src="' . $servidor . $value["imgFondo"] . '" >
							<div class="slideOpciones ' . $value["tipoSlide"] . '">';
                if ($value["imgProducto"] != "") {
                }
                echo '<div class="textosSlide" style="top:' . $estiloTextoSlide["top"] . '%; left:' . $estiloTextoSlide["left"] . '%; width:' . $estiloTextoSlide["width"] . '%; right:' . $estiloTextoSlide["right"] . '%">
								<!--	<a href="' . $value["url"] . '"    class="btn btn-info backColo">
										
									VER PRODUCTOS

                                    </a>-->
                                    
								</div>	

							</div>

						</li>';
            }

            ?>

        </ul>



        <?php

        for ($i = 1; $i <= count($slide); $i++) {

            echo '<li item="' . $i . '"><span class="fa fa-circle"></span></li>';
        }

        ?>



        <div class="flechas" id="retroceder"><span class="fa fa-chevron-left"></span></div>
        <div class="flechas" id="avanzar"><span class="fa fa-chevron-right"></span></div>
    </div>
</div>