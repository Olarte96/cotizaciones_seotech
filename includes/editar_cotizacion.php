<?php
if (
empty($_GET["id"])
) {
    exit;
}
$tokenCSRF = Utiles::obtenerTokenCSRF();
$clientes = Clientes::todos();
$cotizacion = Cotizaciones::porId($_GET["id"]);
?>
<div class="row">
    <div class="col-sm">
        <h1>Editar cotización</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <form method="post" action="<?php echo BASE_URL ?>/?p=actualizar_cotizacion">
            <input type="hidden" name="tokenCSRF" value="<?php echo $tokenCSRF ?>">
            <input type="hidden" name="id" value="<?php echo $cotizacion->id ?>">
            <div class="form-group">
                <label for="idCliente">Seleccione un cliente</label>
                <select required class="form-control" name="idCliente" id="idCliente">
                    <?php foreach ($clientes as $cliente) { ?>
                        <option <?php echo intval($cliente->id) === intval($cotizacion->idCliente) ? "selected" : "" ?>
                                value="<?php echo $cliente->id ?>"><?php echo htmlentities($cliente->razonSocial) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input value="<?php echo htmlentities($cotizacion->fecha) ?>" name="fecha" autocomplete="off" required
                       type="date" class="form-control" id="fecha">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción de la cotización</label>
                <input value="<?php echo htmlentities($cotizacion->descripcion) ?>" autofocus name="descripcion"
                       autocomplete="off" required type="text" class="form-control" id="descripcion"
                       placeholder="Por ejemplo: Sistema de ventas, Construcción de casa">
            </div>
            <div class="form-group">
                <label for="cond_pago">Condiciones de pago</label>
                <input value="<?php echo htmlentities($cotizacion->condicion_pago) ?>" autofocus name="cond_pago"
                       autocomplete="off" required type="text" class="form-control" id="cond_pago"
                       placeholder="Por ejemplo: Sistema de ventas, Construcción de casa">
            </div>
            <div class="form-group">
                <label for="cond_entrega">Condiciones de entrega</label>
                <input value="<?php echo htmlentities($cotizacion->condicion_entrega) ?>" autofocus name="cond_entrega"
                       autocomplete="off" required type="text" class="form-control" id="cond_entrega"
                       placeholder="Condición de entrega">
            </div>
            <div class="form-group">
                <label for="fecha_venc">Fecha</label>
                <input value="<?php echo htmlentities($cotizacion->fecha_vencimiento) ?>" name="fecha_venc" autocomplete="off" required
                       type="date" class="form-control" id="fecha_venc">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-success" href="<?php echo BASE_URL ?>/?p=cotizaciones">&larr; Volver</a>
        </form>
    </div>
</div>