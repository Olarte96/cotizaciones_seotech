<?php
if (empty($_GET["id"])) {
    exit;
}

$cotizacion = Cotizaciones::porId($_GET["id"]);
if (!$cotizacion) {
    exit("No existe la cotización");
}

$servicios = Cotizaciones::serviciosPorId($_GET["id"]);
$caracteristicas = Cotizaciones::caracteristicasPorId($_GET["id"]);
$tokenCSRF = Utiles::obtenerTokenCSRF();
?>
<div id="app">
    <div class="row">
        <div class="col-sm">
            <div class="row">
                <div class="col-sm-8">
                    <h3>Servicios</h3>
                    <div class="alert alert-info">
                        <p>Añada servicios que tienen un costo y precio, al final se calcularán los totales</p>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Producto o servicio</th>
                                        <th>Costo unitario</th>
                                        <th>Cantidad</th>
                                        <th>Costo de linea</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $costoTotal = 0;
                                    $cantidad = 0;
                                    $costoLinea = 0;
                                    $iva = 0;
                                    $totalFinal = 0;
                                    ?>
                                    <?php
                                    foreach ($servicios as $servicio) {
                                        $cantidad += $servicio->cantidad;
                                        $costoLinea = $servicio->costo * $servicio->cantidad;
                                        $costoTotal += $costoLinea;
                                        $iva = $costoTotal * 0.19;
                                        $totalFinal = $costoTotal + $iva;
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($servicio->servicio) ?></td>
                                            <td class="text-nowrap">{{<?php echo htmlentities($servicio->costo) ?> |
                                                dinero}}
                                            </td>
                                            <td>
                                                <?php echo htmlentities($servicio->cantidad) ?>
                                            </td>
                                            <td>
                                                 {{<?php echo htmlentities($costoLinea) ?> |
                                                dinero}}
                                            </td>
                                            <td>
                                                <a
                                                        class="btn btn-warning"
                                                        href="<?php printf('%s/?p=editar_servicio_de_cotizacion&idCotizacion=%s&idServicio=%s', BASE_URL, $cotizacion->id, $servicio->id) ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a
                                                        class="btn btn-danger"
                                                        href="<?php printf('%s/?p=eliminar_servicio_de_cotizacion&idCotizacion=%s&tokenCSRF=%s&idServicio=%s', BASE_URL, $cotizacion->id, $tokenCSRF, $servicio->id) ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td><strong>Sub total</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-nowrap"><strong>{{<?php echo htmlentities($costoTotal) ?> |
                                                dinero}}</strong></td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>IVA</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-nowrap"><strong>{{<?php echo htmlentities($iva)?> |
                                                dinero}}</strong></td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-nowrap"><strong>{{<?php echo htmlentities($totalFinal) ?> |
                                                dinero}}</strong></td>
                                        <td colspan="2"></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h3>Agregar nuevo servicio</h3>
                    <form method="post" action="<?php echo BASE_URL ?>/?p=agregar_servicio_a_cotizacion">
                        <input type="hidden" name="idCotizacion" value="<?php echo $_GET["id"] ?>">
                        <input type="hidden" name="tokenCSRF" value="<?php echo $tokenCSRF ?>">
                        <div class="form-group">
                            <label for="servicio">Servicio</label>
                            <input autofocus name="servicio" autocomplete="off" required type="text"
                                   class="form-control" id="servicio" placeholder="Por ejemplo: Instalación de disco duro">
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo</label>
                            <input name="costo" autocomplete="off" required type="number" class="form-control"
                                   id="costo" placeholder="Costo del producto o servicio">
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input name="cantidad" autocomplete="off" required type="number" class="form-control"
                                   id="cantidad" placeholder="Cantidad de articulos">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">                
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        new Vue({
            el: "#app",
        });
    });
</script>