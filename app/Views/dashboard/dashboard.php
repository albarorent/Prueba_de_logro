<div class="pd-30">
  <h4 class="tx-gray-800 mg-b-5">Dashboard</h4>
</div>
<!-- d-flex -->

<div class="br-pagebody mg-t-5 pd-x-30">
  <div class="row row-sm">
    <div class="col-sm-6 col-xl-3">
      <div class="bg-teal rounded overflow-hidden">
        <div class="pd-25 d-flex align-items-center">
          <i class="ion ion-android-contact tx-60 lh-0 tx-white op-7"></i>
          <div class="mg-l-20">
            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">
              Usuarios Registrados
            </p>
            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">
              <?php echo $cant_usuarios; ?>
            </p>
            <span class="tx-11 tx-roboto tx-white-6"></span>
          </div>
        </div>
      </div>
    </div>
    <!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
      <div class="bg-danger rounded overflow-hidden">
        <div class="pd-25 d-flex align-items-center">
          <i class="ion ion-android-contact tx-60 lh-0 tx-white op-7"></i>
          <div class="mg-l-20">
            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">
              Clientes Registrados
            </p>
            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">
              <?php echo  $cant_clientes; ?>
            </p>
            <span class="tx-11 tx-roboto tx-white-6"></span>
          </div>
        </div>
      </div>
    </div>
    <!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
      <div class="bg-primary rounded overflow-hidden">
        <div class="pd-25 d-flex align-items-center">
          <i class="fa-brands fa-product-hunt tx-60 lh-0 tx-white op-7"></i>
          <div class="mg-l-20">
            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">
              Productos Registrados
            </p>
            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">
              <?php echo $cant_producto; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
      <div class="bg-br-primary rounded overflow-hidden">
        <div class="pd-25 d-flex align-items-center">
          <i class="fa-solid fa-scale-unbalanced tx-60 lh-0 tx-white op-7"></i>
          <div class="mg-l-20">
            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">
              Ventas Realizadas
            </p>
            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">
              <?php echo $cant_ventas; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- col-3 -->
  </div>
  <!-- row -->

  <div class="card bd-0 shadow-base pd-30 mg-t-20">
    <div class="d-flex align-items-center justify-content-between mg-b-30">
      <div>
        <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">
        </h6>
        <p class="mg-b-0">
          <i class="icon ion-calendar mg-r-5"></i>
          <span style="font-weight: bold;">Fecha Actual: </span>
          <?php echo date('d/m/y'); ?>
        </p>
        <p class="mg-b-0">
          <i class="fa-solid fa-clock mg-r-5"></i>
          <span style="font-weight: bold;">Hora Actual: </span>
          <?php echo date('H:m:s'); ?>
        </p>
      </div>
    </div>
    <!-- d-flex -->

    <table class="table table-valign-middle mg-b-0 table-responsive overflow-x-scroll">
      <tbody>
        <?php foreach ($usuario as $row) : ?>
          <?php if ($row['rol'] != 3) : ?>
            <tr>
              <td class="pd-l-0-force">
                <img src="<?php echo base_url() ?>/public/usuarios/<?php echo $row["imagen"]; ?>" class="wd-40 rounded-circle" width="50px">
              </td>
              <td>
                <h6 class="tx-inverse tx-14 mg-b-0"><?php echo $row["nombres"] . " " . $row["apellidos"]; ?></h6>
                <span class="tx-12"><?php echo $row["email_user"]; ?></span>
              </td>
              <td><?php echo $row["telefono"] ?></td>
              <td><span id="sparkline1"><?php echo $row["direccion"] ?></span></td>
              <td class="pd-r-0-force tx-center">
                <span class="tx-gray-600">
                  <?php
                  if ($row["genero"] == 1) {
                    echo 'Masculino';
                  } else if ($row["genero"] == 2) {
                    echo 'Femenino';
                  }
                  ?>
                </span>
              </td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- card -->
  <div class="card bd-0 shadow-base pd-30 mg-t-20">

    <div class="row">
      <!-- <div class="col-md-6">
        <div class="tile">
          <div class="container-title">
            <h3 class="tile-title">Tipo de pagos por mes</h3>
            <div class="dflex">
              <input class="day-picker pagoMes" value="<?php echo date('d - m - Y') ?>" name="pagoMes" placeholder="Mes y Año">
              <button type="button" class="btnTipoVentaMes btn btn-info btn-sm" onclick="fntSearchPagos()"> <i class="fas fa-search"></i> </button>
            </div>
          </div>
          <div id="pagosMesAnio"></div>
        </div>
      </div> -->
      <div class="col-md-12">
        <div class="tile">
          <div class="container-title">
            <h3 class="tile-title">Ventas por mes</h3>
            <div class="dflex">
              <input class="date-picker ventasMes" value="<?php echo date('m-Y') ?>" name="ventasMes" placeholder="Mes y Año">
              <button type="button" class="btnVentasMes btn btn-info btn-sm" onclick="fntSearchVMes()"> <i class="fas fa-search"></i> </button>
            </div>
          </div>
          <div id="graficaMes"></div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="tile">
          <div class="container-title">
            <h3 class="tile-title">Ventas por año</h3>
            <div class="dflex">
              <input class="ventasAnio" value="<?php echo date('Y') ?>" name="ventasAnio" placeholder="Año" minlength="4" maxlength="4" onkeypress="return controlTag(event);">
              <button type="button" class="btnVentasAnio btn btn-info btn-sm" onclick="fntSearchVAnio()"> <i class="fas fa-search"></i> </button>
            </div>
          </div>
          <div id="graficaAnio"></div>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- row -->
</div>
<!-- br-pagebody -->

