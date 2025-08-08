<?php

if (empty($_GET["idServicio"])) {
    exit("No proporcionaste un id de servicio");
}
if (empty($_GET["idCotizacion"])) {
    exit("No proporcionaste un id de cotización");
}
$servicio = Cotizaciones::obtenerServicioPorId($_GET["idServicio"]);
if (!$servicio) {
    exit("No existe el servicio");
}
$tokenCSRF = Utiles::obtenerTokenCSRF();
?>


<div class="col-sm-4">
    <h3>Editar servicio</h3>
    <form method="post" action="<?php echo BASE_URL ?>/?p=actualizar_servicio_de_cotizacion">
        <input type="hidden" name="idCotizacion" value="<?php echo $servicio->idCotizacion ?>">
        <input type="hidden" name="idServicio" value="<?php echo $servicio->id ?>">
        <input type="hidden" name="tokenCSRF" value="<?php echo $tokenCSRF ?>">
        <div class="form-group">
            <label for="servicio">Servicio</label>
            <input value="<?php echo $servicio->servicio; ?>" autofocus name="servicio" autocomplete="off" required
                   type="text" class="form-control" id="servicio" placeholder="Por ejemplo: Desarrollo de app">
        </div>
        <div class="form-group">
            <label for="costo">Costo</label>
            <input value="<?php echo $servicio->costo; ?>" name="costo" autocomplete="off" required type="number"
                   class="form-control" id="costo" placeholder="Costo especificado en USD">
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input value="<?php echo $servicio->cantidad; ?>" name="cantidad" autocomplete="off" required
                   type="number" class="form-control" id="cantidad"
                   placeholder="Cantidad de tiempo que tomará el servicio">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-success"
           href="<?php echo BASE_URL ?>/?p=detalles_caracteristicas_cotizacion&id=<?php echo $_GET["idCotizacion"] ?>">&larr;
            Volver</a>
    </form>
</div>