<div class="pd-30">
    <h4 class="tx-gray-800 mg-b-5"><?php echo $titulo ?></h4>
</div>

<div class="br-pagebody mg-t-5 pd-x-30">
    <?php error_reporting(0); ?>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <form id="form_venta" name="form_venta" action="<?php echo base_url(); ?>/Venta/registrarDatos" method="POST">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Comprobante: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" id="comprobante" name="comprobante" placeholder="Ingrese el comprobante" value="<?= set_value('codigo') ?>">
                        <p id="errCom" style="color:red">
                        </p>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Tipo de pago: <span class="tx-danger">*</span></label>
                        <select class="form-control select2" id="listTipopago" name="listTipopago">
                            <option label="Seleccione un Tipo de Pago"></option>
                            <?php foreach ($tipopago as $tipo) : ?>
                                <option value="<?php echo $tipo["idtipopago"] ?>" <?php echo ($venta["idtipopago"] == $tipo["tipopago"]) ? "selected" : "" ?>>
                                    <?php echo $tipo["tipopago"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p id="errPago" style="color:red">
                        </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="form-control-label">Cliente: <span class="tx-danger">*</span></label>
                        <select class="form-control select2" id="listCliente" name="listCliente">
                            <option label="Seleccione un cliente"></option>
                            <?php foreach ($persona as $per) : ?>
                                <option value="<?php echo $per["idpersona"] ?>" <?php echo ($venta["idpersona"] == $per["nombres"]) ? "selected" : "" ?>>
                                    <?php echo $per["nombres"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p id="errPer" style="color:red">
                        </p>
                    </div>
                </div>

                <div class="col-lg-12  ">
                    <label class="form-control-label">Producto: <span class="tx-danger">*</span></label>
                    <div class="form-group justify-content-center align-items-center">
                        <select class="form-control select2" id="listProducto" name="listProducto">
                            <option label="Seleccione un producto"></option>
                            <?php foreach ($producto as $pro) : ?>
                                <?php $dataProducto = $pro["idproducto"] . "*" . $pro["codigo"] . "*" . $pro["nombre"] . "*" . $pro["precio"] . "*" . $pro["stock"] . "*" . $pro["cantidad"] ?>
                                <option value="<?php echo $dataProducto ?>" <?php echo ($venta["producto"] == $pro["nombre"]) ? "selected" : "" ?>>
                                    <?php echo $pro["nombre"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p id="errPro" style="color:red">
                        </p>
                        <div>
                            <button type="button" class="btn btn-outline-primary btn-block mg-b-10" id="btn-agregar">Agregar</button>
                        </div>
                    </div>
                </div>

                <table id="detventa" class="table table-hover table-bordered table-responsive overflow-x-scroll">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Importe</th>
                            <th class="text-center">Opciones</th>

                        </tr>
                    </thead>

                    <tbody id="tbody">

                    </tbody>

                </table>
                <div>
                    <label>Subtotal: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="subtotal" placeholder="Ingrese el comprobante" disabled>
                    <input class="form-control" type="hidden" id="subT" name="subtotal" placeholder="Ingrese el comprobante">

                </div>
                <div>
                    <label>Total: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="total" placeholder="Ingrese el comprobante" disabled>
                    <input class="form-control" type="hidden" id="totalT" name="total" placeholder="Ingrese el comprobante">

                </div>
                <div class="w-50">
                    <button id="Enviar" type="button" class="btn btn-outline-primary btn-block mg-b-10 mt-3" 
                     onclick="EnviarDatos()" style="cursor: pointer;">Enviar Datos</button>

                </div>
            </form>




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

    $("#listProducto").on("change", function() {
        var option = $(this).val();
        $("#btn-agregar").val(option);

    });

    $("#btn-agregar").on("click", function() {
        var dataproducto = $(this).val();
        var dtproducto = dataproducto.split("*");



        if (dataproducto == "") {
            Swal.fire({
                icon: 'error',
                title: 'Alerta',
                text: 'Debe seleccionar un producto',
            });
        } else {
            var elemento = document.getElementById(dtproducto[0]);
            if (elemento) {
                var inputNumber = elemento.querySelector("input[type='number']"); // Obtener el campo de número
                var valorActual = parseInt(inputNumber.value); // Obtener el valor actual y convertirlo a un número
                inputNumber.value = valorActual + 1; // Aumentar el valor en 1

                sumaCantidad(dtproducto);
                sumar();

            } else {
                TablaId(dtproducto);
                $("#detventa tbody").append(tabladt);
                sumar();
            }


        }

    });

    function sumaCantidad(dtproducto) {
        var elemento = document.getElementById(dtproducto[0]);
        let cant = elemento.querySelector("#cantidad").value
        let dolar = elemento.querySelector("#precio").value
        var pElement = elemento.querySelector("#pImporte");

        if (cant > 0) {
            var importeT = cant * dolar;
            $("#txtimporte").val(importeT);
            if (pElement.textContent.trim() !== "") {
                pElement.textContent = ""; // Borra el contenido existente si ya hay algo
                pElement.textContent += importeT + ".00";
            }
            sumar();
        } else {
            alert("es menor a 0")
        }

        $(document).on("input", "#detventa tbody input.cantidades", function() {
            var cantidad = $(this).val();

            if (cantidad > 0) {
                var precio = $(this).parents("tr").children("td").eq(3).text();
                var importe = cantidad * precio;

                $(this).parents("tr").children().eq(6).attr("id", "pImporte").text(importe + ".00");
                sumar();
            } else {
                alert("es menor a 0")
            }

        })
    }



    function TablaId(dtproducto) {
        tabladt = "<tr id='" + dtproducto[0] + "' class='tablas'>";
        tabladt += "<td> <input type='hidden' name='txtidproducto[]' id=txtidproducto value='" + dtproducto[0] + "'> " + dtproducto[0] + " </td>  ";
        tabladt += "<td> <input type='hidden' name='codigo[]' value='" + dtproducto[1] + "'> " + dtproducto[1] + " </td>  ";
        tabladt += "<td> <input type='hidden' name='nombre[]' value='" + dtproducto[2] + "'>" + dtproducto[2] + " </td>";
        tabladt += "<td> <input type='hidden' id='precio' name='precio[]' value='" + dtproducto[3] + "'>" + dtproducto[3] + " </td>";
        tabladt += "<td> <input type='hidden' name='stock[]' value='" + dtproducto[4] + "'>" + dtproducto[4] + " </td>";
        tabladt += "<td> <input type='number'  id='cantidad' name='txtcantidad[]' style='min-width:70px; width:74px;' class='cantidades' value='1' > </td>";
        tabladt += "<td> <input type='hidden' name='txtimporte[]' id='txtimporte' value='" + dtproducto[3] + "'><p id='pImporte'>" + dtproducto[3] + "</p></td>";
        tabladt += "<td> <button type='button' class='btn btn-danger btn-sm btnDelRol ml-1' id='btnEliminar' onclick='eliminarProducto(" + dtproducto[0] + ")' title='Eliminar' > <i class='icon ion-close'></i> </button></td>";

        tabladt += "</tr>";
    }

    function verificarID(idpro) {
        var elemento = document.getElementById(idpro); // Obtener el elemento con el ID especificado

        if (elemento) {
            var cantidadCell = elemento.getElementsByClassName("cantidades")[0]; // Obtener la celda de cantidad
            var cantidad = parseInt(cantidadCell.innerHTML); // Obtener el valor actual de cantidad y convertirlo a un número
            cantidadCell.innerHTML = cantidad + 1; // Aumentar la cantidad en 1
            alert("Si existe")
        } else {
            alert("El ID no existe en la tabla.");
        }
    }

    function sumar() {
        var textsubTotal = $("#subtotal");
        var textTotal = $("#total");
        var txtCantidad = $("#txtcantidad");
        var subT = $("#subT");
        var totalT = $("#totalT");
        var subtotal = 0;
        var cantidad = 0;
        var igv = 0;

        $("#detventa tbody tr").each(function() {
            subtotal = subtotal + Number($(this).children().eq(6).text())
            //console.log(subtotal);
            cantidad = cantidad + Number($(this).children().eq(5).text())
            //console.log(cantidad);

        })

        igv = subtotal + (subtotal * 0.08);
        total = igv;
        textsubTotal.val(subtotal);
        textTotal.val(total);
        subT.val(subtotal);
        totalT.val(total);

    }

    function eliminarProducto(idproducto) {

        if (idproducto) {
            idquitado = document.getElementById(idproducto).remove();
        }

    }


    function EnviarDatos() {
        // $("#Enviar").click(function() {

            let nFilas = $("#detventa tr").length;
            if (nFilas < 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Alerta',
                    text: 'Debe agregar un producto',
                });
            } else {
                registrarDatos();
            }
        // });
    };

    function registrarDatos() {
        $.ajax({
            url: '<?php echo base_url() ?>/venta/registrarDatos',
            method: 'POST',
            dataType: 'json',
            data: $("#form_venta").serialize(),
            success: function(response) {
                if (response.statusCode == 200) {
                    window.location.href = '<?php echo base_url() ?>/venta/listarventa'

                } else if (response.statusCode == 500) {
                    
                    if (response.errors.comprobante && response.errors.listTipopago && response.errors.listCliente) {
                        $('#errCom').text(response.errors.comprobante);
                        $('#errPago').text(response.errors.listTipopago);
                        $('#errPer').text(response.errors.listCliente);

                    } else if (response.errors.comprobante) {
                        $('#errCom').text(response.errors.comprobante);
                    } else if (response.errors.listTipopago) {
                        $('#errPago').text(response.errors.listTipopago);
                    } else if (response.errors.comprobante && response.errors.listTipopago) {
                        $('#errCom').text(response.errors.comprobante);
                        $('#errPago').text(response.errors.listTipopago);
                    } else if (response.errors.listTipopago) {
                        $('#errPago').text(response.errors.listTipopago);
                    } else if (response.errors.listCliente) {
                        $('#errPer').text(response.errors.listCliente);
                    } else if (response.errors.comprobante) {
                        $('#errCom').text(response.errors.comprobante);

                    }
                }
            }
        })
    }
</script>