<script>
  $('.date-picker').datepicker( {
    closeText: 'Cerrar',
  prevText: '<Ant',
  nextText: 'Sig>',
  currentText: 'Hoy',
  monthNames: ['1 -', '2 -', '3 -', '4 -', '5 -', '6 -', '7 -', '8 -', '9 -', '10 -', '11 -', '12 -'],
   monthNamesShort: ['Enero','Febrero','Marzo','Abril', 'Mayo','Junio','Julio','Agosto','Septiembre', 'Octubre','Noviembre','Diciembre'],
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'MM yy',
    showDays: false,
    onClose: function(dateText, inst) {
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth));
    }
});
$('.day-picker').datepicker( {
    closeText: 'Cerrar',
  prevText: '<Ant',
  nextText: 'Sig>',
  currentText: 'Hoy',
  monthNames: ['- 1 -', '- 2 -', '- 3 -', '- 4 -', '- 5 -', '- 6 -', '- 7 -', '- 8 -', '- 9 -', '- 10 -', '- 11 -', '- 12 -'],
   monthNamesShort: ['Enero','Febrero','Marzo','Abril', 'Mayo','Junio','Julio','Agosto','Septiembre', 'Octubre','Noviembre','Diciembre'],
    changeDay: true,
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'dd MM yy',
    showDays: true,
    onClose: function(dateText, inst) {
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth,inst.selectedDay));
    }
});
function fntSearchPagos(){
    let fecha = document.querySelector(".pagoMes").value;
    console.log(fecha);
    if(fecha == ""){
        swal.fire("", "Seleccione mes y año" , "error");
        return false;
    }else{
        let request = (window.XMLHttpRequest) ? 
            new XMLHttpRequest() : 
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = '<?php echo base_url() ?>/inicio/ventasDiarias';
        // divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('fecha_registro',fecha);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState != 4) return;
            if(request.status == 200){
                // grafico_de_pagos(request.responseText);
                // divLoading.style.display = "none";
                return false;
            }
        }
    }
}
function fntSearchVMes(){
    let fecha = document.querySelector(".ventasMes").value;
    if(fecha == ""){
        swal.fire("", "Seleccione mes y año" , "error");
        return false;
    }else{
        let request = (window.XMLHttpRequest) ? 
            new XMLHttpRequest() : 
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = '<?php echo base_url() ?>/inicio/ventasMes';
        // divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('fecha_registro',fecha);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState != 4) return;
            if(request.status == 200){
                grafico_de_mes(request.responseText);
                // divLoading.style.display = "none";
                return false;
            }
        }
    }
}

function fntSearchVAnio(){
    let anio = document.querySelector(".ventasAnio").value;
    if(anio == ""){
        swal("", "Ingrese año " , "error");
        return false;
    }else{
        let request = (window.XMLHttpRequest) ? 
            new XMLHttpRequest() : 
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl ='<?php echo base_url() ?>/inicio/ventasAnio';
        // divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('anio',anio);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState != 4) return;
            if(request.status == 200){
               grafico_de_anio(request.responseText);
                // divLoading.style.display = "none";
                return false;
            }
        }
    }
}

function grafico_de_pagos(valores) {
  var obj = JSON.parse( valores);
 Highcharts.chart('pagosMesAnio', {
  chart: {
          type: 'line'
      },
      title: {
          text: 'Ventas del dia'
      },
      subtitle: {
          text: 'Total Ventas '+obj['montoTotal']
      },
      xAxis: {
          categories: 'datetime'
      },
      yAxis: {
          title: {
              text: ''
          }
      },
      plotOptions: {
          line: {
              dataLabels: {
                  enabled: true
              },
              enableMouseTracking: false
          }
      },
      series: [{
          name: 'Ventas',
          data: obj['total']
      }]
  });
}
function grafico_de_mes(valores) {
  var obj = JSON.parse(valores);
  Highcharts.chart('graficaMes', {
      chart: {
          type: 'line'
      },
      title: {
          text: 'Ventas del Mes'
      },
      subtitle: {
          text: 'Total Ventas '+obj['montoTotal']
      },
      xAxis: {
          categories: obj['dias']
      },
      yAxis: {
          title: {
              text: ''
          }
      },
      plotOptions: {
          line: {
              dataLabels: {
                  enabled: true
              },
              enableMouseTracking: false
          }
      },
      series: [{
          name: 'Dato',
          data: obj['total']
      }]
  });
}
function grafico_de_anio(valores) {
  var obj = JSON.parse(valores);

  Highcharts.chart('graficaAnio', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Ventas del año'
      },
      subtitle: {
          text: 'Esdística de ventas por mes'
      },
      xAxis: {
          type: 'category',
          labels: {
              rotation: -45,
              style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
              }
          }
      },
      yAxis: {
          min: 0,
          title: {
              text: ''
          }
      },
      legend: {
          enabled: false
      },
      tooltip: {
          pointFormat: 'Population in 2022: <b>{point.y:.1f} soles</b>'
      },
      series: [{
          name: 'Population',
          data: [
                 
                ['Enero',obj[0]],['Febrero',obj[1]],['Marzo',obj[2]],['Abril',obj[3]],['Mayo',obj[4]],['Junio',obj[5]],['Julio',obj[6]],['Agosto',obj[7]],['Septiembre',obj[8]],['Octubre',obj[9]],['Noviembre',obj[10]],['Diciembre',obj[11]]
                             
          ],
          dataLabels: {
              enabled: true,
              rotation: -90,
              color: '#FFFFFF',
              align: 'right',
              format: '{point.y:.1f}', // one decimal
              y: 10, // 10 pixels down from the top
              style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
              }
          }
      }]
  });
}
fntSearchPagos();
fntSearchVMes();
fntSearchVAnio();
</script>