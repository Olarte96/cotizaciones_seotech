<?php
$tokenCSRF = Utiles::obtenerTokenCSRF();
?>
<div class="row">
    <div class="col-sm">
        <h1>Nuevo cliente</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <form method="post" action="<?php echo BASE_URL ?>/?p=guardar_cliente">
            <input type="hidden" name="tokenCSRF" value="<?php echo $tokenCSRF ?>">
            <div class="form-group">
                <label for="razonSocial">Nombre o razón social</label>
                <input autofocus name="razonSocial" autocomplete="off" required type="text" class="form-control"
                       id="razonSocial" placeholder="Digite la razón social">
            </div>
            <div class="form-group">
                <label for="nit">Nit</label>
                <input autofocus name="nit" autocomplete="off" required type="number" class="form-control"
                       id="nit" placeholder="Digite el NIT o cedula">
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <input autofocus name="ciudad" autocomplete="off" required type="text" class="form-control"
                       id="ciudad" placeholder="Digite la ciudad">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-success" href="<?php echo BASE_URL ?>/?p=clientes">&larr; Volver</a>
        </form>
    </div>
</div>