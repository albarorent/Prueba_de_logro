<div class="pd-30">
    <h4 class="tx-gray-800 mg-b-5">Actualizar Nuevo Producto</h4>
</div>

<div class="br-pagebody pd-x-30">
    <div class="br-pagebody">
    <?php error_reporting(0); ?>
        <div class="br-section-wrapper">
            <div class="form-layout form-layout-1">
                <form action="<?php echo base_url() ?>/producto/actualizarDatos/<?= $producto["idproducto"] ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_" value="<?= $producto["idproducto"]?>" >    
                <input type="hidden" name="txtImg" value="<?= $producto["imagen"]?>" >

                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Codigo: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" id="codigo" name="codigo" placeholder="Ingrese el codigo" value="<?= $producto["codigo"] ?>">
                                <p id="errNom" style="color:red">
                                    <?php echo (isset($validation)) ? $validation->getError('codigo') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" value="<?= $producto["nombre"] ?>">
                                <p id="errNom" style="color:red">
                                    <?php echo (isset($validation)) ? $validation->getError('nombre') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Descripción: <span class="tx-danger">*</span></label>
                                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Ingrese la descripción del producto" value="<?= $producto["descripcion"] ?>"><?php echo $producto["descripcion"] ?></textarea>
                                <p id="errNom" style="color:red">
                                    <?php echo (isset($validation)) ? $validation->getError('txtDescripcion') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span class="form-control-label">Precio: <span class="tx-danger">*</span></span>
                                <input class="form-control" type="number" id="precio" name="precio" placeholder="Ingrese el precio" value="<?= $producto["precio"]?>">
                                <p id="errNom" style="color:red">
                                    <?php echo (isset($validation)) ? $validation->getError('precio') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-8 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Stock: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" id="stock" name="stock" placeholder="Ingrese el stock" value="<?= $producto["stock"]?>">
                                <p id="errNom" style="color:red">
                                    <?php echo (isset($validation)) ? $validation->getError('stock') : ""; ?>
                                </p>
                            </div>
                        </div><!-- col-8 -->
                        
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Imagen: <span class="tx-danger">*</span></label>
                                <span class="file-input btn btn-block btn-primary btn-file">
                                    Seleccionar imagen &hellip;
                                    <input type="file" name="imagen">
                                    
                                </span>
                                <p id="errCategoria" style="color:red">
                                            <?php echo (isset($validation))?$validation->getError('txtImagen'):"";?>
                                        </p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Categoria: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" id="listCategoria" name="listCategoria">
                                    <option label="Seleccione la categoría"></option>
                                    <?php foreach ($categoria as $cat) : ?>
                                        <option value="<?php echo $cat["idcategoria"] ?>" <?php echo ($producto["categoriaid"] == $cat["idcategoria"]) ? "selected" : "" ?>>
                                            <?php echo $cat["nombre"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p id="errNom" style="color:red">
                                <?php echo (isset($validation)) ? $validation->getError('listCategoria') : ""; ?>
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Estado: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" name="listStatus" id="listStatus">
                                    <option label="Seleccione el estado"></option>
                                    <option value="1" <?php echo ($producto["status"] == 1) ? "selected" : "" ?> >Activo</option>
                                    <option value="2" <?php echo ($producto["status"] == 2) ? "selected" : "" ?> >Inactivo</option>
                                    
                                </select>
                                <p id="errNom" style="color:red">
                                            <?php echo (isset($validation)) ? $validation->getError('listStatus') : ""; ?>
                                </p>
                            </div>
                        </div>

                    </div><!-- row -->

                    <div class="form-layout-footer">
                        <input type="submit" value="Registrar" class="btn btn-primary" name="btnEnviar">
                        <a href="<?php echo base_url() ?>/producto" class="btn btn-secondary">Cancelar</a>
                    </div><!-- form-layout-footer -->
                </form>


            </div><!-- form-layout -->
        </div>
        <!-- br-section-wrapper -->
    </div>
</div>
