<?php
$tokenCSRF = Utiles::obtenerTokenCSRF();
$clientes = Clientes::todos();
?>
<div class="row">
    <div class="col-sm">
        <h1>Nueva cotización</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <form method="post" action="<?php echo BASE_URL ?>/?p=guardar_cotizacion">
            <input type="hidden" name="tokenCSRF" value="<?php echo $tokenCSRF ?>">
            <div class="form-group">
                <label for="idCliente">Seleccione un cliente</label>
                <select required class="form-control" name="idCliente" id="idCliente">
                    <?php foreach ($clientes as $cliente) { ?>
                        <option value="<?php echo $cliente->id ?>"><?php echo htmlentities($cliente->razonSocial) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input value="<?php echo date("Y-m-d") ?>" name="fecha" autocomplete="off" required type="date"
                       class="form-control" id="fecha">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción de la cotización</label>
                <input autofocus name="descripcion" autocomplete="off" required type="text" class="form-control"
                       id="descripcion" placeholder="Describa el servicio  ">
            </div>
            <div class="form-group">
                <label for="cond_pago">Condiciones de pago</label>
                <input autofocus name="cond_pago" autocomplete="off" required type="text" class="form-control"
                       id="cond_pago" placeholder="Describa la condición de pago  ">
            </div>
            <div class="form-group">
                <label for="cond_entrega">Condiciones de entrega</label>
                <input autofocus name="cond_entrega" autocomplete="off" required type="text" class="form-control"
                       id="cond_entrega" placeholder="Describa la condición de entrega">
            </div>
            <div class="form-group">
                <label for="fecha_venc">Fecha de vencimiento</label>
                <input value="<?php echo date("Y-m-d") ?>" name="fecha_venc" autocomplete="off" required type="date"
                       class="form-control" id="fecha_venc">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-success" href="<?php echo BASE_URL ?>/?p=cotizaciones">&larr; Volver</a>
        </form>
    </div>
</div>