<div class="pd-30">
    <h4 class="tx-gray-800 mg-b-5"><?php echo $titulo; ?></h4>
</div>

<div class="br-pagebody pd-x-30">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <div class="form-layout form-layout-1">
                <form action="<?php echo base_url() ?>/usuarios/actualizarDatos/<?php echo $usuario["idpersona"] ?>" method="POST" enctype="multipart/form-data">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label"> DNI: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="dni" id="dni" placeholder="Ingrese el DNI" value="<?php echo $usuario["dni"] ?>">
                                <p id="errNom" class="text-center" style="color:red; margin-top: 8px;">
                                    <?php echo (isset($validation)) ? $validation->getError('dni') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Nombres: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre" value="<?php echo $usuario["nombres"] ?>">
                                <p id="errNom" class="text-center" style="color:red; margin-top: 8px;">
                                    <?php echo (isset($validation)) ? $validation->getError('nombre') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Apellidos: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="apellidos" id="apellidos" placeholder="Ingrese los Apellidos" value="<?php echo $usuario["apellidos"] ?>">
                                <p id="errNom" class="text-center" style="color:red; margin-top: 8px;">
                                    <?php echo (isset($validation)) ? $validation->getError('apellidos') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Telefono: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Ingrese el telefono" value="<?php echo $usuario["telefono"] ?>">
                                <p id="errNom" class="text-center" style="color:red; margin-top: 8px;">
                                    <?php echo (isset($validation)) ? $validation->getError('telefono') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Correo: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Ingrese el correo" value="<?php echo $usuario["email_user"] ?>">
                                <p id="errNom" class="text-center" style="color:red; margin-top: 8px;">
                                    <?php echo (isset($validation)) ? $validation->getError('email') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Contraseña: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Ingrese la contraseña" value="<?php echo $usuario["password"] ?>">
                                <p id="errNom" class="text-center" style="color:red; margin-top: 8px;">
                                    <?php echo (isset($validation)) ? $validation->getError('password') : ""; ?>
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Dirección: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Ingrese la dirección" value="<?php echo $usuario["direccion"] ?>">
                                <p id="errNom" class="text-center" style="color:red; margin-top: 8px;">
                                    <?php echo (isset($validation)) ? $validation->getError('direccion') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Genero: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" id="listGenero" name="listGenero">
                                    <option value="1" <?php echo ($usuario["genero"] == 1) ? "selected" : "" ?>>Masculino</option>
                                    <option value="2" <?php echo ($usuario["genero"] == 2) ? "selected" : "" ?>>Femenino</option>
                                </select>
                                <p id="errNom" class="text-center" style="color:red; margin-top: 8px;">
                                    <?php echo (isset($validation)) ? $validation->getError('listGenero') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Rol: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" id="listRol" name="listRol">
                                    <option value="1" <?php echo ($usuario["rol"] == 1) ? "selected" : "" ?>>Administrador</option>
                                    <option value="2" <?php echo ($usuario["rol"] == 2) ? "selected" : "" ?>>Trabajador</option>
                                </select>
                                <p id="errNom" class="text-center" style="color:red; margin-top: 8px;">
                                    <?php echo (isset($validation)) ? $validation->getError('listRol') : ""; ?>
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Estado: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" name="listStatus" id="listStatus">
                                    <option value="1" <?php echo ($usuario["status"] == 1) ? "selected" : "" ?>>Activo</option>
                                    <option value="2" <?php echo ($usuario["status"] == 2) ? "selected" : "" ?>>Inactivo</option>
                                </select>
                                <p id="errNom" class="text-center" style="color:red; margin-top: 8px;">
                                    <?php echo (isset($validation)) ? $validation->getError('listStatus') : ""; ?>
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Imagen: <span class="tx-danger">*</span></label>
                                <span class="file-input btn btn-block btn-primary btn-file">
                                    Seleccionar imagen&hellip;
                                    <input type="file" name="imagen" value="<?php echo $usuario["imagen"] ?>">
                                </span>
                            </div>
                        </div>

                    </div><!-- row -->

                    <div class="form-layout-footer">
                        <input type="submit" value="Guardar" class="btn btn-info" name="btnEnviar">
                        <a href="<?php echo base_url() ?>/usuarios" class="btn btn-secondary">Cancelar</a>
                    </div><!-- form-layout-footer -->
                </form>
            </div><!-- form-layout -->
        </div>
        <!-- br-section-wrapper -->
    </div>
</div>