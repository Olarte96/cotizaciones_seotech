<?php
$ajustes = Ajustes::obtener();
$tokenCSRF = Utiles::obtenerTokenCSRF();
?>
<div class="row">
    <div class="col-sm">
        <h1>Establecer notas</h1>
        <?php if (isset($_GET["mensaje"])) { ?>
            <div class="alert alert-<?php echo($_GET["mensaje"] == "1" ? "success" : "danger") ?>">
                <?php if ($_GET["mensaje"] == "1"): ?>
                    Ajustes guardados
                <?php endif; ?>
                <?php if ($_GET["mensaje"] == "0"): ?>
                    Error al guardar ajustes. Intenta de nuevo
                <?php endif; ?>
            </div>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <form method="post" action="<?php echo BASE_URL ?>/?p=actualizar_ajustes">
            <input name="tokenCSRF" type="hidden" value="<?php echo $tokenCSRF ?>">
            <div class="form-group">
                <label for="remitente">Nota 1</label>
                <input maxlength="100" value="<?php echo htmlentities($ajustes->remitente) ?>" autofocus
                       name="remitente" autocomplete="off" type="text" class="form-control" id="razonSocial"
                       placeholder="Primera nota al final de la pagina">
            </div>
            <div class="form-group">
                <label for="mensajeAgradecimiento">Nota 2</label>
                <textarea placeholder="Segunda nota al final de la pagina" maxlength="255"
                          name="mensajeAgradecimiento" id="mensajeAgradecimiento" cols="30" rows="3"
                          class="form-control"><?php echo htmlentities($ajustes->mensajeAgradecimiento) ?></textarea>
            </div>
            <div class="form-group">
                <label for="mensajePie">Nota 3</label>
                <textarea placeholder="Notas adicionales al final de la pagina" maxlength="255"
                          name="mensajePie" id="mensajePie" cols="30" rows="3"
                          class="form-control"><?php echo htmlentities($ajustes->mensajePie) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-success" href="<?php echo BASE_URL ?>/?p=cotizaciones">&larr; Volver</a>
        </form>
        <br>
    </div>
</div>