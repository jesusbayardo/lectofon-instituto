<div class="container-fluid barraSuperior " id="top" style="background-color: rgb(255, 151, 3);">

    <div class="container">
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
                           
                               

                                    echo '<li>
                                <img class="img-circle" src="' . $servidorBackEnd . 'vistas/img/usuarios/default/anonymous.png" width="12%">
                                </li>
                                ';
                                

                                echo '
                            <li> <a href="' . $servidorFrontEnd . 'perfil" > Ver perfil </a> </li>
                          
                            <li> <a href="' . $servidorFrontEnd . 'salir" >Salir </a> </li>
                            ';
                            
                        }
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



    <nav>
        <ul>
            <?php echo ' <li><a href="' . $servidorEstudiantes . '"><span class="icon-house"></span>INICIO</a></li>
       
     <!--   <li class="submenu">
            <a href="#"><span class="icon-rocket"></span>Proyectos<span class="caret icon-arrow-down6"></span></a>
            <ul class="children">
                <li><a href="#">SubElemento #1 <span class="icon-dot"></span></a></li>
                <li><a href="#">SubElemento #2 <span class="icon-dot"></span></a></li>
                <li><a href="#">SubElemento #3 <span class="icon-dot"></span></a></li>
            </ul>
        </li>-->
        <li><a href="#"><span class="icon-earth"></span>¿QUÉ ES INSTITUTO LECTOFON?</a></li>
        <li><a href="' . $servidorFrontEnd . '"><span class="icon-mail"></span>TIENDA ONLINE</a></li>'; ?>
        </ul>
    </nav>

</div>

<div class="container">
    <div style="width: 100%;text-align: center;">
        <h2>INICIO DE SESIÓN</h2>
       
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="border-style: groove; padding:10px">
            <div class="form-body">
                <ul class="nav nav-tabs final-login">
                    <li class="active"><a data-toggle="tab" href="#modalAccesoEstudiante">ESTUDIANTE</a></li>
                    <li><a data-toggle="tab" href="#modalAccesoRepresentante">REPRESENTANTE</a></li>
                </ul>
                <div class="tab-content">
                    <div id="modalAccesoEstudiante" class="tab-pane fade in active">
                        <div class="innter-form">

                            <form class="innate-form" method="post">
                                <div class="form-group">
                                    <label>Correo electrónico</label>
                                    <input type="email" class="form-control " name="ingEmailEstudiante" ig="ingEmailEstudiante" placeholder="CORREO ELECTRÓNICO" require>

                                </div>

                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" name="ingPasswordEstudiante" id="ingPasswordEstudiante" autocomplete="on" class="form-control" placeholder="CONTRASEÑA" require>

                                </div>


                                <?php

                                  $ingreso = new ControladorEstudiantes();
                             $ingreso->ctrIngresoEstudiante();


                                ?>
                                <input type="submit" class="btn btn-primary btn-block btnIngreso" value="ACCEDER">
                                <a href="#modalPassword" data-dismiss="modal" data-toggle="modal">Olvidaste tu contraseña?</a>
                            </form>
                        </div>

                        <div class="clearfix"></div>
                    </div>






                    <div id="modalAccesoRepresentante" class="tab-pane fade">
                        <div class="innter-form">


                            <form class="innate-form" method="post">
                                <div class="form-group">
                                    <label>Correo electrónico</label>
                                    <input type="email" class="form-control " name="ingEmailRepresentante" ig="ingEmailRepresentante" placeholder="CORREO ELECTRÓNICO" require>

                                </div>

                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" name="ingPasswordRepresentante" id="ingPasswordRepresentante" autocomplete="on" class="form-control" placeholder="CONTRASEÑA" require>

                                </div>


                                <?php

                                $ingreso = new ControladorUsuario();
                                $ingreso->ctrIngresoRepresentante();
                                ?>
                                <input type="submit" class="btn btn-primary backColo btn-block btnIngreso" value="ACCEDER">
                                <a href="#modalPassword" data-dismiss="modal" data-toggle="modal">Olvidaste tu contraseña?</a>
                            </form>
                        </div>

                        <div class="clearfix"></div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>