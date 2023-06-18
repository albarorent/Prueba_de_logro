<div class="pd-30">
    <h4 class="tx-gray-800 mg-b-5">Actualizar Categoria</h4>
</div>

<div class="br-pagebody pd-x-30">
    <div class="br-pagebody">
    <?php error_reporting(0); ?>
        <div class="br-section-wrapper ">
            <div class="form-layout form-layout-1">
                <form action="<?php echo base_url() ?>/categoria/actualizarDatos/<?php echo $categoria["idcategoria"] ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_" value="<?= $categoria["idcategoria"]?>" >

                    <div class="row mg-b-25">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" value="<?= $categoria["nombre"] ?>">
                                <p id="errNom" style="color:red">
                                    <?php echo (isset($validation)) ? $validation->getError('nombre') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label">Descripcion: <span class="tx-danger">*</span></label>
                                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Ingrese la descripción del producto"><?php echo $categoria["descripcion"] ?></textarea>
                                <p id="errNom" style="color:red">
                                    <?php echo (isset($validation)) ? $validation->getError('txtDescripcion') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->

                    </div><!-- row -->

                    <div class="form-layout-footer">
                        <input type="submit" value="Registrar" class="btn btn-primary" name="btnEnviar">
                        <a href="<?php echo base_url() ?>/categoria" class="btn btn-secondary">Cancelar</a>
                    </div><!-- form-layout-footer -->
                </form>


            </div><!-- form-layout -->
        </div>
        <!-- br-section-wrapper -->
    </div>
</div>
