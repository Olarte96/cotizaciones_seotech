<?php
if (empty($_GET["id"])) {
    exit("No se proporcionó un ID");
}

$cotizacion = Cotizaciones::porId($_GET["id"]);
if (!$cotizacion) {
    exit("No existe la cotización");
}
$servicios = Cotizaciones::serviciosPorId($_GET["id"]);
$cotizacion = Cotizaciones::porId($_GET["id"]);
$caracteristicas = Cotizaciones::caracteristicasPorId($_GET["id"]);
$ajustes = Ajustes::obtener();
?>
<div id="app">
    <br>
    <div class="row">
        <div class="col-sm-6">
            <a class="navbar-brand" href="<?php echo BASE_URL ?>"><img src="img/logo3.png" width="450px" height="150px"></a>
            <br><br>
            <h3 style="color: #007eee">COTIZACIÓN # <?php echo htmlentities($cotizacion->id) ?></h3>
            <h6>FECHA: <?php echo htmlentities($cotizacion->fecha) ?></h6>
            <h6>CLIENTE: <?php echo htmlentities($cotizacion->razonSocial) ?></h6>
            <h6>NIT: <?php echo htmlentities($cotizacion->nit) ?></h6>
            <h6>CIUDAD: <?php echo htmlentities($cotizacion->ciudad) ?></h6>
        </div>
        <div class="col-sm-6" align="right"><br>
            <strong>Serotech S.A.S</strong><br>
            <strong>Nit: 901702446-2</strong><br>
            <strong>Cel: 322 395 9649</strong><br>
            <strong>Bogota D.C - Colombia</strong><br>
            <strong>Correo: info@serotech.com.co</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <br>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="color: #007eee">Descripción de la cotización</th>
                            <th style="color: #007eee">Condición de pago</th>
                            <th style="color: #007eee">Condición de entrega</th>
                            <th style="color: #007eee">Fecha de vencimiento</th>

                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo htmlentities($cotizacion->descripcion) ?></td>
                                <td><?php echo htmlentities($cotizacion->condicion_pago) ?></td>
                                <td><?php echo htmlentities($cotizacion->condicion_entrega) ?></td>
                                <td><?php echo htmlentities($cotizacion->fecha_vencimiento) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <br>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="color: #007eee">Servicio</th>
                            <th style="color: #007eee">Valor unitario</th>
                            <th style="color: #007eee">Cantidad</th>
                            <th style="color: #007eee">Costo de linea</th>

                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $costoTotal = 0;
                            $cantidad = 0;
                            $iva = 0;
                            $totalFinal = 0;

                            foreach ($servicios as $servicio) {
                                $cantidad += $servicio->cantidad;
                                $costoLinea = $servicio->costo * $servicio->cantidad;
                                $costoTotal += $costoLinea;
                            }

                            $iva = $costoTotal * 0.19;
                            $totalFinal = $costoTotal + $iva;

                            function formatearMoneda($valor) {
                                return '$' . number_format($valor, 2);
                            }
                            ?>

                            <?php foreach ($servicios as $servicio) { ?>
                                <tr>
                                    <td><?php echo htmlentities($servicio->servicio) ?></td>
                                    <td class="text-nowrap"><?php echo formatearMoneda($servicio->costo) ?></td>
                                    <td><?php echo htmlentities($servicio->cantidad) ?></td>
                                    <td class="text-nowrap"><?php echo formatearMoneda($servicio->costo * $servicio->cantidad) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Sub total</strong></td>
                                <td></td>
                                <td></td>
                                <td class="text-nowrap"><strong id="subtotal"><?php echo formatearMoneda($costoTotal) ?></strong></td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td><strong>IVA</strong></td>
                                <td></td>
                                <td></td>
                                <td class="text-nowrap"><strong id="iva"><?php echo formatearMoneda($iva) ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td></td>
                                <td></td>
                                <td class="text-nowrap"><strong id="totalFinal"><?php echo formatearMoneda($totalFinal) ?></strong></td>
                                <td colspan="2"></td>
                            </tr>
                            <td colspan="2">
                                    <button id="eliminarIvaBtn" class="btn btn-danger" onclick="eliminarIva()">Eliminar IVA</button>
                                </td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <br>
    
    <div class="row">
        <div class="col-sm" align="center">

            <?php if (!empty($ajustes->remitente)): ?>
                <p style="color: #007eee">NOTA: <strong><?php echo htmlentities($ajustes->remitente) ?></strong></p>
            <?php endif ?>

            <?php if (!empty($ajustes->mensajeAgradecimiento)): ?>
                <p style="color: #007eee"><?php echo htmlentities($ajustes->mensajeAgradecimiento) ?></p>
            <?php endif ?>

            <?php if (!empty($ajustes->mensajePie)): ?>
                <a href="https://serotech.com.co/"><p><?php echo htmlentities($ajustes->mensajePie) ?></p></a>
            <?php endif ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <button @click="imprimir" class="btn btn-primary d-print-none">Imprimir</button>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <br>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        new Vue({
            el: "#app",
            methods: {
                imprimir() {
                    let tituloOriginal = document.title;
                    document.title = "Cotización de <?php echo htmlentities($cotizacion->descripcion) ?> para <?php echo htmlentities($cotizacion->razonSocial) ?>";
                    window.print();
                    document.title = tituloOriginal;
                }
            },
        });
    });
</script>
<script>
    function formatearMoneda(valor) {
        return '$' + parseFloat(valor).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function eliminarIva() {
        // Obtén los elementos que contienen los valores de subtotal, iva y totalFinal
        var subtotalElem = document.getElementById('subtotal');
        var ivaElem = document.getElementById('iva');
        var totalFinalElem = document.getElementById('totalFinal');
        var eliminarIvaBtn = document.getElementById('eliminarIvaBtn');

        // Obtén los valores actuales como números
        var subtotal = parseFloat(subtotalElem.innerText.replace(/[$,]/g, ''));
        var iva = parseFloat(ivaElem.innerText.replace(/[$,]/g, ''));
        var totalFinal = parseFloat(totalFinalElem.innerText.replace(/[$,]/g, ''));

        // Recalcula el total sin el IVA
        var nuevoTotal = subtotal;

        // Actualiza el DOM con los nuevos valores formateados
        ivaElem.innerText = formatearMoneda(0);
        totalFinalElem.innerText = formatearMoneda(nuevoTotal);

        // Oculta el botón de eliminar IVA
        eliminarIvaBtn.style.display = 'none';

        // Opcional: muestra una alerta de confirmación
        alert("IVA eliminado. El nuevo total es " + formatearMoneda(nuevoTotal));
    }
</script>