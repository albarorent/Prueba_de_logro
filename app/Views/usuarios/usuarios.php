<div class="pd-30">
    <h4 class="tx-gray-800 mg-b-5"><?php

                                    use CodeIgniter\HTTP\Response;

                                    echo $titulo; ?></h4>
</div>

<div class="br-pagebody pd-x-30">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 mb-5 d-flex justify-content-between">
                Usuarios Registrados
                <a href="<?php echo base_url() ?>/usuarios/registrar"><button class="btn btn-primary" type="button"><i class="icon ion-plus"></i> Nuevo Usuario</button></a>
            </h6>
            <a href="<?php echo base_url('/usuarios/muestraClientePdf') ?>" target="_blank"><button class="btn btn-info mb-4" type="button"><i class="ion-archive"></i> Generar PDF</button></a>
            <div class="form-layout form-layout-1">
                <div class="row mg-b-25">
                    <div class="m-auto table-responsive overflow-x-scroll p-3">
                        <table id="datatable1" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center wd-5p">Opciones</th>
                                    <th class="text-center wd-3p">N°</th>
                                    <th class="text-center wd-3p">DNI</th>
                                    <th class="text-center wd-15p">Nombres</th>
                                    <th class="text-center wd-35p">Apellidos</th>
                                    <th class="text-center wd-10p">Imagen</th>
                                    <th class="text-center wd-10p">Telefono</th>
                                    <th class="text-center wd-5p">Email</th>
                                    <th class="text-center wd-5p">Dirección</th>
                                    <th class="text-center wd-5p">Género</th>
                                    <th class="text-center wd-25p">Rol</th>
                                    <th class="text-center wd-10p">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 0;
                                foreach ($usuario as $row) : ?>
                                    <?php if ($row['rol'] != 3) : $cont++; ?>
                                        <tr>
                                            <td class="d-flex">
                                                <a href="<?php echo base_url() ?>/usuarios/verRegistro/<?php echo $row["idpersona"]; ?>" class="btn btn-primary btn-sm btnEditRol"><i class="icon ion-edit"></i></a>
                                                <a href="<?php echo base_url() ?>/usuarios/eliminarRegistro/<?php echo $row["idpersona"]; ?>" class="btn btn-danger btn-sm btnDelRol ml-1"><i class="icon ion-close"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $cont ?></php>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row["dni"]; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row["nombres"]; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row["apellidos"]; ?>
                                            </td>
                                            <td class="text-center">
                                                <img src="<?php echo base_url() ?>/public/usuarios/<?php echo $row["imagen"]; ?>" width="50px">
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row["telefono"]; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row["email_user"]; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row["direccion"]; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($row["genero"] == 1) {
                                                    echo 'Masculino';
                                                } else if ($row["genero"] == 2) {
                                                    echo 'Femenino';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($row["rol"] == 1) {
                                                    echo 'Administrador';
                                                } else if ($row["rol"] == 2) {
                                                    echo 'Trabajador';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($row["status"] == 1) {
                                                    echo '<span class="badge badge-success">Activo</span>';
                                                } else if ($row["status"] == 2) {
                                                    echo '<span class="badge badge-danger">Inactivo</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- table-wrapper -->
                </div><!-- row -->
            </div><!-- form-layout -->
        </div>
        <!-- br-section-wrapper -->
    </div>
</div>

<script>
    let mensaje = "<?php echo session()->get("mensaje") ?>"
    let texto = "<?php echo session()->get("texto") ?>"

    if (mensaje == "1") {
        Swal.fire({
            icon: 'success',
            title: 'Confirmación',
            text: texto,
        });
    } else if (mensaje == "0") {
        Swal.fire({
            icon: 'error',
            title: 'Alerta',
            text: texto,
        });
    }

    $('#datatable1').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });
</script>