<div class="pd-30">
  <h4 class="tx-gray-800 mg-b-5"><?php echo $titulo ?></h4>
</div>

<div class="br-pagebody mg-t-5 pd-x-30">
  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 mb-5 d-flex justify-content-between">
        Productos Registrados
        <?php if ($_SESSION["rol"] == 1) : ?>
          <a href="<?php echo base_url() ?>/producto/registrar"><button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" type="button"> Nuevo Producto</button></a>
        <?php endif; ?>
      </h6>
      <a href="<?php echo base_url('/producto/muestraClientePdf') ?>" target="_blank"><button class="btn btn-info mb-4" type="button"><i class="ion-archive"></i> Generar PDF</button></a>
      <div class="table-responsive">
        <table id="datatable1" class="table table-hover table-bordered">
          <thead>
            <tr>
              <?php if ($_SESSION["rol"] == 1) : ?>
                <th class="text-center">Opciones</th>
              <?php endif; ?>
              <th class="text-center">N°</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Codigo</th>
              <th class="text-center">Precio</th>
              <th class="text-center">Stock</th>
              <th class="text-center">Imagen</th>
              <th class="text-center">Categoria</th>
              <th class="text-center">Estado</th>

            </tr>
          </thead>
          <tbody>
            <?php $cont = 0;
            foreach ($producto as $row) : $cont++; ?>
              <tr>
                <?php if ($_SESSION["rol"] == 1) : ?>
                  <td class="text-center">
                    <a href="<?php echo base_url() ?>/Producto/VerRegistro/<?php echo $row["idproducto"]; ?>"><button class="btn btn-primary btn-sm ml-1" title="Editar"><i class="icon ion-edit"></i></button></a>
                    <a href="<?php echo base_url() ?>/Producto/eliminarRegistro/<?php echo $row["idproducto"]; ?>"><button class="btn btn-danger btn-sm btnDelRol ml-1" title="Eliminar"><i class="icon ion-close"></i></button></a>
                  </td>
                <?php endif; ?>
                <td class="text-center"><?php echo $cont; ?></td>
                <td class="text-center"> <?php echo $row["nombre"]; ?> </td>
                <td class="text-center"> <?php echo $row["codigo"]; ?> </td>
                <td class="text-center"> <?php echo $row["precio"]; ?> </td>
                <td class="text-center"> <?php echo $row["stock"]; ?> </td>
                <td class="text-center"> <img src="<?php echo base_url() ?>/public/productos/<?php echo $row["imagen"]; ?>" width="50px"> </td>
                <td class="text-center"> <?php echo $row["nombreCategoria"]; ?> </td>
                <td class="text-center"> <?php
                                          if ($row["status"] == 1) {
                                            echo '<span class="badge badge-success">Activo</span>';
                                          } else if ($row["status"] == 2) {
                                            echo '<span class="badge badge-danger">Inactivo</span>';
                                          }
                                          ?> </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- table-wrapper -->
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