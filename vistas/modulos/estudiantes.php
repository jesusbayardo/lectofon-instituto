



<div class="content-wrapper">

    <section class="content-header" style="background-color: #E0BC0A;">

        <h1>
            Ingreso estudiantes
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Estudiantes</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-warning" style="color: black;" data-toggle="modal" data-target="#modalAgregarEstudiante">

                    Nuevo Estudiante

                </button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaEstudiantes" width="100%">
                    <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Email</th>
                            <th>Fecha Nacimiento</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL EDITAR ESTUDIANTE
======================================-->

<div id="modalAgregarEstudiante" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#F9D047; color:black">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar estudiante</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">



                        <div class="form-group">
                            <label for="">Cédula</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="number" min="0" class="form-control input-lg " id="cedulaEstudiante" name="cedulaEstudiante" placeholder="Cédula estudiante" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <label for="">Nombres completos</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="nombresEstudiante" placeholder="Nombres estudiante" required>

                            </div>

                        </div>





                        <!-- ENTRADA PARA EL fECHA NACIMIENTO -->

                        <div class="form-group">
                            <label for="">Fecha nacimiento</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="date" class="form-control input-lg" name="fechaEstudiante" id="fechaEstudiante" placeholder="Fecha nacimiento estudiante" required>

                            </div>

                        </div>



                        <!-- ENTRADA PARA EL EMAIL -->

                        <div class="form-group">
                            <label for="">Correo electrónico</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input type="email" class="form-control input-lg" id="emailEstudiante" name="emailEstudiante" placeholder="Email estudiante" required>

                            </div>

                        </div>




                        <!-- ENTRADA PARA EL EMAIL -->

                        <div class="form-group">
                            <label for="">Nueva contraseña</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>

                                <input type="text" class="form-control input-lg" name="passwordEstudiante" placeholder="Contraseña" required>

                            </div>

                        </div>







                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-warning" style="color: black;">Guardar Estudiante</button>

                </div>

            </form>

            <?php

            $crearCliente = new ControladorEstudiantes();
            $crearCliente->ctrCrearEstudiante();

            ?>

        </div>

    </div>

</div>
<!--=====================================
MODAL EDITAR ESTUDIANTE
======================================-->

<div id="modalEditarEstudiante" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#F9D047; color:black">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar estudiante</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">



                        <div class="form-group">
                            <label for="">Cédula</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="number" min="0" class="form-control input-lg" id="editarCedulaEstudiante" name="editarCedulaEstudiante" placeholder="Cédula estudiante" readonly>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <label for="">Nombres completos</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" id="editarNombresEstudiante" name="editarNombresEstudiante" placeholder="Nombres estudiante" required>

                            </div>

                        </div>





                        <!-- ENTRADA PARA EL fECHA NACIMIENTO -->

                        <div class="form-group">
                            <label for="">Fecha nacimiento</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="date" class="form-control input-lg" name="EditarFechaEstudiante" id="EditarFechaEstudiante" placeholder="Fecha nacimiento estudiante" readonly>

                            </div>

                        </div>



                        <!-- ENTRADA PARA EL EMAIL -->

                        <div class="form-group">
                            <label for="">Correo electrónico</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input type="email" class="form-control input-lg" id="editarEmailEstudiante" name="editarEmailEstudiante" placeholder="Email estudiante" readonly>

                            </div>

                        </div>




                        <!-- ENTRADA PARA EL CONTRASEÑA -->

                        <div class="form-group">
                            <label for="">Cambiar contraseña</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>

                                <input type="text" class="form-control input-lg" name="editarpasswordEstudiante" placeholder="Contraseña">

                            </div>

                        </div>

                        <input type="hidden" class="form-control input-lg" id="oldpasswordEstudiante" name="oldpasswordEstudiante" placeholder="Contraseña">






                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-warning" style="color: black;">Guardar Estudiante</button>

                </div>

            </form>

            <?php

            $editarEstudiante = new ControladorEstudiantes();
            $editarEstudiante->ctrEditarEstudiante();

            ?>

        </div>

    </div>

</div>