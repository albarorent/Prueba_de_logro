<div class="pd-30">
  <h4 class="tx-gray-800 mg-b-5"><?php echo $titulo ?></h4>
</div>

<div class="br-pagebody mg-t-5 pd-x-30">
  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <div class="div_caja ">
        <form action="<?php echo base_url(); ?>/venta/listarventa" method="POST" class="form-horizontal">
          <div class="div__box">
            <label for="" class="col-md-1 control-label">Desde:</label>
            <div class="colum-md-3">
              <input type="date" class="form-control" name="fechainicio" value="<?php echo !empty($fechainicio) ? $fechainicio : ''; ?>" max="<?= date('Y-m-d') ?>">
            </div>
            <label for="" class="col-md-1 control-label">Hasta:</label>
            <div class="colum-md-3">
              <input type="date" class="form-control" name="fechafin" value="<?php echo !empty($fechafin) ? $fechafin : ''; ?>">
            </div>
            <div class="colum-md-4">
              <input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
              <a href="<?php echo base_url(); ?>/venta/listarventa" class="btn btn-danger">Restablecer</a>
            </div>
          </div>
        </form>
      </div>

      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 mb-5 d-flex justify-content-between">
        Ventas Registradas
        <a href="<?php echo base_url() ?>/venta"><button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" type="button"> Nuevo Venta</button></a>
      </h6>

      <div class="table-responsive">
        <table id="datatable1" class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center">Opciones</th>
              <th class="text-center">N°</th>
              <th class="text-center">Comprobante</th>
              <th class="text-center">Precio Total</th>
              <th class="text-center">Fecha de Registro</th>
              <th class="text-center">Nombre de la persona</th>
              <th class="text-center">Tipo de Pago</th>

            </tr>
          </thead>
          <tbody>
            <?php $cont = 0;
            foreach ($venta as $row) : $cont++;
            ?>
              <tr>
                <td class="text-center">
                  <a href="<?php echo base_url() ?>/venta/verVenta/<?php echo $row["idVenta"] ?>"><button class="btn btn-primary btn-sm btnEditRol" title="Editar"><i class="icon ion-clipboard"></i></button></a>
                </td>
                </td>
                <td class="text-center"><?php echo $cont; ?></td>
                <td class="text-center"> <?php echo $row["comprobante"]; ?> </td>
                <td class="text-center"> <?php echo $row["Total"]; ?> </td>
                <td class="text-center"> <?php echo $row["fecha_registro"]; ?> </td>
                <td class="text-center"> <?php echo $row["nombres"]; ?> </td>
                <td class="text-center"> <?php echo $row["tipopago"]; ?> </td>


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
<!-- // Obtener los datos de ventas del día desde la base de datos
// Supongamos que tienes una matriz de datos llamada $data en el formato mencionado anteriormente
$ventasDia = [
  ['2023-06-15', 100],
  ['2023-06-15', 150],
  ['2023-06-15', 200]
  // Otros datos de ventas del día
];

$totalVentas = array_sum(array_column($ventasDia, 1)); // Sumar los valores de la columna 'y'


// Generar la respuesta JSON
$response = [
  'ventasDia' => $ventasDia,
  'totalVentas' => $totalVentas
];

<div id="chartContainer"></div> -->

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

  // // Configurar y mostrar el gráfico Highcharts
  // document.addEventListener('DOMContentLoaded', function() {
  //   Highcharts.chart('chartContainer', {
  //     // Configuración del gráfico
  //     series: [{
  //       name: 'Ventas del día',
  //       data: 
  //     }],

  //     title: {
  //       text: 'Ventas del día'
  //     },
  //     subtitle: {
  //       text: 'Total de ventas: ' +
  //     }
  //   });
  // });
</script>