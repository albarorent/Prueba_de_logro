 
<div class="pd-20">
  <h4 class="tx-gray-800 mg-b-2"><?php echo $titulo ?></h4>
  
</div>

<div class="br-pagebody mg-t-2 pd-x-10">
  <div class="br-pagebody">
    <div class="br-section-wrapper">
    <div class="colum-md-4">
              <a href="<?php echo base_url(); ?>/venta/listarventa" class="btn btn-danger">Volver</a>
            </div>
      <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <section id="sPedido" class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h2 class="page-header"><img src="" ></h2>
            </div>
            <div class="col-6">
              <h5 class="text-right">Fecha: <?= $detalleventa[0]['fecha_registro'] ?></h5>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-4">
              <address><strong>Datos del Cliente</strong><br>
                <b>Nombres: </b> <?= $detalleventa[0]["nombres"] ?> <br>
                <b>Tel:</b>  <?= $detalleventa[0]["telefono"] ?><br>
               
              </address>
            </div>
            <div class="col-4"><b>Orden de venta # </b> <?= $detalleventa[0]["idventa"] ?><br> 
                <b id="Estado">Tipo de Pago:</b> <?= $detalleventa[0]["tipopago"] ?> <br>
                <b id="Monto">Monto:</b> <?= $detalleventa[0]["Total"] ?>
            </div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th class="text-right">Precio</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-right">Importe</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                      $subtotal = 0;
                      if(count($detalleventa)){
                        foreach($detalleventa as $det){
                          $subtotal += $det["precio"] * $det['cantidad'];

                     ?>
                  <tr>
                    <td id="producto"><?php echo $det["nombre"] ?></td>
                    <td class="text-right" id="precio"><?php echo $det["precio"] ?></td>
                    <td class="text-center" id="cantidad"><?php echo $det["cantidad"] ?></td>
                    <td class="text-right" id="importe"><?php echo $det["precio"] * $det["cantidad"]; ?></td>
                  </tr>
                  <?php 
                        }
                         
                          }
 
                   ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right" id="">Sub-Total:</th>
                        <td class="text-right" id="subtotal"><?php echo $subtotal ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Total:</th>
                        <td class="text-right" id="total"><?= $detalleventa[0]['Total'] ?></td>
                    </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sPedido');" ><i class="fa fa-print"></i> Imprimir</a></div>
          </div>
        </section>
        <?php ?>
      </div>
    </div>
  </div>
      <!-- table-wrapper -->
    </div>
    <!-- br-section-wrapper -->
  </div>
</div>
